<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        try {
            $validator ->validate();

            $usuarios = Usuarios::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return redirect()->route('admin.canales-agua.index')
                ->with('success', 'Canal de agua creado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        }
    }
    
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        try {
            $validator ->validate();

            $usuarios = Usuarios::findOrFail($id);
            $usuarios->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return redirect()->route('admin.usuarios.index')
                ->with('success', 'El usuario a sido actualizado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $usuarios = Usuarios::findOrFail($id);
        $usuarios->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'El usuario a sido eliminado exitosamente.');
    }
}
