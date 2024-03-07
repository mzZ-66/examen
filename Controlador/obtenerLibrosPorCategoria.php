<?php
include "../DAO/OperacionesLibros.php";

$db = new OperacionesLibros();
$data = json_decode(file_get_contents('php://input'), true);
$categoria = $data['categoriaSeleccionada'];

try {
    $libros = $db->obtenerLibrosPorCategoria($categoria);
    $error = null;
} catch (Exception $e) {
    $libros = null;
    $error = $e->getMessage();
}

echo json_encode(['libros' => $libros, 'error' => $error]);
?>