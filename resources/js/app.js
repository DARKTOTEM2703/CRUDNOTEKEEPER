import './bootstrap';

$(document).ready(function() {
    // Inicializa el datepicker con el formato de año en 2 dígitos
    $('#fecha').datepicker({
        dateFormat: 'yy-mm-dd', // Formato: año con 2 dígitos, mes y día
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2100' // Opcional, puedes definir un rango de años
    });
});


$(document).ready(function () {
    $('#posts-table').DataTable({
        "pageLength": 5, // Número inicial de elementos por página
        "lengthMenu": [1, 5, 10, 20, 100], // Opciones para seleccionar elementos por página
        "order": [[0, 'asc']], // Ordenar por la primera columna por defecto
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
