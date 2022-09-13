<?php
require_once "vendor/autoload.php";
use Firebase\JWT\JWT;

class Connection{

    /*=============================================
	Conexión a la base de datos
	=============================================*/

        static public function connect(){

            /*=============================================
            Información de la base de datos
            =============================================*/
            $host = '192.168.0.1,1435';
            $dbname = 'BDUPLA';
            $username = 'desarrollo';
            $password = 'desarrolloxx';
            $puerto = '';

            try{


                $conexion = new PDO("sqlsrv:server=$host;database=$dbname", "$username", "$password");

            }catch(PDOException $e){

                die("Error no se logro la conexion: ".$e->getMessage());

            }

            return $conexion;



        }


        /*==================================================
        VALIDAR EXISTENCIA DE UNA TABLA EN LA BASE DE DATOS
        ==================================================*/

        static public function getColumnsData($schema, $table, $columns){


            /*=============================================
            Traer todas las columnas de una tabla
            =============================================*/

            $validate = Connection::connect()
            ->query("SELECT COLUMN_NAME AS item FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$schema' AND TABLE_NAME = '$table'")
            ->fetchAll(PDO::FETCH_OBJ);

            /*=============================================
            validamos existencia de la tabla
            =============================================*/

            if(empty($validate)){

                return null;

            }else{

                /*=============================================
                ajuste de seleccion de columnas globales
                =============================================*/

                if($columns[0] == "*"){

                    array_shift($columns);
                }

                /*=============================================
                VALIDAMOS EXISTENCIA DE COLUMNAS
                =============================================*/

                $sum = 0;

                foreach ($validate as $key => $value) {

                   $sum += in_array($value->item, $columns);


                }

                return $sum == count($columns) ? $validate : null;
            }

        }

	/*=============================================
	Generar Token de Autenticación
	=============================================*/

	static public function jwt($id, $email){


		$time = time();

		$token = array(

		 	"iat" =>  $time,//Tiempo en que inicia el token
		 	"exp" => $time + (60*60*24), // Tiempo en que expirará el token (1 día)
		 	"data" => [
		 		"id" => $id,
		 		"email" => $email,
                 "ip" => $_SERVER['REMOTE_ADDR']
	     	]
		 ); 

		//  return $token;
        $jwt = JWT::encode($token, "dfhsdfg34dfchs4xgsrsdry46", $alg = 'HS256');


         echo '<pre>'; print_r($jwt); echo '</pre>';
	}
        /*=============================================
        APIKEY
        =============================================*/

        // static public function apikey(){

        //     return "V8Tpjd9f9DtYY8d3ijuQS2UdfmnRXh";

        // }

	}

