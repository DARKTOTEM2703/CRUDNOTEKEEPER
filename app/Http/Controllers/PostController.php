<?php

// Definir el espacio de nombres del controlador
namespace App\Http\Controllers;

// Importar las clases necesarias
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

// Definir la clase del controlador
class PostController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     */
    public function index(Request $request): View
    {
        // Obtener una paginación de los posts
        $posts = Post::paginate();

        // Retornar la vista con los posts y el índice de la página
        return view('post.index', compact(var_name: 'posts'))
            ->with('i', ($request->input('page', 1) - 1) * $posts->perPage());
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     */
    public function create(): View
    {
        // Crear una nueva instancia de Post
        $post = new Post();

        // Retornar la vista para crear un post
        return view('post.create', compact('post'));
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        // Crear un nuevo post con los datos validados del request
        Post::create($request->validated());

        // Redirigir a la lista de posts con un mensaje de éxito
        return Redirect::route('posts.index')
            ->with('success', 'Añadido correctamente.');
    }

    /**
     * Mostrar el recurso especificado.
     */
    public function show($id): View
    {
        // Encontrar el post por su ID
        $post = Post::find($id);

        // Retornar la vista para mostrar el post
        return view('post.show', compact('post'));
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     */
    public function edit($id): View
    {
        // Encontrar el post por su ID
        $post = Post::find($id);

        // Retornar la vista para editar el post
        return view('post.edit', compact('post'));
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        // Actualizar el post con los datos validados del request
        $post->update($request->validated());

        // Redirigir a la lista de posts con un mensaje de éxito
        return Redirect::route('posts.index')
            ->with('success', 'Actualizado correctamente.');
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy($id): RedirectResponse
    {
        // Encontrar y eliminar el post por su ID
        Post::find($id)->delete();

        // Redirigir a la lista de posts con un mensaje de éxito
        return Redirect::route('posts.index')
            ->with('success', 'Eliminado correctamente.');
    }
}