<link rel="stylesheet" href="pages/css/home.css">

<?php

$data = $newConnect->getAllDataExecuteSQL("SELECT * FROM registro_de_diagnostico", []);
$clientes = $newConnect->getAllDataExecuteSQL("SELECT * FROM tbl_clientes", []);
$equipos = $newConnect->getAllDataExecuteSQL("SELECT * FROM tbl_equipo", []);
$currentPage = "home";

$placeName = "Nuevo diagnostico";
$btnOpt = "save";
$btnText = "Guardar";

$id = "";
$diagnostico = "";
$proceso = "";
$cliente = "";
$equipo = "";

if (isset($_GET['id'])) {
    // Edit mode
    $id = (int) $_GET['id'];
    $equipo = $newConnect->getDataExecuteSQL("SELECT * FROM tbl_diagnostico WHERE diag_id = ?", [$id]);
    if ($equipo != []) {
        $placeName = "Actualizar diagnostico";
        $btnOpt = "update";
        $btnText = "Actualizar";

        $diagnostico = $equipo['diag_diag'];
        $proceso = $equipo['diag_proceso'];
        $cliente = $equipo['diag_fk_cliente'];
        $equipo = $equipo['diag_fk_equipo'];
    } else {
        $msg = MSG_REGISTER_NOT_FOUND;
        $_SESSION[SESSION_SCRIPTS] = <<<EX
            toastr["error"]("{$msg}");
        EX;
    }
}


?>

<section class="main-content">
    <div class="head">
        <h2>Diagnosticos</h2>
        <div class="add-diag">
            <span>Nuevo diagnostio: </span>
            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-success">+</button>
        </div>
    </div>
    <br><br>
    <div class="card p-5 table-responsive">
        <table class="table table-hover" data-table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del cliente</th>
                    <th scope="col">Marca del equipo</th>
                    <th scope="col">Serial del equipo</th>
                    <th scope="col">Descripción del equipo</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Diagnostico</th>
                    <th scope="col">Proceso realizado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($data as $resgis) : ?>
                <tr>
                    <td><?= $resgis['IdDiagnostico']; ?></td>
                    <td><?= $resgis['NombreCliente']; ?></td>
                    <td><?= $resgis['MarcaDelEquipo']; ?></td>
                    <td><?= $resgis['EquipoSerial']; ?></td>
                    <td><?= $resgis['EquipoDescripcion']; ?></td>
                    <td><?= $resgis['NombreDelTecnico']; ?></td>
                    <td><?= $resgis['Diagnostico']; ?></td>
                    <td><?= $resgis['ProcesoRealizado']; ?></td>
                    <td><?= $resgis['FechaProceso']; ?></td>
                    <td>
                        <a href="?id=<?= $resgis['IdDiagnostico']; ?>" class="btn btn-primary">Editar</a>
                        <form action="<?= ROUTES_CONTROLLERS[$currentPage] ?>" method="POST" form-delete>
                            <input type="hidden" value="<?= $resgis['IdDiagnostico']; ?>" name="id_to_delete">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<!-- Modal -->
<div class="modal fade modal-xl" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?= $placeName ?></h1>
            </div>
            <div class="modal-body">
                <form action="<?= ROUTES_CONTROLLERS[$currentPage] ?>" method="POST">
                    <input type="hidden" value="<?= $id ?>" name="id_to_update">
                    <div class="row">
                        <div class="col">
                            <label for="diagnostico" class="form-label">Diagnostico</label>
                            <input type="text" id="diagnostico" name="diagnostico" class="form-control"
                                aria-labelledby="passwordHelpBlock" required value="<?= $diagnostico ?>">
                        </div>
                        <div class="col">
                            <label for="proceso" class="form-label">Proceso</label>
                            <input type="text" id="proceso" name="proceso" class="form-control"
                                aria-labelledby="passwordHelpBlock" required value="<?= $proceso ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="description" class="form-label">Cliente</label>
                            <select custom-select2 class="form-control" aria-labelledby="passwordHelpBlock" required
                                name="cliente" id="cliente">
                                <option selected value="">Seleccione un cliente</option>
                                <?php foreach ($clientes as $client) : ?>
                                <option <?php if ($cliente == $client['cli_id']) { ?> selected <?php } ?>
                                    value="<?= $client['cli_id'] ?>"><?= $client['cli_nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="equipo" class="form-label">Equipo</label>
                            <select custom-select2 class="form-control" aria-labelledby="passwordHelpBlock" required
                                name="equipo" id="equipo">
                                <option selected value="">Seleccione un equipo</option>
                                <?php foreach ($equipos as $equipt) : ?>
                                <option <?php if ($equipo == $equipt['eqp_id']) { ?> selected <?php } ?>
                                    value="<?= $equipt['eqp_id'] ?>">
                                    <?= $equipt['eqp_marca'] . " - " . $equipt['eqp_sereal'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class=" col">
                        <label for="" class="form-label">Operación</label>
                        <button class="btn btn-primary form-control" name="btn-action"
                            value="<?= $btnOpt ?>"><?= $btnText ?></button>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <a href="./" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </div>
</div>


<script>
$(() => {
    // $("select").select2();
    $("[form-delete]").on("submit", (e) => {
        e.preventDefault();
        toastr["warning"](`
            <br>
            <div class="row" >
                <div class="col">
                    <button class="btn btn-danger" btn-positive-opt >
                        Si
                    </button>
                </div>
                <div class="col">
                <button class="btn btn-secondary" btn-negative-opt>
                    No
                </button>
                </div>
            </div>
            `, "<?= MSG_ACCION_CONFIRM ?>");

        $("[btn-positive-opt]").on("click", () => {
            e.target.submit();
        })

    })

    // Mostar el modal si existe un id
    var id = getParameterByName('id');

    if (id) {
        $("[data-bs-toggle]").click();
    }

    // Obtener una variable por GET con JS vanila
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
})
</script>