<?php

class ConnexionClass
{

    private $db_name;
    private $db_user;
    private $db_password;
    private $db_host;
    private $PDOConnection;

    public function __construct()
    {
        $this->db_name = DB_NAME;
        $this->db_user = DB_USER;
        $this->db_password = DB_PASSWORD;
        $this->db_host = DB_HOST;
        $this->PDOConnection = null;
    }

    /*
    * Método para establecer la conexión con la base de datos mediante PDO
    */
    public function getConnection()
    {
        try {
            $this->PDOConnection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /*
    * @String sql
    * @Arry arryParameter
    * Método para obtener muchos datos de la db mediante una consulta sql
    * Retorna un array asociativo
    */
    public function getAllDataExecuteSQL($sql, $arryParameters)
    {
        try {
            if ($this->PDOConnection != null) {
                $query = $this->PDOConnection->prepare($sql);
                if ($query->execute($arryParameters)) {
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return [];
        }
    }
    /*
    * @String sql
    * @Arry arryParameter
    * Método para obtener un dato de la db mediante una consulta sql
    * Retorna un array asociativo
    */
    public function getDataExecuteSQL($sql, $arryParameters)
    {
        try {
            if ($this->PDOConnection != null) {
                $query = $this->PDOConnection->prepare($sql);
                if ($query->execute($arryParameters)) {
                    return $query->fetch(PDO::FETCH_ASSOC);
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } catch (\Throwable $th) {
            return [];
        }
    }

    /*
    * @String sql
    * @Arry arryParameter
    * Método para setear información en la base de datos (Registrar, actualizar y eliminar)
    * Retorna un true o folse si la acción fue exitosa o no
    */
    public function modifiquedDataOnDB($sql, $arryParameters)
    {
        try {
            if ($this->PDOConnection != null) {
                $query = $this->PDOConnection->prepare($sql);
                if ($query->execute($arryParameters)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
