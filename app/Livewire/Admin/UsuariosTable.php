<?php

namespace App\Livewire\Admin;

use App\Models\Usuarios;
use Livewire\Component;

class UsuariosTable extends Component
{
    public function render()
    {
        $usuarios = Usuarios::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.usuarios-table', compact('usuarios'));
    }
}
