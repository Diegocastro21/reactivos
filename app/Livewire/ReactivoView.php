<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reactivos;
use App\Models\Estante;
use App\Models\Posicion;
use App\Models\Pictogramas;
use App\Models\Proveedor;
use App\Models\Categorias;
use Livewire\WithPagination;
use App\Models\DivisionUbicacionReactivo;

class ReactivoView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';

    public $modal = false;

    public $codigo;
    public $nombre;
    public $disponibilidad;
    public $unidad_medida;
    public $cantidad_disponible;
    public $codigo_indicacion_peligro;
    public $lote;
    public $marca;
    public $fabricante;
    public $url_ficha_seguridad;
    public $fecha_vencimiento;
    // public $nivel_reactivo;
    // public $columna_estante;
    public $estante_id;

    public $pictogramasSeleccionados = [];
    public $buscarProveedor = '';
    public $proveedoresSeleccionados = [];
    public $buscarCategoria = '';
    public $categoriasSeleccionadas = [];

    public $posicionSeleccionada;
    public $estantes;
    public $posiciones;
    public $estanteSeleccionado;

    public $proveedores = [];

    // public $estantes;
    // public $niveles = [];
    // public $columnas = [];

    protected $rules = [
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'disponibilidad' => 'required|in:total,media,poca,no hay',
        'unidad_medida' => 'required|in:g,mg,ml,l',
        'cantidad_disponible' => 'required|numeric',
        'codigo_indicacion_peligro' => 'required|string|max:255',
        'lote' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'fabricante' => 'required|string|max:255',
        'url_ficha_seguridad' => 'required|url|max:255',
        'fecha_vencimiento' => 'required|date|after:today',
        // 'nivel_reactivo' => 'required|string',
        // 'columna_estante' => 'required|string',
        'estante_id' => 'required|exists:estante,id',
    ];

    protected $messages = [
        'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
        'fecha_vencimiento.date' => 'El formato de fecha no es válido.',
        'fecha_vencimiento.after' => 'La fecha de vencimiento debe ser posterior a hoy.',

        'codigo.required' => 'El código del reactivo es obligatorio.',
        'codigo.string' => 'El código debe ser una cadena de texto.',
        'codigo.max' => 'El código no debe exceder los 255 caracteres.',

        'nombre.required' => 'El nombre del reactivo es obligatorio.',
        'nombre.string' => 'El nombre debe ser una cadena de texto.',
        'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',

        'disponibilidad.required' => 'La disponibilidad del reactivo es obligatoria.',
        'disponibilidad.in' => 'La disponibilidad debe ser total, media, poca o no hay.',

        'unidad_medida.required' => 'La unidad de medida es obligatoria.',
        'unidad_medida.in' => 'La unidad de medida debe ser g, mg, ml, l',

        'cantidad_disponible.required' => 'La cantidad disponible es obligatoria.',
        'cantidad_disponible.numeric' => 'La cantidad disponible debe ser un valor numérico.',

        'codigo_indicacion_peligro.required' => 'El código de indicación de peligro es obligatorio.',
        'codigo_indicacion_peligro.string' => 'El código de indicación de peligro debe ser una cadena de texto.',
        'codigo_indicacion_peligro.max' => 'El código de indicación de peligro no debe exceder los 255 caracteres.',

        'lote.required' => 'El número de lote es obligatorio.',
        'lote.string' => 'El número de lote debe ser una cadena de texto.',
        'lote.max' => 'El número de lote no debe exceder los 255 caracteres.',

        'marca.required' => 'La marca del reactivo es obligatoria.',
        'marca.string' => 'La marca debe ser una cadena de texto.',
        'marca.max' => 'La marca no debe exceder los 255 caracteres.',

        'fabricante.required' => 'El fabricante del reactivo es obligatorio.',
        'fabricante.string' => 'El fabricante debe ser una cadena de texto.',
        'fabricante.max' => 'El fabricante no debe exceder los 255 caracteres.',

        'url_ficha_seguridad.required' => 'La URL de la ficha de seguridad es obligatoria.',
        'url_ficha_seguridad.url' => 'La URL de la ficha de seguridad debe ser una dirección web válida.',
        'url_ficha_seguridad.max' => 'La URL de la ficha de seguridad no debe exceder los 255 caracteres.',


        'estante_id.required' => 'Debe seleccionar un estante.',
        'estante_id.exists' => 'El estante seleccionado no es válido.',
        // 'nivel_reactivo.required' => 'Debe seleccionar un nivel.',
        // 'columna_estante.required' => 'Debe seleccionar una columna.',

    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBuscarProveedor()
    {
        // $this->proveedores = Proveedor::where('nombre', 'like', '%' . $this->buscarProveedor . '%')->get();
        $this->resetPage();
    }

    public function updatedBuscarCategoria()
    {
        $this->resetPage();
    }

    public function updatedEstanteId()
    {
        $this->cargarPosiciones();
    }

    public function openModal()
    {
        $this->reset(['codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'estante_id']);
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento','pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'estante_id']);
    }

    public function cargarPosiciones()
    {
        if ($this->estante_id) {
            $this->estanteSeleccionado = Estante::find($this->estante_id);
            $posiciones = Posicion::where('estante_id', $this->estante_id)->get();
            
            $this->posiciones = [];
            for ($fila = 0; $fila < $this->estanteSeleccionado->filas; $fila++) {
                for ($columna = 0; $columna < $this->estanteSeleccionado->columnas; $columna++) {
                    $posicion = $posiciones->where('fila', $fila + 1)->where('columna', $columna + 1)->first();
                    $this->posiciones[$fila][$columna] = [
                        'id' => $posicion ? $posicion->id : null,
                        'ocupada' => $posicion ? $posicion->reactivos_id !== null : false
                    ];
                }
            }
        }
    }

    public function seleccionarPosicion($posicionId)
    {
        $this->posicionSeleccionada = $posicionId;
    }

    public function togglePictograma($pictogramaId)
    {
        if (in_array($pictogramaId, $this->pictogramasSeleccionados)) {
            $this->pictogramasSeleccionados = array_diff($this->pictogramasSeleccionados, [$pictogramaId]);
        } else {
            $this->pictogramasSeleccionados[] = $pictogramaId;
        }
    }

    public function toggleProveedor($proveedorId)
    {
        if (in_array($proveedorId, $this->proveedoresSeleccionados)) {
            $this->proveedoresSeleccionados = array_diff($this->proveedoresSeleccionados, [$proveedorId]);
        } else {
            $this->proveedoresSeleccionados[] = $proveedorId;
        }
    }

    public function toggleCategoria($categoriaId)
    {
        if (in_array($categoriaId, $this->categoriasSeleccionadas)) {
            $this->categoriasSeleccionadas = array_diff($this->categoriasSeleccionadas, [$categoriaId]);
        } else {
            $this->categoriasSeleccionadas[] = $categoriaId;
        }
    }

    public function guardar()
    {
        $this->validate();

        session()->flash('message', 'Reactivo validado exitosamente.');

        $reactivo = Reactivos::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'disponibilidad' => $this->disponibilidad,
            'unidad_medida' => $this->unidad_medida,
            'cantidad_disponible' => $this->cantidad_disponible,
            'codigo_indicacion_peligro' => $this->codigo_indicacion_peligro,
            'lote' => $this->lote,
            'marca' => $this->marca,
            'fabricante' => $this->fabricante,
            'url_ficha_seguridad' => $this->url_ficha_seguridad,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'estante_id' => $this->estante_id,
        ]);

        // Actualizar la posición
        Posicion::find($this->posicionSeleccionada)->update(['reactivos_id' => $reactivo->id]);

        // Adjuntar pictogramas seleccionados
        $reactivo->pictogramas()->attach($this->pictogramasSeleccionados);

        $reactivo->proveedores()->attach($this->proveedoresSeleccionados);

        $reactivo->categorias()->attach($this->categoriasSeleccionadas);

        $this->closeModal();
        session()->flash('message', 'Reactivo creado exitosamente.');
    }

    public function render()
    {
        $reactivos = Reactivos::where('codigo', 'like', '%'.$this->search.'%')
            ->orWhere('nombre', 'like', '%'.$this->search.'%')
            ->orWhere('disponibilidad', 'like', '%'.$this->search.'%')
            ->orWhere('marca', 'like', '%'.$this->search.'%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->perPage);

            $this->estantes = Estante::all();

            $pictogramas = Pictogramas::all();

            // $this->proveedores = Proveedor::where('nombre', 'like', '%'.$this->buscarProveedor.'%')->get();

            if ($this->buscarProveedor) {
                $this->proveedores = Proveedor::where('nombre', 'like', '%'.$this->buscarProveedor.'%')->get();
            } else {
                $this->proveedores = Proveedor::whereIn('id', $this->proveedoresSeleccionados)->get();
            }

            if($this->buscarCategoria){
                $categorias = Categorias::where('nombre', 'like', '%'.$this->buscarCategoria.'%')->get();
            } else {
                $categorias = Categorias::whereIn('id', $this->categoriasSeleccionadas)->get();
            }

        

        return view('livewire.reactivo-view', [
            'reactivos' => $reactivos,
            'estantes' => $this->estantes,
            'proveedores' => $this->proveedores,
            'categorias' => $categorias,
            'pictogramas' => $pictogramas,
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
