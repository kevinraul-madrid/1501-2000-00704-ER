<?php

require_once "models/examendata.model.php";
function run()
{
    $viewData = array();
    $viewData["book_txtfilter"] = "";
    if (isset($_SESSION["book_txtfilter"])) {
        $viewData["book_txtfilter"] = $_SESSION["book_txtfilter"];
    }
    if (isset($_POST["btnFiltrar"])) {
        mergeFullArrayTo($_POST, $viewData);
        $_SESSION["book_txtfilter"] = $viewData["book_txtfilter"];
    }
    if ($viewData["book_txtfilter"] === "") {
        $viewData["Books"] = getAllBooks();
    } else {
        $viewData["Books"] = getBooksPorFiltro($viewData["cat_txtfilter"]);
    }



    renderizar("examenlist", $viewData);
}

run();
?>
