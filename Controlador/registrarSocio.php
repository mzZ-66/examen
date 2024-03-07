<?php
include "../DAO/OperacionesSocios.php";
include "../Modelo/Socios.php";

$db = new OperacionesSocios();
$dniSocio = $_POST['dniSocio'];
$nombreSocio = $_POST['nombreSocio'];
$direccionSocio = $_POST['direccionSocio'];
$emailSocio = $_POST['emailSocio'];

try {
    $nuevoSocio = new Socios($dniSocio, $nombreSocio, $direccionSocio, $emailSocio);
    $db->registrarSocio($nuevoSocio);
    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
}

echo json_encode(['error' => $error]);
?>