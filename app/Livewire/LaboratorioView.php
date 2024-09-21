<?php

namespace App\Livewire;

use Livewire\Component;

class LaboratorioView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $laboratorios = Laboratorio::where('nombre', 'like', '%'.$this->search.'%')
            ->orWhere('ubicacion', 'like', '%'.$this->search.'%')
            ->orWhere('coordinador', 'like', '%'.$this->search.'%')
            ->orWhere('ciudad', 'like', '%'.$this->search.'%')
            ->paginate($this->perPage);

        return view('livewire.laboratorio-table', [
            'laboratorios' => $laboratorios,
        ]);
    }
}
