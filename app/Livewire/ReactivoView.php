<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reactivos;
use App\Models\Estante;
use App\Models\Posicion;
use App\Models\Pictogramas;
use App\Models\Proveedor;
use App\Models\Categorias;
use App\Models\RegistroHistorico;
use Livewire\WithPagination;
use App\Models\DivisionUbicacionReactivo;
use App\Mail\ReactivosAlerta;
use Illuminate\Support\Facades\Mail;

class ReactivoView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sort = 'id';
    public $direction = 'desc';

    public $modal = false;

    public $verModal = false;
    public $editarModal = false;

    public $registroModal = false;

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

    public $cantidad;
    public $tipo_transaccion;
    public $descripcion;
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

    public $historial = [];

    public $proveedores = [];

    public $miReactivo = null;
    public $miReactivoDos = null;

    // public $estantes;
    // public $niveles = [];
    // public $columnas = [];

    // protected $rules = [
    //     'codigo' => 'required|string|max:255',
    //     'nombre' => 'required|string|max:255',
    //     'disponibilidad' => 'required|in:total,media,poca,no hay',
    //     'unidad_medida' => 'required|in:g,mg,ml,l',
    //     'cantidad_disponible' => 'required|numeric',
    //     'codigo_indicacion_peligro' => 'required|string|max:255',
    //     'lote' => 'required|string|max:255',
    //     'marca' => 'required|string|max:255',
    //     'fabricante' => 'required|string|max:255',
    //     'url_ficha_seguridad' => 'required|url|max:255',
    //     'fecha_vencimiento' => 'required|date|after:today',
    //     // 'nivel_reactivo' => 'required|string',
    //     // 'columna_estante' => 'required|string',

    //     'cantidad' => 'required|numeric',
    //     'descripcion' => 'required|string',
    //     'tipo_transaccion' => 'required|in:entrada,salida,de baja,donacion,prestamo',
    //     'estante_id' => 'required|exists:estante,id',
    // ];


    protected function reglasParaReactivo()
    {
        return [
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
            'estante_id' => 'required|exists:estante,id',
        ];
    }

    protected function reglasParaTransaccion()
    {
        return [
            'cantidad' => 'required|numeric|min:0.01',
            'tipo_transaccion' => 'required|in:entrada,salida,de baja,donacion,prestamo',
            'descripcion' => 'required|string|max:255',
        ];
    }

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

    public function openModal(Reactivos $reactivo = null)
    {


        // logger('Entro a openModal');  
        if($reactivo){

            // logger('Entro a openModal con reactivo');

            $this->miReactivo = $reactivo;

            // logger('Reactivo: '.$this->miReactivo);

            $this->codigo = $reactivo->codigo;
            $this->nombre = $reactivo->nombre;
            $this->disponibilidad = $reactivo->disponibilidad;
            $this->unidad_medida = $reactivo->unidad_medida;
            $this->cantidad_disponible = $reactivo->cantidad_disponible;
            $this->codigo_indicacion_peligro = $reactivo->codigo_indicacion_peligro;
            $this->lote = $reactivo->lote;
            $this->marca = $reactivo->marca;
            $this->fabricante = $reactivo->fabricante;
            $this->url_ficha_seguridad = $reactivo->url_ficha_seguridad;
            $this->fecha_vencimiento = $reactivo->fecha_vencimiento ? $reactivo->fecha_vencimiento->format('Y-m-d') : null;
            $this->estante_id = $reactivo->estante_id;


            // Cargar relaciones y asignarlas a las propiedades correspondientes
            $this->pictogramasSeleccionados = $reactivo->pictogramas->pluck('id')->toArray();
            $this->proveedoresSeleccionados = $reactivo->proveedores->pluck('id')->toArray();
            $this->categoriasSeleccionadas = $reactivo->categorias->pluck('id')->toArray();


            // Cargar la posición seleccionada
            $posicion = Posicion::where('reactivos_id', $reactivo->id)->first();
            $this->posicionSeleccionada = $posicion ? $posicion->id : null;
            $this->cargarPosiciones();

            // logger('Cargando posiciones');

        }else {

            // logger('Entro a openModal sin reactivo');

            $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'historial', 'estante_id']);

        }
        
        $this->modal = true;
    }

    public function openVerModal(Reactivos $reactivo)
    {

       
        $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'historial', 'estante_id']);

        $this->codigo = $reactivo->codigo;
        $this->nombre = $reactivo->nombre;
        $this->disponibilidad = $reactivo->disponibilidad;
        $this->unidad_medida = $reactivo->unidad_medida;
        $this->cantidad_disponible = $reactivo->cantidad_disponible;
        $this->codigo_indicacion_peligro = $reactivo->codigo_indicacion_peligro;
        $this->lote = $reactivo->lote;
        $this->marca = $reactivo->marca;
        $this->fabricante = $reactivo->fabricante;
        $this->url_ficha_seguridad = $reactivo->url_ficha_seguridad;
        $this->fecha_vencimiento = $reactivo->fecha_vencimiento->format('Y-m-d');
        $this->estante_id = $reactivo->estante_id;

        $this->historial = RegistroHistorico::where('reactivos_id', $reactivo->id)
        ->with('usuario')
        ->orderBy('fecha_movimiento', 'desc')
        ->get();

        // Cargar relaciones y asignarlas a las propiedades correspondientes
        $this->pictogramasSeleccionados = $reactivo->pictogramas->pluck('id')->toArray();
        $this->proveedoresSeleccionados = $reactivo->proveedores->pluck('id')->toArray();
        $this->categoriasSeleccionadas = $reactivo->categorias->pluck('id')->toArray();


        // Cargar la posición seleccionada
        $posicion = Posicion::where('reactivos_id', $reactivo->id)->first();
        $this->posicionSeleccionada = $posicion ? $posicion->id : null;
        $this->cargarPosiciones();


        $this->verModal = true;
    }

    public function openRegistroModal(Reactivos $reactivo = null, $transaccion_actual = null){

        if($reactivo){

            $this->miReactivoDos = $reactivo;
            $this->nombre = $reactivo->nombre;
            $this->disponibilidad = $reactivo->disponibilidad;
            $this->unidad_medida = $reactivo->unidad_medida;
            $this->cantidad_disponible = $reactivo->cantidad_disponible;

            $this->tipo_transaccion = $transaccion_actual;
            

        }else {

            $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento', 'pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'miReactivoDos', 'historial', 'estante_id']);

        }
        
        $this->registroModal = true;
    }

    public function closeRegistroModal(){


        $this->registroModal = false;
        $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento','pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'miReactivoDos', 'historial', 'estante_id']);
    }


    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento','pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'historial', 'estante_id']);
    }

    public function closeVerModal()
    {
        $this->verModal = false;
        $this->reset(['tipo_transaccion','cantidad','descripcion','codigo', 'nombre', 'disponibilidad', 'unidad_medida', 'cantidad_disponible', 'codigo_indicacion_peligro', 'lote', 'marca', 'fabricante', 'url_ficha_seguridad', 'fecha_vencimiento','pictogramasSeleccionados', 'proveedoresSeleccionados', 'categoriasSeleccionadas', 'buscarCategoria', 'buscarProveedor', 'miReactivo', 'historial', 'estante_id']);
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


    public function usarOIngresar(){


        // $this->validate();
        $this->validate($this->reglasParaTransaccion());

        if ($this->tipo_transaccion === 'entrada') {
            $this->miReactivoDos->cantidad_disponible += $this->cantidad;
            // Asegurarse de que la cantidad no exceda la cantidad disponible

            $this->actualizarDisponibilidad();
            // Guardar el historial
            RegistroHistorico::create([
                'descripcion' => $this->descripcion,
                'fecha_movimiento' => now(),
                'cantidad' => $this->cantidad,
                'tipo_transaccion' => $this->tipo_transaccion,
                'user_id' => auth()->user()->id,
                'reactivos_id' => $this->miReactivoDos->id,
            ]);

            $this->miReactivoDos->save();
        
        } else {
            if ($this->cantidad > $this->miReactivoDos->cantidad_disponible) {
                $this->addError('cantidad', 'La cantidad excede la cantidad disponible.');
                return;
            }

            $this->miReactivoDos->cantidad_disponible -= $this->cantidad;

            $this->actualizarDisponibilidad();
            // Guardar el historial
            RegistroHistorico::create([
                'descripcion' => $this->descripcion,
                'fecha_movimiento' => now(),
                'cantidad' => $this->cantidad,
                'tipo_transaccion' => $this->tipo_transaccion,
                'user_id' => auth()->user()->id,
                'reactivos_id' => $this->miReactivoDos->id,
            ]);

            $this->miReactivoDos->save();
        }

        // Ajustar la disponibilidad automáticamente
        

        

        
        $this->closeRegistroModal();
        session()->flash('message', 'Transacción realizada exitosamente.');

    }

    // Actualizar la disponibilidad del reactivo
    protected function actualizarDisponibilidad()
    {
        $cantidad_reactivo = $this->miReactivoDos->cantidad_disponible;
        $unidad = $this->miReactivoDos->unidad_medida;
        $disponibilidadAnterior = $this->miReactivoDos->disponibilidad;

        if ($cantidad_reactivo <= 0) {
            $this->miReactivoDos->disponibilidad = 'no hay';
        } elseif (in_array($unidad, ['g', 'mg'])) {
            // Para sólidos
            if ($cantidad_reactivo < 100) {
                $this->miReactivoDos->disponibilidad = 'poca';
            } elseif ($cantidad_reactivo < 500) {
                $this->miReactivoDos->disponibilidad = 'media';
            } else {
                $this->miReactivoDos->disponibilidad = 'total';
            }
        } elseif (in_array($unidad, ['ml', 'l'])) {
            // Para líquidos
            if ($cantidad_reactivo < 250) {
                $this->miReactivoDos->disponibilidad = 'poca';
            } elseif ($cantidad_reactivo < 1000) {
                $this->miReactivoDos->disponibilidad = 'media';
            } else {
                $this->miReactivoDos->disponibilidad = 'total';
            }
        } else {
            // Para otras unidades de medida no especificadas
            $this->miReactivoDos->disponibilidad = 'poca'; // O cualquier otro valor por defecto que prefieras
        }

        // Si la disponibilidad cambia a 'poca' o 'no hay' y no es la misma que antes, enviar correo
        if (in_array($this->miReactivoDos->disponibilidad, ['poca', 'no hay']) &&
            $this->miReactivoDos->disponibilidad !== $disponibilidadAnterior) {
            
            $mensaje = $this->miReactivoDos->disponibilidad === 'no hay' 
                ? 'Este reactivo ya se ha agotado.'
                : 'El reactivo está a punto de agotarse.';
            
            // Enviar correo al usuario (puedes especificar el correo del administrador o usuario relevante)
            Mail::to(auth()->user()->email)->send(new ReactivosAlerta($this->miReactivoDos, $mensaje));
        }

        $this->miReactivoDos->save();
    }



    public function guardarOActualizar()
    {
        

        // $this->validate();

        $this->validate($this->reglasParaReactivo());


        session()->flash('message', 'Reactivo validado exitosamente.');

       

        if(isset($this->miReactivo->id)){
            logger('valido reactivo id');  
           
            $this->miReactivo->update([
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
            // Posicion::find($this->posicionSeleccionada)->update(['reactivos_id' => $this->miReactivo->id]);

            // Liberar la posición anterior
            Posicion::where('reactivos_id', $this->miReactivo->id)->update(['reactivos_id' => null]);

            // Asignar la nueva posición
            Posicion::find($this->posicionSeleccionada)->update(['reactivos_id' => $this->miReactivo->id]);

        

            // Actualizar pictogramas
            $this->miReactivo->pictogramas()->sync($this->pictogramasSeleccionados);

            $this->miReactivo->proveedores()->sync($this->proveedoresSeleccionados);

            $this->miReactivo->categorias()->sync($this->categoriasSeleccionadas);


            $this->closeModal();
            session()->flash('message', 'Reactivo Actualizado exitosamente.');


        }else {

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
