<?php
require_once "libs/dao.php";

// Elaborar el algoritmo de los solicitado aquí.

function getAllBooks(){
    $sqlstr = "SELECT * FROM books";
    $resultset = array();
    $resultset = obtenerRegistros($sqlstr);
    return $resultset;
}       

function getBooksById($student_id) {
    $sqlstr = "SELECT * from Books where book_id = %d;";
    return obtenerUnRegistro(sprintf($sqlstr, $book_id));
}

function getBooksPorFiltro($filtro) {
    $ffiltro = $filtro.'%';
    $sqlstr = "SELECT * from books where books_id like '%s' or book_name like '%s';";
    return obtenerRegistros(sprintf($sqlstr, $ffiltro, $ffiltro));
}

function addNewBooks($book_name, $book_date,$book_author,$book_type,$book_barcode,$book_status){
    $insSql = "INSERT INTO `books` (`book_name`, `book_date`,`book_author`,`book_type`,`book_barcode`,`book_status`)
VALUES ( '%s', '%s','%s','%s','%s','%s');";
    return ejecutarNonQuery(
        sprintf(
            $insSql,
            $book_name,
            $book_date,
            $book_author,
            $book_type,
            $book_barcode,
            $book_status
        )
    );
}
function updateBooks ($book_name, $book_date,$book_author,$book_type,$book_barcode,$book_status, $book_id) {
    $updsql = "UPDATE `books` SET  `book_name` = '%s', `book_date` = '%s', `book_author` = '%s', `book_type` = '%s', `book_barcode` = '%s', `book_status` = '%s',
    WHERE `book_id` = %d; ";
    return ejecutarNonQuery(
        sprintf(
            $updsql,
            $book_name,
            $book_date,
            $book_author,
            $book_type,
            $book_barcode,
            $book_status,
            $book_id
        )
    );
}
function deleteBooks($student_id) {
    return ejecutarNonQuery(sprintf("DELETE from books where book_id=%d;", $book_id));
}

?>
