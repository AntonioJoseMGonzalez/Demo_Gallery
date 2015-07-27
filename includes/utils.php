<?php 
    require_once("/config/db.php");
/**
* 
*/
class Utils
{
    public function Conexion()
    {
        # code...
         
        $conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
         
        if (!$conn)
            die("Tenemos problemas, regrese en unos minutos: " . mysql_error());
         
        mysql_query("SET NAMES 'utf8'");
         
        if (!mysql_select_db(DB_NAME))
            die("Tenemos problemas, regrese en unos minutos: " . mysql_error());
         
        return $conn;
    }

    //*****************************************************************************
    public function comillas_inteligentes($valor) 
    {
        # code...
        // Retirar las barras
        if (get_magic_quotes_gpc()) {
            $valor = stripslashes($valor);
        }

        // Colocar comillas si no es entero
        if (!is_numeric($valor)) {
            $valor = "'" . mysql_real_escape_string($valor) . "'";
        }
        return $valor;
    }

    //*****************************************************************************
    // Obtengo los textos limpios para usarlos como url
    public static function limpiaUrl($entra) 
    {
        # code...
        $traduce = array('á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N',
            'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u', 'Ä' => 'A', 'Ë' => 'E', 'Ï' => 'I', 'Ö' => 'O', 'Ü' => 'U');
        $sale = strtr($entra, $traduce);

        $texto = str_replace(" ", "-", $sale);

        return $texto;
    }   
}
 ?>