<?php

require_once "connection.php";

class PostModel{

    /*=============================================
	PETICION POST PARA CREAR DATOS DE FORMA DINAMICA 
	=============================================*/	

    static public function postData($schema, $table, $data){

        $columns = "";
        $params = "";

         foreach ($data as $key => $value) {
           
             $columns .= $key.",";
             $params .= ":".$key.",";
        }

        $columns = substr($columns, 0, -1);
        $params =   substr($params, 0, -1);


        $sql = "INSERT INTO $schema.$table ($columns) VALUES ($params)";

        $link = Connection::connect();

        $stmt = $link->prepare($sql);

         foreach ($data as $key => $value) {
          
            $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);

        }

        if($stmt -> execute()){

            $response = array(

                "lastId" => $link->lastInsertId(),
                "comment" => "Registrado con exito"
            );
            
            return $response;

        }else{

            return $link->errorInfo();
        }
        

     }
}