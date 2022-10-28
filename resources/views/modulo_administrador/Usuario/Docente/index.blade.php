@extends('admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    
    @livewire('modulo-administrador.usuario.docente')

@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $('#tablaDocente').DataTable({
        autoWidth: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por páginas",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "order": "desc",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.38/dist/sweetalert2.all.min.js"></script>

<script>
    
    // window.addEventListener('modalCrear', () => {
    //     $('#newCoordinador').modal('hide');
    // })

    // window.addEventListener('modalActualizar', event => {
    //     // alert('Name updated to: ' + event.detail.id);
    //     var modal = '#updateCoordinador' + event.detail.id;
    //     // alert(modal);
    //     // $('#editModal'+event.detail.id).modal('hide');
    //     $(modal).modal('hide');
    // })

    window.addEventListener('delete', event => {
        // alert('Name updated to: ' + event.detail.id);
        Swal.fire({
            title: 'Estas seguro?',
            text: "Una vez eliminado no habrá vuelta atras!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('modulo-administrador.usuario.docente', 'deleteDocente', event.detail.id);
                Swal.fire(
                    'Eliminado!',
                    'El coordinador ha sido eliminado.',
                    'success'
                )
            }
        })
    })
</script>
@endsection