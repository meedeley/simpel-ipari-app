<?php

namespace App\Livewire\ReportType;

use App\Models\ReportType;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;

class Form extends Component
{
    public $isEdited = false;

    public $isOpen = false;

    #[Validate('required|string|min:3')]
    public $name;

    #[On("openModal")]
    public function open()
    {
        $this->reset();
        $this->isOpen = true;
    }

    public function close()
    {
        $this->reset();
        $this->isOpen = false;
        $this->isEdited = false;
    }

    #[On("edit")]
    public function isEdited($rowId)
    {
        $this->isEdited = true;
        $type = ReportType::query()->findOrFail($rowId);

        $this->name = $type->name;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $slug = Str::slug($this->name, '-') . '-' . Str::uuid();


        if ($this->isEdited) {
            ReportType::query()->update([
                'name' => $this->name,
                'slug' => $slug
            ]);

            Toaster::success("Sukses update data tipe laporan");
        } else {
            ReportType::query()->create([
                'name' => $this->name,
                'slug' => $slug
            ]);

               Toaster::success("Sukses tambah data tipe laporan");
        }

        $this->dispatch("refresh-table");
        $this->close();
    }

    public function render()
    {
        return view('livewire.report-type.form');
    }
}
