<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estante;
use App\Models\Reactivos;
use App\Models\Proveedor;

class DashboardCards extends Component
{

    public $totalEstantes;
    public $totalReactivos;
    public $totalProveedores;

    public function mount()
    {
        $this->totalEstantes = Estante::count();
        $this->totalReactivos = Reactivos::count();
        $this->totalProveedores = Proveedor::count();
    }

    public function render()
    {
        return view('livewire.dashboard-cards');
    }
}
