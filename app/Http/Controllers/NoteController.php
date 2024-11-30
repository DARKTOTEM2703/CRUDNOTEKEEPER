<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
        ]);

        Note::create($request->all());

        return redirect()->route('notes.index')->with('success', 'Nota creada correctamente.');
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
        ]);

        $note->update($request->all());

        return redirect()->route('notes.index')->with('success', 'Nota actualizada correctamente.');
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Nota eliminada correctamente.');
    }
}
