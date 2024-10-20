<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estante;
use App\Models\Laboratorio;
use App\Models\Posicion;

class EstanteView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';


    public $showModal = false;
    public $verModal = false;
    public $miEstante = null;
    
    public $no_estante;
    public $descripcion;
    public $filas;
    public $columnas;
    public $laboratorio_id;

    protected $rules = [
        'no_estante' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'filas' => 'required|integer|min:1|max:7',
        'columnas' => 'required|integer|min:1|max:5',
        'laboratorio_id' => 'required|exists:laboratorio,id',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal(Estante $estante = null)
    {
        if($estante){
            $this->miEstante = $estante;
            $this->no_estante = $estante->no_estante;
            $this->descripcion = $estante->descripcion;
            $this->filas = $estante->filas;
            $this->columnas = $estante->columnas;
            $this->laboratorio_id = $estante->laboratorio_id;

        }else{
            $this->reset(['no_estante', 'descripcion', 'filas', 'columnas', 'laboratorio_id', 'miEstante']);
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['no_estante', 'descripcion','filas', 'columnas', 'laboratorio_id', 'miEstante']);
    }

    public function openVerModal(Estante $estante)
    {
        $this->reset(['no_estante', 'descripcion', 'filas', 'columnas', 'laboratorio_id', 'miEstante']);


        $this->no_estante = $estante->no_estante;
        $this->descripcion = $estante->descripcion;
        $this->filas = $estante->filas;
        $this->columnas = $estante->columnas;
        $this->laboratorio_id = $estante->laboratorio_id;

        $this->verModal = true;
    }

    public function closeVerModal()
    {
        $this->verModal = false;
        $this->reset(['no_estante', 'descripcion','filas', 'columnas', 'laboratorio_id', 'miEstante']);
    }

    public function guardarOActualizar()
    {
        $this->validate();

        if(isset($this->miEstante->id)){
            $this->miEstante->update([
                'no_estante' => $this->no_estante,
                'descripcion' => $this->descripcion,
                'filas' => $this->filas,
                'columnas' => $this->columnas,
                'laboratorio_id' => $this->laboratorio_id,
            ]);

            // Obtener las posiciones actuales del estante
            $posicionesActuales = Posicion::where('estante_id', $this->miEstante->id)->get() ?? collect();

            // Crear un array para las nuevas posiciones
            $nuevasPosiciones = [];


            // Crear las posiciones en función de las filas y columnas
            for ($fila = 1; $fila <= $this->filas; $fila++) {
                for ($columna = 1; $columna <= $this->columnas; $columna++) {
                    $posicionExistente = $posicionesActuales->first(function ($posicion) use ($fila, $columna) {
                        return $posicion->fila == $fila && $posicion->columna == $columna;
                    });

                    if ($posicionExistente) {
                        // Si la posición ya existe, mantenerla
                        $nuevasPosiciones[] = $posicionExistente->id;
                    } else {
                        // Si la posición no existe, crear una nueva
                        $nuevaPosicion = Posicion::create([
                            'estante_id' => $this->miEstante->id,
                            'fila' => $fila,
                            'columna' => $columna,
                            'reactivos_id' => null, // Inicialmente sin reactivo
                        ]);
                        $nuevasPosiciones[] = $nuevaPosicion->id;
                    }
                }
            }

            // Eliminar las posiciones que ya no son necesarias
            Posicion::where('estante_id', $this->miEstante->id)
            ->whereNotIn('id', $nuevasPosiciones)
            ->delete();


            $this->closeModal();
            session()->flash('message', 'Estante actualizado exitosamente.');

        }else {


            $estante = Estante::create([
                'no_estante' => $this->no_estante,
                'descripcion' => $this->descripcion,
                'filas' => $this->filas,
                'columnas' => $this->columnas,
                'laboratorio_id' => $this->laboratorio_id,
            ]);
    
            // Crear las posiciones en función de las filas y columnas
            for ($fila = 1; $fila <= $this->filas; $fila++) {
                for ($columna = 1; $columna <= $this->columnas; $columna++) {
                    Posicion::create([
                        'estante_id' => $estante->id,
                        'fila' => $fila,
                        'columna' => $columna,
                        'reactivos_id' => null, // Inicialmente sin reactivo
                    ]);
                }
            }
    
            $this->closeModal();
            session()->flash('message', 'Estante creado exitosamente.');

        }

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
