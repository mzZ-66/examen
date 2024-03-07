<?php
include "../DAO/OperacionesPrestamos.php";
include "enviarMail.php";

try {
    $db = new OperacionesPrestamos();
    $emailsSocios = $db->obtenerEmailsSociosConRetraso();

    foreach ($emailsSocios as $email) {
        $emailUsuario = $email['email'];
        enviarMail("Recordatorio de devolución", "Tiene libros pendientes de devolver", $emailUsuario);
    }

    $devolucionesComprobadas = 'Se han comprobado las devoluciones';
    $error = null;
} catch (Exception $e) {
    $devolucionesComprobadas = null;
    $error = $e->getMessage();
}

echo json_encode(['devolucionesComprobadas' => $devolucionesComprobadas, 'error' => $error]);
?>