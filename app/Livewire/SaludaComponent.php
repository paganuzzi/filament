<?php

namespace App\Livewire;

use App\Services\HolaService;
use Livewire\Component;

class SaludaComponent extends Component
{
    public string $nombre;

    public function saluda(HolaService $hola)
    {
        $this->nombre = $hola->saludar();
    }

    public function render()
    {
        return view('livewire.saluda-component');
    }
}
