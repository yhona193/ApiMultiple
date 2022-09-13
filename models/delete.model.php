<?php

require_once "connection.php";
require_once "get.model.php";

class DeleteModel{

	/*=============================================
	Peticion Delete para eliminar datos de forma dinámica
	=============================================*/

    static public function deleteData($schema, $table, $id, $nameId){

		/*=============================================
		Validar el ID
		=============================================*/

        $response = GetModel:: getDataFilter($schema, $table, $nameId, $nameId, $id, null, null,null, null);

        if(empty($response)){
            return null;
        }

		/*=============================================
		Eliminamos registros
		=============================================*/

        $sql = "DELETE FROM $schema.$table WHERE $nameId = :$nameId";

        $link = Connection::connect();
        $stmt = $link->prepare($sql);
        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);
        if($stmt -> execute()){
            $response = array(
                "comment" => "Eliminado con exito"
            );
            return $response;
        }else{
            return $link->errorInfo();
        }
    }

    
}