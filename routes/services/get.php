<?php

require_once "controllers/get.controller.php";


$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;

$response = new GetController();

/**=================================
 * PETICIONES GET CON FILTRO
 * =================================
 */

if(isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["rel"]) && !isset($_GET["type"])){

    $response -> getDataFilter($schema,$table,$select,$_GET["linkTo"],$_GET["equalTo"],$orderBy,$orderMode,$startAt,$endAt);

    /**================================================
     * PETICIONES GET SIN FILTRO ENTRE TABLAS RELACIONADAS
     * ==================================================
     * 
     */
    }else if (isset($_GET["rel"]) && isset($_GET["type"] )  && isset($_GET["nameFk"] ) && $table == "relations" && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){
        
        $response -> getRelData($schema, $_GET["rel"], $_GET["type"], $_GET["nameFk"], $select, $orderBy,$orderMode,$startAt,$endAt);

    

    /*==================================================
      PETICIONES GET con FILTRO ENTRE TABLAS RELACIONADAS
     ==================================================*/

    }else if (isset($_GET["rel"]) && isset($_GET["type"]) && isset($_GET["nameFk"] ) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["equalTo"])){
            
        $response -> getRelDataFilter($schema, $_GET["rel"], $_GET["type"], $_GET["nameFk"], $select,$_GET["linkTo"],$_GET["equalTo"],$orderBy,$orderMode,$startAt,$endAt);
    
    /*=============================================
    Peticiones GET para el buscador sin relaciones
    =============================================*/

    }else if(!isset($_GET["rel"]) && !isset($_GET["type"]) && isset($_GET["linkTo"]) && isset($_GET["search"])){

        $response -> getDataSearch($schema, $table, $select,$_GET["linkTo"],$_GET["search"],$orderBy,$orderMode,$startAt,$endAt);

    /*=============================================
    Peticiones GET para el buscador con relaciones
    =============================================*/

    }else if (isset($_GET["rel"]) && isset($_GET["type"]) && isset($_GET["nameFk"] ) && $table == "relations" && isset($_GET["linkTo"]) && isset($_GET["search"])){
            
        $response -> getRelDataSearch($schema, $_GET["rel"], $_GET["type"], $_GET["nameFk"], $select,$_GET["linkTo"],$_GET["search"],$orderBy,$orderMode,$startAt,$endAt);

    }else{

    /** ===============================
     * PETICIONES GET SIN FILTRO
     * ================================
     */

    $response -> getData($schema, $table, $select,$orderBy,$orderMode,$startAt,$endAt);
}

