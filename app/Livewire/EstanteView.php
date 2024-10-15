<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estante;
use App\Models\Laboratorio;

class EstanteView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';


    public $showModal = false;
    public $no_estante;
    public $descripcion;
    public $laboratorio_id;

    protected $rules = [
        'no_estante' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'laboratorio_id' => 'required|exists:laboratorio,id',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['no_estante', 'descripcion', 'laboratorio_id']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['no_estante', 'descripcion', 'laboratorio_id']);
    }

    public function guardar()
    {
        $this->validate();

        Estante::create([
            'no_estante' => $this->no_estante,
            'descripcion' => $this->descripcion,
            'laboratorio_id' => $this->laboratorio_id,
        ]);

        $this->closeModal();
        session()->flash('message', 'Estante creado exitosamente.');
    }

    public function render()
    {
        $estantes = Estante::where('no_estante', 'like', '%' . $this->search . '%')
            ->orWhere('descripcion', 'like', '%' . $this->search . '%')
            ->orWhereHas('laboratorio', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);


            $laboratorios = Laboratorio::all();

        return view('livewire.estante-view', [
            'estantes' => $estantes,
            'laboratorios' => $laboratorios,
        ]);
    }

    public function order($sort){
        if($this->sort == $sort){

            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else {
                $this->direction = 'desc';
            }

        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
