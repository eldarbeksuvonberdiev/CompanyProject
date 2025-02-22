<?php

namespace App\Livewire\Manufacturer;

use Livewire\Component;

class ManufacturerComponent extends Component
{

    public $name = 'Elbek';

    public function render()
    {
        return view('livewire.manufacturer.manufacturer-component');
    }
}
