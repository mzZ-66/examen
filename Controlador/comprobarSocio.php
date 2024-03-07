<?php
include "../DAO/OperacionesSocios.php";

$db = new OperacionesSocios();
$dniSocio = $_POST['dniSocio'];

try {
    $db->comprobarSocio($dniSocio);
    $dniSocioExiste = $dniSocio;
    $error = null;
} catch (Exception $e) {
    $dniSocioExiste = null;
    $error = $e->getMessage();
}

echo json_encode(['dniSocioExiste' => $dniSocioExiste, 'error' => $error]);
?>