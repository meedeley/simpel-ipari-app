<?php

namespace App\Livewire\ReportStatus;

use App\Models\ReportStatus;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Masmerise\Toaster\Toaster;

class Form extends Component
{
    public $isEdited = false;

    public $isOpen = false;

    #[Validate('required|string|min:3')]
    public $name;

    #[Validate('nullable|string')]
    public $description;

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
        $type = ReportStatus::query()->findOrFail($rowId);

        $this->name = $type->name;
        $this->description = $type->description;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        $slug = Str::slug($this->name, '-') . '-' . Str::uuid();

        if ($this->isEdited) {
            ReportStatus::query()->update([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description
            ]);

            Toaster::success("Sukses update data tipe laporan");
        } else {
            ReportStatus::query()->create([
                'name' => $this->name,
                'slug' => $slug,
                'description' => $this->description
            ]);

            Toaster::success("Sukses tambah data tipe laporan");
        }

        $this->dispatch("refresh-table");
        $this->close();
    }

    public function render()
    {
        return view('livewire.report-status.form');
    }
}
