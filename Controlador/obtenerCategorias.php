<?php
include "../DAO/OperacionesLibros.php";

$db = new OperacionesLibros();

try {
    $categorias = $db->obtenerCategorias();
    $error = null;
} catch (Exception $e) {
    $categorias = null;
    $error = $e->getMessage();
}

echo json_encode(['categorias' => $categorias, 'error' => $error]);
?>