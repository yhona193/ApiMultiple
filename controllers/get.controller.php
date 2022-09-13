<?php

require_once "models/get.model.php";

class GetController{

	/*=============================================
	Peticiones GET sin filtro
	=============================================*/

    static public function getData($schema, $table, $select, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getData($schema, $table, $select, $orderBy, $orderMode,$startAt,$endAt);

        $return = new GetController();

        $return -> fncResponse($response);

    }

	/*=============================================
	Peticiones GET con filtro
	=============================================*/
    
    static public function getDataFilter($schema, $table, $select, $linkTo, $equalTo, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getDataFilter($schema, $table, $select,$linkTo, $equalTo, $orderBy, $orderMode,$startAt,$endAt);

        $return = new GetController();

        $return -> fncResponse($response);
    
    }

	/*=============================================
	Peticiones GET sin filtro entre tablas relacionadas
	=============================================*/

    static public function getRelData($schema, $rel, $type, $nameFk, $select, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getRelData($schema, $rel, $type,$nameFk, $select, $orderBy, $orderMode,$startAt,$endAt);
    
        $return = new GetController();
    
        $return -> fncResponse($response);
    
    }

	/*=============================================
	Peticiones GET con filtro entre tablas relacionadas
	=============================================*/

    static public function getRelDataFilter($schema, $rel, $type,$nameFk, $select, $linkTo, $equalTo, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getRelDataFilter($schema, $rel, $type,$nameFk, $select, $linkTo, $equalTo, $orderBy, $orderMode,$startAt,$endAt);
            
        $return = new GetController();
            
        $return -> fncResponse($response);
            
    }

	/*=============================================
	Peticiones GET para el buscador sin relaciones
	=============================================*/
    static public function getDataSearch($schema, $table, $select, $linkTo, $search, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getDataSearch($schema, $table, $select,$linkTo, $search, $orderBy, $orderMode,$startAt,$endAt);

        $return = new GetController();

        $return -> fncResponse($response);

    }
	/*=============================================
	Peticiones GET para el buscador entre tablas relacionadas
	=============================================*/
    
    static public function getRelDataSearch($schema, $rel, $type,$nameFk, $select, $linkTo, $search, $orderBy, $orderMode,$startAt,$endAt){

        $response = GetModel::getRelDataSearch($schema, $rel, $type,$nameFk, $select, $linkTo, $search, $orderBy, $orderMode,$startAt,$endAt);
                
        $return = new GetController();
        
                
        $return -> fncResponse($response);
                
    }

	/*=============================================
	Respuestas del controlador
	=============================================*/

      public function fncResponse($response){

          if(!empty($response)){
              $json = array(

                  'status' => 200,
                  'total' => count($response),
                  'results' => $response
            
              );
              }else{
              $json = array(

                  'status' => 404,
                  'results' => 'Not Found',
                  'method' => 'get'
            
              );


          }

          echo json_encode($json, http_response_code($json["status"]));

      }

}