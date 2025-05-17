<?php

namespace App\Livewire\Utils;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ModalConfirmation extends Component
{

    public $isOpen = false;
    public $id;

    #[On("confirm-modal")]
    public function open($rowId)
    {
        $this->isOpen = true;
        $this->id = $rowId;
    }
    
    public function close()
    {
        $this->isOpen = false;
    }

    public function confirm()
    {
        $this->dispatch('delete', $this->id);
        $this->dispatch('refresh-table');
        $this->close();
    }

    public function render()
    {
        return view('livewire.utils.modal-confirmation');
    }
}
