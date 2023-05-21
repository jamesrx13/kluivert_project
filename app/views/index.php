<?php
    include "./layout/header.php";
    include "./layout/nav.php";
?>


<?php
const FOLDER = "./pages/";

if (isset($_GET['page'])) {
    if (file_exists(FOLDER . $_GET['page'] . ".php")) {
        include FOLDER . $_GET['page'] . ".php";
    } else {
        include FOLDER . "404.php";
    }
} else {
    include FOLDER . "home.php";
}

?>


<?php include "./layout/footer.php" ?>