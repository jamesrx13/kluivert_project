<link rel="stylesheet" href="pages/css/home.css">

<?php

$data = $newConnect->getAllDataExecuteSQL("SELECT * FROM tbl_clientes", []);
$currentPage = "clientes";

// Register mode
$acordiontShow = "";
$acordiontClass = "collapsed";
$placeName = "Añadir cliente";
$btnOpt = "save";
$btnText = "Guardar";

$id = "";
$name = "";
$ccNit = "";
$phone = "";
$email = "";
$address = "";

if (isset($_GET['id'])) {
    // Edit mode
    $id = (int) $_GET['id'];
    $user = $newConnect->getDataExecuteSQL("SELECT * FROM tbl_clientes WHERE cli_id = ?", [$id]);
    if ($user != []) {
        $acordiontClass = "";
        $acordiontShow = "show";
        $placeName = "Actualizar cliente";
        $btnOpt = "update";
        $btnText = "Actualizar";

        $name = $user['cli_nombre'];
        $ccNit = $user['cli_cc_nit'];
        $phone = $user['cli_telefono'];
        $email = $user['cli_correo'];
        $address = $user['cli_direccion'];
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
        <h2>Clientes</h2>
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
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $name ?>">
                            </div>
                            <div class="col">
                                <label for="cc_nit" class="form-label">CC / NIT</label>
                                <input type="number" id="cc_nit" name="cc_nit" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $ccNit ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="phone" class="form-label">Télefono</label>
                                <input type="phone" id="phone" name="phone" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $phone ?>">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" id="email" name="email" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $email ?>">
                            </div>
                        </div>
                        <br>
                        <div class=" row">
                            <div class="col">
                                <label for="addres" class="form-label">Dirección</label>
                                <input type="text" id="addres" name="addres" class="form-control" aria-labelledby="passwordHelpBlock" required value="<?= $address ?>">
                            </div>
                            <div class=" col">
                                <label for="" class="form-label">Operación</label>
                                <button class="btn btn-primary form-control" name="btn-action" value="<?= $btnOpt ?>"><?= $btnText ?></button>
                            </div>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">CC / NIT</th>
                    <th scope="col">Télefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($data as $resgis) : ?>
                    <tr>
                        <td><?= $resgis['cli_id']; ?></td>
                        <td><?= $resgis['cli_nombre']; ?></td>
                        <td><?= $resgis['cli_cc_nit']; ?></td>
                        <td><?= $resgis['cli_telefono']; ?></td>
                        <td><?= $resgis['cli_correo']; ?></td>
                        <td><?= $resgis['cli_direccion']; ?></td>
                        <td>
                            <a href="?page=<?= $currentPage ?>&id=<?= $resgis['cli_id']; ?>" class="btn btn-primary">Editar</a>
                            <form action="<?= ROUTES_CONTROLLERS[$currentPage] ?>" method="POST" form-delete>
                                <input type="hidden" value="<?= $resgis['cli_id']; ?>" name="id_to_delete">
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