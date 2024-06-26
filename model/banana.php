
<?php

require_once "../Config/Conexion.php";

class Banana extends Conexion
{

    // Consulta para obtener las fechas ocupadas\
    protected static $cnx;

    private $nombre;

    public function __construct()
    {
    }
    public function getNombre()
    {

        return $this->nombre;
    }

    public function setNombre($nombre)
    {

        $this->nombre = $nombre;
    }
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }


public function listarBananasDb()
    {
        $query = "SELECT NOMBRE FROM TIPOS_BANANAS ";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $dato = new Banana();
                $dato->setNombre($encontrado["NOMBRE"]);               
                $arr[] = $dato;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            ;
            return json_encode($error);
        }
    }


}


