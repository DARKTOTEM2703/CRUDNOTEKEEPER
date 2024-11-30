<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Mostrar todas las notas (API)
    public function index()
    {
        return response()->json(Note::all());  // Devolver todas las notas en formato JSON
    }

    // Crear una nueva nota (API)
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]);

        $note = Note::create($request->all());  // Crear la nueva nota

        return response()->json($note, 201);  // Devolver la nota creada
    }

    // Mostrar una nota específica (API)
    public function show(Note $note)
    {
        return response()->json($note);  // Devolver la nota solicitada en formato JSON
    }

    // Editar una nota (API)
    public function edit(Note $note)
    {
        return response()->json($note);  // Devolver la nota para editar
    }

    // Actualizar una nota (API)
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]);

        $note->update($request->all());  // Actualizar la nota

        return response()->json($note);  // Devolver la nota actualizada
    }

    // Eliminar una nota (API)
    public function destroy(Note $note)
    {
        $note->delete();  // Eliminar la nota

        return response()->json(['message' => 'Nota eliminada correctamente']);
    }
}
