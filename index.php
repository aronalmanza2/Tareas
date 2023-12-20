<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Tareas</title>

    <!-- BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- DATATABLES CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid">
        <h1 class="text-center">Mis Tareas</h1>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Listado de Tareas</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tarea</span>
                            </div>
                            <input type="text" class="form-control" name="txtBusquedaDescripcion" id="txtBusquedaDescripcion" onkeyup="if(event.keyCode=='13'){verListado();}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Estado</span>
                            </div>
                            <select class="form-control" name="cboBusquedaEstado" id="cboBusquedaEstado" onchange="verListado()">
                                <option value="">- Todos -</option>
                                <option value="1">Pendientes</option>
                                <option value="2">Completados</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary" onclick="verListado()"><i class="fa fa-search"></i> Buscar</button>
                        <button type="button" class="btn btn-success" onclick="openModalTarea()"><i class="fa fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-success">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="divListadoTarea"></div>
                </div>
            </div>
        </div>

        <!-- Modal Tarea -->
        <div class="modal fade" id="modalTarea">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Formulario Tarea</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="formTarea" id="formTarea">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="descripcion">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" autocomplete="off" />
                                        <input type="hidden" class="form-control" name="idtarea" id="idtarea" />
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="1">PENDIENTE</option>
                                            <option value="2">COMPLETADO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                        <button type="button" class="btn btn-success" onclick="registrarTarea()"><i class="fa fa-save"></i> Registrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>

    <!-- /.modal de confirmacion-->
    <div class="modal fade" id="modalConfirmacion">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Confirmar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mensaje_confirmacion">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <div id="boton_confirmacion">

                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- JQUERY JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js" integrity="sha512-KgffulL3mxrOsDicgQWA11O6q6oKeWcV00VxgfJw4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- DATATABLES JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function mostrarModalConfirmacion(mensaje, accion) {
            $("#mensaje_confirmacion").html(mensaje);

            btn_html = '<button type="button" class="btn btn-primary" onclick="CerrarModalConfirmacion();' + accion + '">Confirmar</button>';

            $("#boton_confirmacion").html(btn_html);
            $("#modalConfirmacion").modal("show");
        }

        function CerrarModalConfirmacion() {
            $("#modalConfirmacion").modal("hide");
        }

        function toastCorrecto(mensaje) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });

        }

        function toastError(mensaje) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });
        }


        function verListado() {
            $.ajax({
                method: "POST",
                url: "vista/tareas_listado.php",
                data: {
                    descripcion: $("#txtBusquedaDescripcion").val(),
                    estado: $("#cboBusquedaEstado").val(),
                },
            }).done(function(resultado) {
                $("#divListadoTarea").html(resultado);
            });
        }

        verListado();

        function openModalTarea() {
            $("#modalTarea").modal("show");
            $("#idtarea").val("");
            $("#formTarea").trigger("reset");
        }

        function registrarTarea() {
            if (verificarFormulario()) {
                let datax = $("#formTarea").serializeArray();
                let idtarea = $("#idtarea").val();

                if (idtarea != "") {
                    datax.push({
                        name: "accion",
                        value: "ACTUALIZAR",
                    });
                } else {
                    datax.push({
                        name: "accion",
                        value: "NUEVO",
                    });
                }

                $.ajax({
                    method: "POST",
                    url: "controlador/contTarea.php",
                    data: datax,
                    dataType: "json",
                }).done(function(resultado) {
                    if (resultado.correcto == 1) {
                        toastCorrecto(resultado.mensaje);
                        $("#modalTarea").modal("hide");
                        $("#formTarea").trigger("reset");
                        verListado();
                    } else {
                        toastError(resultado.mensaje);
                    }
                });
            }
        }

        function verificarFormulario() {
            let correcto = true;
            let descripcion = $("#descripcion").val();
            if (descripcion == "") {
                toastError("Ingrese el descripcion de la Tarea");
                correcto = false;
            }

            return correcto;
        }
    </script>

</body>

</html>