<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Masmerise\Toaster\Toaster;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PostTable extends PowerGridComponent
{
    public string $tableName = 'post-table-upxtyt-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Post::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('category_id', fn(Post $model) => $model->category->name)
            ->add('created_at_formatted', fn(Post $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->index(),
            Column::make('JUDUL', 'title')
                ->sortable()
                ->searchable(),

            Column::make('KATEGORI', 'category_id'),

            Column::action('AKSI')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($slug): void
    {
       $this->redirectRoute('posts.edit', ['slug' => $slug]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($id)
    {
        try {
            Post::query()->where('slug', $id)->delete();
            Toaster::success("Berhasil menghapus data status laporan");
        } catch (\Exception $e) {
            Toaster::error("gagal mengh apus data status laporan: " . $e->getMessage());
        }
    }

    #[\Livewire\Attributes\On('preview')]
    public function preview($slug): void
    {
        $this->redirectRoute('posts.show', ['slug' => $slug]);
    }


    public function actions(Post $row): array
    {
        return [
            Button::add('edit')
                ->slot('Preview')
                ->class('bg-green-600 rounded-md font-semibold text-white px-3 py-1 rounded')
                ->dispatch('preview', ['slug' => $row->slug]),
                
            Button::add('edit')
                ->slot('Ubah')
                ->class('bg-blue-600 rounded-md font-semibold text-white px-3 py-1 rounded')
                ->dispatch('edit', ['slug' => $row->slug]),

            Button::add('delete')
                ->slot('Hapus')
                ->class('bg-red-600 rounded-md font-semibold text-white px-3 py-2 rounded')
                ->dispatch("confirm-modal", ['rowId' => $row->slug])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
