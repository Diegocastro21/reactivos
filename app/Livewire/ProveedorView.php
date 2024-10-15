<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedor;

class ProveedorView extends Component
{


    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';

    public $showModal = false;

    public $nombre;
    public $telefono;
    public $direccion;
    public $ciudad;
    public $pais;

    protected $rules = [
        'nombre' => 'required|string',
        'telefono' => 'required|string|max:20',
        'direccion' => 'required|string',
        'ciudad' => 'required|string',
        'pais' => 'required|string'
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function openModal(){
        $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais']);
        $this->showModal = true;
    }

    public function closeModal(){
        $this->showModal = false;
        $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais']);
    }


    public function guardar(){

        $this->validate();

        Proveedor::create([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'pais' => $this->pais
        ]);

        $this->closeModal();

        session()->flash('message', 'Proveedor creado satisfactoriamente');

    }


    public function render()
    {

        $proveedores = Proveedor::where('nombre', 'like', '%' . $this->search. '%')
        ->orWhere('telefono', 'like', '%' . $this->search . '%')
        ->orWhere('direccion', 'like', '%' . $this->search . '%')
        ->orWhere('ciudad', 'like', '%' . $this->search . '%')
        ->orWhere('pais', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->perPage);


        return view('livewire.proveedor-view', [
            'proveedores' => $proveedores,
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
