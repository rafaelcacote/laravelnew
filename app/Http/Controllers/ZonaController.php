<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
use Inertia\Inertia;

class ZonaController extends Controller
{

    public function index(Request $request)
    {
        $query = Zona::query();



        if ($request->filled('search')) {

            $query->where('nome', 'like', "%{$request->search}%");
        }

        return Inertia::render('Zonas/Index', [
            'zonas' => $query->paginate(10),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Zonas/Create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
