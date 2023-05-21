<link rel="stylesheet" href="pages/css/home.css">

<?php

$data = $newConnect->getAllDataExecuteSQL("SELECT * FROM tbl_equipo", []);
$currentPage = "equipos";

// Register mode
$acordiontShow = "";
$acordiontClass = "collapsed";
$placeName = "Añadir equipo";
$btnOpt = "save";
$btnText = "Guardar";

$id = "";
$marca = "";
$serial = "";
$description = "";
$ram = "";
$discoDuro = "";
$procesador = "";

if (isset($_GET['id'])) {
    // Edit mode
    $id = (int) $_GET['id'];
    $equipo = $newConnect->getDataExecuteSQL("SELECT * FROM tbl_equipo WHERE eqp_id = ?", [$id]);
    if ($equipo != []) {
        $acordiontClass = "";
        $acordiontShow = "show";
        $placeName = "Actualizar equipo";
        $btnOpt = "update";
        $btnText = "Actualizar";

        $marca = $equipo['eqp_marca'];
        $serial = $equipo['eqp_sereal'];
        $description = $equipo['eqp_descripcion'];
        $ram = $equipo['eqp_ram'];
        $discoDuro = $equipo['eqp_tipo_disco_duro'];
        $procesador = $equipo['eqp_procesador'];
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
        <h2>Equipos</h2>
    </div>
    <br><br>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?= $acordiontClass ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="">
                    <?= $placeName; ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?= $acordiontShow ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body text-md-start">
                    <form action="<?= ROUTES_CONTROLLERS[$currentPage] ?>" method="POST">
                        <input type="hidden" value="<?= $id ?>" name="id_to_update">
                        <div class="row">
                            <div class="col">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" id="marca" name="marca" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $marca ?>">
                            </div>
                            <div class="col">
                                <label for="serial" class="form-label">Serial</label>
                                <input type="text" id="serial" name="serial" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $serial ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="description" class="form-label">Descripción</label>
                                <input type="text" id="description" name="description" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $description ?>">
                            </div>
                            <div class="col">
                                <label for="ram" class="form-label">Ram</label>
                                <input type="number" id="ram" name="ram" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $ram ?>">
                            </div>
                        </div>
                        <br>
                        <div class=" row">
                            <div class="col">
                                <label for="disco_duro" class="form-label">Disco Duro</label>
                                <input type="text" id="disco_duro" name="disco_duro" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $discoDuro ?>">
                            </div>
                            <div class="col">
                                <label for="procesador" class="form-label">Procesador</label>
                                <input type="text" id="procesador" name="procesador" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $procesador ?>">
                            </div>
                        </div>
                        <br>
                        <div class=" col">
                            <label for="" class="form-label">Operación</label>
                            <button class="btn btn-primary form-control" name="btn-action" value="<?= $btnOpt ?>"><?= $btnText ?></button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="card p-5 table-responsive">
        <table class="table table-hover" data-table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Serial</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Ram</th>
                    <th scope="col">Disco Duro</th>
                    <th scope="col">Procesador</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($data as $resgis) : ?>
                    <tr>
                        <td><?= $resgis['eqp_id']; ?></td>
                        <td><?= $resgis['eqp_marca']; ?></td>
                        <td><?= $resgis['eqp_sereal']; ?></td>
                        <td><?= $resgis['eqp_descripcion']; ?></td>
                        <td><?= $resgis['eqp_ram']; ?></td>
                        <td><?= $resgis['eqp_tipo_disco_duro']; ?></td>
                        <td><?= $resgis['eqp_procesador']; ?></td>
                        <td>
                            <a href="?page=<?= $currentPage ?>&id=<?= $resgis['eqp_id']; ?>" class="btn btn-primary">Editar</a>
                            <form action="<?= ROUTES_CONTROLLERS[$currentPage] ?>" method="POST" form-delete>
                                <input type="hidden" value="<?= $resgis['eqp_id']; ?>" name="id_to_delete">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    $(() => {
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
    })
</script>