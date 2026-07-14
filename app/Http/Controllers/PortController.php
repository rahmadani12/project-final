<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $ports = Port::when($search,function($query) use ($search){

            $query->where('name','like',"%$search%")
                  ->orWhere('country','like',"%$search%");

        })
        ->orderBy('name')
        ->paginate(15);

        return view('ports.index',compact('ports','search'));
    }

    public function create()
    {
        return view('ports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
        ]);

        Port::create($request->all());

        return redirect()->route('ports.index')
            ->with('success', 'Port berhasil ditambahkan.');
    }

    public function show(Port $port)
    {
        return view('ports.show',compact('port'));
    }

    public function edit(Port $port)
    {
        return view('ports.edit',compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $request->validate([
            'name'    => 'required',
            'country' => 'required',
        ]);

        $port->update($request->all());

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil diperbarui.');
    }

   public function destroy(Port $port)
    {
        $port->delete();

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil dihapus.');
    }
}