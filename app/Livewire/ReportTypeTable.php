<?php

namespace App\Livewire;

use App\Models\ReportType;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Masmerise\Toaster\Toaster;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ReportTypeTable extends PowerGridComponent
{
    public string $tableName = 'report-type-table-rsqsda-table';

    public function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'refresh-table' => '$refresh',
            ]
        );
    }

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
        return ReportType::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('slug')
            ->add('created_at_formatted', fn(ReportType $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->index(),
            Column::make('NAMA TIPE', 'name')
                ->sortable()
                ->searchable(),

            Column::make('SLUG URL', 'slug')
                ->sortable()
                ->searchable(),

            Column::action('AKSI')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }


    #[\Livewire\Attributes\On('delete')]
    public function delete($id)
    {
        try {
            ReportType::query()->find($id)->delete();
            Toaster::success("Berhasil menghapus data tipe laporan");
        } catch (\Exception $e) {
            Toaster::error("gagal menghapus data tipe laporan: " . $e->getMessage());
        }
    }


    public function actions(ReportType $row): array
    {
        return [
            Button::add('edit')
                ->slot('Ubah')
                ->class('bg-blue-600 rounded-md font-semibold text-white px-3 py-1 rounded')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('Hapus')
                ->class('bg-red-600 rounded-md font-semibold text-white px-3 py-2 rounded')
                ->dispatch("confirm-modal", ['rowId' => $row->id])
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
