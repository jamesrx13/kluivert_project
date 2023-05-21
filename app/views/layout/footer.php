        <br><br><br>
        <br><br><br>
        <br><br><br>
        <br><br><br>
        <br><br><br>
        <br><br><br>

        <script src="./../../imports/vendor/js/bootstrap.js"></script>
        <script src="./../../imports/vendor/js/toastr.min.js"></script>
        <script src="./../../imports/vendor/js/dataTable.js"></script>
        <script src="./../../imports/vendor/js/select2.js"></script>
        <script src="./../../imports/js/dataTable.js"></script>

        <!-- Ejecutar scripts eviados por la sesión -->
        <script>
            <?php
            echo $_SESSION[SESSION_SCRIPTS];
            $_SESSION[SESSION_SCRIPTS] = null;
            ?>
        </script>

        </body>

        </html>