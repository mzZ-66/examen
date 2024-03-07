<?php
include "../DAO/OperacionesEjemplares.php";

$db = new OperacionesEjemplares();
$data = json_decode(file_get_contents('php://input'), true);
$isbn = $data['isbn'];

try {
    $hayEjemplares = $db->comprobarEjemplaresPorIsbn($isbn);
    $error = null;
} catch (Exception $e) {
    $hayEjemplares = null;
    $error = $e->getMessage();
}

echo json_encode(['hayEjemplares' => $hayEjemplares, 'error' => $error]);
?>