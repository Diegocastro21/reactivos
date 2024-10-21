<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estante;
use App\Models\Reactivos;
use App\Models\Proveedor;
use App\Models\RegistroHistorico;

class DashboardCards extends Component
{

    public $totalEstantes;
    public $totalReactivos;
    public $totalProveedores;
    public $movimientosGlobales;


    public function mount()
    {
        $this->totalEstantes = Estante::count();
        $this->totalReactivos = Reactivos::count();
        $this->totalProveedores = Proveedor::count();

        // Cargar los últimos 10 movimientos globales
        $this->movimientosGlobales = RegistroHistorico::with(['reactivo', 'usuario'])
            ->orderBy('fecha_movimiento', 'desc')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard-cards');
    }
}
