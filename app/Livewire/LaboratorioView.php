<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Laboratorio;
use Livewire\WithPagination;

class LaboratorioView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';

    public $showModal = false;

    public $nombre;
    public $ubicacion;
    public $coordinador;
    public $telefono_coordinador;
    public $correo_coordinador;
    public $ciudad;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'coordinador' => 'required|string|max:255',
        'telefono_coordinador' => 'required|string|max:20',
        'correo_coordinador' => 'required|email|max:255',
        'ciudad' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {

        $this->reset(['nombre', 'ubicacion', 'coordinador', 'telefono_coordinador', 'correo_coordinador', 'ciudad']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['nombre', 'ubicacion', 'coordinador', 'telefono_coordinador', 'correo_coordinador', 'ciudad']);
    }

    public function guardar()
    {
        $this->validate();

        Laboratorio::create([
            'nombre' => $this->nombre,
            'ubicacion' => $this->ubicacion,
            'coordinador' => $this->coordinador,
            'telefono_coordinador' => $this->telefono_coordinador,
            'correo_coordinador' => $this->correo_coordinador,
            'ciudad' => $this->ciudad,
        ]);

        $this->closeModal();
        session()->flash('message', 'Laboratorio creado exitosamente.');
    }




    public function render()
    {
        $laboratorios = Laboratorio::where('nombre', 'like', '%'.$this->search.'%')
            ->orWhere('ubicacion', 'like', '%'.$this->search.'%')
            ->orWhere('coordinador', 'like', '%'.$this->search.'%')
            ->orWhere('ciudad', 'like', '%'.$this->search.'%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

        return view('livewire.laboratorio-view', [
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
