<!----CREATE TABLE IF NOT EXISTS `books` (
  `book_id` BIGINT(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_name` VARCHAR(45) NOT NULL,
  `book_date` DATE NOT NULL,
  `book_author` VARCHAR(255) NOT NULL,
  `book_type` CHAR(3) NULL,
  `book_barcode` VARCHAR(45) NULL,
  `book_status` CHAR(3) NOT NULL,
  PRIMARY KEY (`book_id`))
ENGINE = InnoDB;



<?php

require_once "models/examendata.model.php";
function run()
{
    $viewData = array();
    $viewData=array();
    $viewData["mode"] = "";
    $viewData["modedsc"] = "";
    $viewData["bookcod"] = 0;
    $viewData["booknom"] = "" ;
    $viewData["bookdate"] = "";
    $viewData["bookauthor"] = "FEM";
    $viewData["booktype"] = "";
    $viewData["bookbarcode"] = "";
    $viewData["bookesta"] = "ACT";

    $viewData["bookauthor_FEM"] = "selected";
    $viewData["bookauthor_MASC"] = "";

    $viewData["bookesta_ACT"] = "selected";
    $viewData["bookesta_INA"] = "";

    $viewData["readonly"] = "";
    $viewData["deletemsg"] = "";
  
    $modedsc = array(
      "INS"=>"Nuevo libro",
      "UPD"=>"Actualizar libro %s",
      "DEL"=>"Eliminar libro %s",
      "DSP"=>"Detalle de libro %s"
    );
    if (isset($_GET["mode"])) {
        $viewData["mode"] = $_GET["mode"];
        $viewData["bookmod"] = intval($_GET["bookcod"]);
        if (!isset($modedsc[$viewData["mode"]])) {
            redirectWithMessage("No se puede realizar esta operación.", "index.php?page=examenlist");
            die();
        }
    }

    if (isset($_POST["btnsubmit"])) {
        mergeFullArrayTo($_POST, $viewData);
        //Verificacion de XSS_Token
        if (!(isset($_SESSION["cln_csstoken"]) && $_SESSION["cln_csstoken"] == $viewData["xsstoken"])) {
            redirectWithMessage("No se puede realizar esta operación.", "index.php?page=examenlist");
            die();
        }
        // Validaciones de Entrada de Datos
        switch ($viewData["mode"]){
        case "INS":
            $result = addNewBooks(
                $viewData["booknom"], 
                $viewData["bookdate"], 
                $viewData["bookauthor"], 
                $viewData["booktype"], 
                $viewData["bookbarcode"],
                $viewData["bookesta"]
            );
            if ($result > 0) {
                redirectWithMessage("Libro guardado Exitosamente", "index.php?page=examenlist");
                die();
            }
            break;
        case "UPD":
            $result = updateBooks(
                $viewData["booknom"], 
                $viewData["bookdate"], 
                $viewData["bookauthor"], 
                $viewData["booktype"], 
                $viewData["bookbarcode"],
                $viewData["bookesta"]
                $viewData["bookcod"]
            );
            if ($result >= 0) {
                redirectWithMessage("Libro actualizado Exitosamente", "index.php?page=examenlist");
                die();
            }
            break;
        case "DEL":
            $result = deleteBooks($viewData["bookcod"]);
            if ($result > 0) {
                redirectWithMessage("Libro eliminado Exitosamente", "index.php?page=examenlist");
                die();
            }
            break;
        }
    }
    if ($viewData["mode"] === "INS") {
        $viewData["modedsc"] = $modedsc[$viewData["mode"]];
    } else {
        $BooksDBData = getStudentsById($viewData["bookcod"]);
        mergeFullArrayTo($BookDBData, $viewData);
        $viewData["modedsc"] = sprintf($modedsc[$viewData["mode"]], $viewData["stunom"]);
        $viewData["bookauthor_FEM"] = ($viewData["Bookauthor"]=="FEM")?"selected":"";
        $viewData["bookauthor_MASC"] = ($viewData["Bookauthor"]=="MASC")?"selected":"";
        $viewData["bookesta_ACT"] = ($viewData["bookesta"]=="ACT")?"selected":"";
        $viewData["bookesta_INA"] = ($viewData["bookesta"]=="INA")?"selected":"";
        
        // Sacar la data de la DB
        if ($viewData["mode"] != 'UPD') {
            $viewData["readonly"] = "readonly";
        }
        if ($viewData["mode"] == 'DEL') {
            $viewData["deletemsg"] = "Esta Seguro de Eliminar este registro, es una operación definitiva.";
        }
    }
    // Crear un token unico
    // Guardar en sesión ese token unico para su verificación posterior
    $viewData["xsstoken"] = uniqid("cln", true);
    $_SESSION["cln_csstoken"] = $viewData["xsstoken"];


    renderizar("examenform", $viewData);
}

run();
?>
