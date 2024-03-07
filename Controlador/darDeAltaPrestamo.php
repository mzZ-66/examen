<?php
include "../DAO/OperacionesPrestamos.php";
include "../DAO/OperacionesEjemplares.php";
include "../DAO/OperacionesSocios.php";
include "../Modelo/Prestamos.php";

$jsonData = json_decode(file_get_contents('php://input'), true);
$dniSocio = $jsonData['dniSocio'];
$isbn = $jsonData['isbn'];

try {
    // $operacionesSocios = new OperacionesSocios();
    // $operacionesSocios->comprobarDevolucionSocio($dniSocio);

    $operacionesEjemplares = new OperacionesEjemplares();
    $codigoEjemplar = $operacionesEjemplares->asignarEjemplarPorIsbn($isbn);
    
    $nuevoPrestamo = new Prestamos(null, $dniSocio, $codigoEjemplar, date('Y-m-d'), date('Y-m-d', strtotime('+7 days')), null);

    $operacionesPrestamos = new OperacionesPrestamos();
    $operacionesPrestamos->darDeAltaPrestamo($nuevoPrestamo);

    $error = null;
} catch (Exception $e) {
    $error = $e->getMessage();
}

echo json_encode(['error' => $error]);
?>