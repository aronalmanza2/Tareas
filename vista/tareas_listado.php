<?php
require_once('../modelo/clsTarea.php');

$objTarea = new clsTarea();

$descripcion = $_POST['descripcion'];
$estado = $_POST['estado'];

$listaTarea = $objTarea->listarTarea($descripcion, $estado);
$listaTarea = $listaTarea->fetchAll(PDO::FETCH_NAMED);

?>

<table class="table table-sm table-bordered table-hover table-striped" id="tablaTarea">
    <thead>
        <tr class="bg-primary">
            <th>COD</th>
            <th>DESCRIPCION</th>
            <th>ESTADO</th>
            <th>EDITAR</th>
            <th>GESTIONAR</th>
            <th>ELIMINAR</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaTarea as $k => $v) {
        ?>
            <tr>
                <td><?php echo $v['idtarea']; ?></td>
                <td><?php echo $v['descripcion']; ?></td>
                <td class="text-bold"><?php echo ($v['estado'] == 1) ? 'PENDIENTE' : 'COMPLETADO'; ?></td>

                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-info" onclick="editarTarea(<?php echo $v['idtarea']; ?>)"><i class="fa fa-edit"></i> Editar</button>
                </td>

                <td class="text-center">
                    <?php if ($v['estado'] == 2) { ?>
                        <button type="button" class="btn btn-sm btn-warning" onclick="cambiarEstadoTarea(<?php echo $v['idtarea']; ?>,1)"><i class="fa fa-trash"></i> Marcar como Pendiente</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-sm btn-success" onclick="cambiarEstadoTarea(<?php echo $v['idtarea']; ?>,2)"><i class="fa fa-check"></i> Completar Tarea</button>
                    <?php } ?>
                </td>

                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger" onclick="cambiarEstadoTarea(<?php echo $v['idtarea']; ?>,0)"><i class="fa fa-times"></i> Eliminar</button>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function editarTarea(id) {
        $.ajax({
                method: 'POST',
                url: 'controlador/contTarea.php',
                data: {
                    accion: 'CONSULTAR_TAREA',
                    idtarea: id
                },
                dataType: 'json'
            })
            .done(function(resultado) {
                $('#descripcion').val(resultado.descripcion);
                $('#estado').val(resultado.estado);
                $('#idtarea').val(resultado.idtarea);
                $('#modalTarea').modal('show');
            });
    }

    $("#tablaTarea").DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        searching: false,
        ordering: true,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Todos"]
        ],
        language: {
            // url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            decimal: '',
            emptyTable: 'Sin datos',
            info: 'Del _START_ al _END_ de _TOTAL_ filas',
            infoEmpty: 'Del 0 a 0 de 0 filas',
            infoFiltered: '(filtro de _MAX_ filas totales)',
            infoPostFix: '',
            thousands: ',',
            lengthMenu: 'Ver _MENU_ filas',
            loadingRecords: 'Cargando...',
            processing: 'Procesando...',
            search: 'Buscar:',
            zeroRecords: 'No se encontraron resultados',
            paginate: {
                first: 'Primero',
                last: 'Ultimo',
                next: 'Siguiente',
                previous: 'Anterior'
            },
            aria: {
                sortAscending: ': orden ascendente',
                sortDescending: ': orden descendente'
            }
        }

    });

    function cambiarEstadoTarea(idtarea, estado) {
        let proceso = new Array('ELIMINAR', 'MARCAR COMO PENDIENTE', 'COMPLETAR');

        // alert(proceso[estado]);

        let mensaje = "¿Estás Seguro de <strong>" + proceso[estado] + "</strong> la tarea?";
        let accion = "ejecutarCambiarEstadoTarea(" + idtarea + "," + estado + ")";
        mostrarModalConfirmacion(mensaje, accion);
        // alert(mensaje);
    }

    function ejecutarCambiarEstadoTarea(idtarea, estado) {
        $.ajax({
            method: 'POST',
            url: 'controlador/contTarea.php',
            data: {
                accion: 'CAMBIAR_ESTADO_TAREA',
                idtarea: idtarea,
                estado: estado
            },
            dataType: 'json'

        }).done(function(resultado) {
            if (resultado.correcto == 1) {
                toastCorrecto(resultado.mensaje);
                verListado();
            } else {
                toastError(resultado.mensaje);
            }
        })
    }
</script>