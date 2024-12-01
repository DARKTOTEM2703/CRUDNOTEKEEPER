@extends('layouts.app')

@section('template_title')
    Posts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong><h4>Note Keeper</h4></strong>
                            </span>

                            <div class="float-right">
                                <a href="{{ route('posts.create') }}" class="float-right btn btn-primary btn-sm" data-placement="left">
                                    {{ __('Crear nota') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="m-4 alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="posts-table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->titulo }}</td>
                                            <td>{{ $post->autor }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar?');">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Bootstrap DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <!-- jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#posts-table').DataTable({
                "pageLength": 5, // Número inicial de elementos por página
                "lengthMenu": [1, 5, 10, 20, 100], // Opciones para seleccionar elementos por página
                "order": [[0, 'asc']], // Ordenar por la primera columna (Título) por defecto
                "language": {
                    "lengthMenu": "Mostrar _MENU_ elementos",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ elementos",
                    "infoEmpty": "No hay elementos disponibles",
                    "infoFiltered": "(filtrado de _MAX_ elementos totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
@endpush
