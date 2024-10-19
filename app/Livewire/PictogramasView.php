<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use App\Models\Pictogramas;
use App\Models\Categorias;

class PictogramasView extends Component
{


    

    public function render()
    {

        $pictogramas = Pictogramas::all();

        $categorias = Categorias::all();

        return view('livewire.pictogramas-view', [
            'pictogramas' => $pictogramas,
            'categorias' => $categorias,
        ]);
    }

    
}
