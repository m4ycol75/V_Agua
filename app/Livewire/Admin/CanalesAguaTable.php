<?php

namespace App\Livewire\Admin;

use App\Models\ChannelWater;
use Livewire\Component;

class CanalesAguaTable extends Component
{
    public function render()
    {
        // Asegúrate de que el nombre de la variable sea correcto
        $channelWaters = ChannelWater::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.canales-agua-table', compact('channelWaters')); // Usa 'channelWaters' aquí
    }
}