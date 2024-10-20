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
    public $verModal = false;

    public $miProveedor = null;

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

    public function openModal(Proveedor $proveedor = null){
        

        if($proveedor){
            $this->miProveedor = $proveedor;
            $this->nombre = $proveedor->nombre;
            $this->telefono = $proveedor->telefono;
            $this->direccion = $proveedor->direccion;
            $this->ciudad = $proveedor->ciudad;
            $this->pais = $proveedor->pais;

            
        }else{
            $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais', 'miProveedor']);
        }

        $this->showModal = true;
    }

    public function closeModal(){
        $this->showModal = false;
        $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais', 'miProveedor']);
    }

    public function openVerModal(Proveedor $proveedor){
        $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais', 'miProveedor']);

        $this->nombre = $proveedor->nombre;
        $this->telefono = $proveedor->telefono;
        $this->direccion = $proveedor->direccion;
        $this->ciudad = $proveedor->ciudad;
        $this->pais = $proveedor->pais;

        $this->verModal = true;
    }

    public function closeVerModal(){
        $this->verModal = false;
        $this->reset(['nombre', 'telefono', 'direccion', 'ciudad', 'pais', 'miProveedor']);
    }


    public function guardarOActualizar(){

        $this->validate();

        if(isset($this->miProveedor->id)){
            $this->miProveedor->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'ciudad' => $this->ciudad,
                'pais' => $this->pais
            ]);

            // $this->miProveedor = null;
            $this->closeModal();
            session()->flash('message', 'Proveedor actualizado satisfactoriamente');
        }else {

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
