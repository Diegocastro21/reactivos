<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reactivos;
use Livewire\WithPagination;

class ReactivoView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $modal = false;

    public $codigo;
    public $nombre;
    public $disponibilidad;
    public $unidad_medida;
    public $cantidad_disponible;
    public $codigo_indicacion_peligro;
    public $lote;
    public $marca_fabricante;
    public $url_ficha_seguridad;
    public $fecha_vencimiento;
    public $nivel_reactivo;
    public $columna_estante;
    public $estante_id;

    protected $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'disponibilidad' => 'required|in:total,media,poca,no hay',
        'unidad_medida' => 'required|string|max:255',
        'cantidad_disponible' => 'required|numeric',
        'codigo_indicacion_peligro' => 'required|string|max:255',
        'lote' => 'required|string|max:255',
        'marca_fabricante' => 'required|string|max:255',
        'url_ficha_seguridad' => 'required|url|max:255',
        'fecha_vencimiento' => 'required|date',
        'nivel_reactivo' => 'required|string|max:255',
        'columna_estante' => 'required|string|max:255',
        'estante_id' => 'required|exists:estante,id',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca_fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'nivel_reactivo', 'columna_estante', 'estante_id']);
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca_fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'nivel_reactivo', 'columna_estante', 'estante_id']);
    }

    public function guardar()
    {
        $this->validate();

        session()->flash('message', 'Reactivo validoado exitosamente.');

        Reactivos::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'disponibilidad' => $this->disponibilidad,
            'unidad_medida' => $this->unidad_medida,
            'cantidad_disponible' => $this->cantidad_disponible,
            'codigo_indicacion_peligro' => $this->codigo_indicacion_peligro,
            'lote' => $this->lote,
            'marca_fabricante' => $this->marca_fabricante,
            'url_ficha_seguridad' => $this->url_ficha_seguridad,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'nivel_reactivo' => $this->nivel_reactivo,
            'columna_estante' => $this->columna_estante,
            'estante_id' => $this->estante_id,
        ]);

        $this->closeModal();
        session()->flash('message', 'Reactivo creado exitosamente.');
    }

    public function render()
    {
        $reactivos = Reactivos::where('codigo', 'like', '%'.$this->search.'%')
            ->orWhere('nombre', 'like', '%'.$this->search.'%')
            ->orWhere('disponibilidad', 'like', '%'.$this->search.'%')
            ->orWhere('marca_fabricante', 'like', '%'.$this->search.'%')
            ->paginate($this->perPage);

        return view('livewire.reactivo-view', [
            'reactivos' => $reactivos,
        ]);
    }
}
