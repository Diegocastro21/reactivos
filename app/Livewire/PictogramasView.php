<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class PictogramasView extends Component
{

    public $imagenes = [];

    public function mount()
    {
        // Obtener todas las imágenes en la carpeta 'public/images/pictogramas'
        // Obtener todas las imágenes en la carpeta 'public/images/pictogramas'
        $files = File::files(public_path('images/pictogramas'));

        // Convertir cada archivo en una ruta accesible desde el navegador
        foreach ($files as $file) {
            $this->imagenes[] = asset('images/pictogramas/' . $file->getFilename());
        }
    }


    public function render()
    {
        return view('livewire.pictogramas-view');
    }

    

    
}
