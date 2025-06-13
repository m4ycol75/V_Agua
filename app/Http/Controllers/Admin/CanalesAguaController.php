<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChannelWater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CanalesAguaController extends Controller
{
    
    public function index()
    {
        return view('admin.canales-agua.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'channel' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $validator ->validate();

            $channelWater = ChannelWater::create([
                'channel' => $request->channel,
                'description' => $request->description,
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
            'channel' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $validator ->validate();

            $channelWater = ChannelWater::findOrFail($id);
            $channelWater->update([
                'channel' => $request->channel,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.canales-agua.index')
                ->with('success', 'Canal de agua actualizado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $channelWater = ChannelWater::findOrFail($id);
        $channelWater->delete();

        return redirect()->route('admin.canales-agua.index')
            ->with('success', 'Canal de agua eliminado exitosamente.');
    }
}
