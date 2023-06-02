<?php
require_once 'controllers/itemController.php';

// Obtener la acción solicitada desde la cadena de consulta
$action = $_GET['action'] ?? 'index';

// Crear el controlador de items y llamar al método de acción correspondiente
$controller = new ItemController();

if ($action === 'index') {
    $controller->index();
} elseif ($action === 'create') {
    $controller->create();
} elseif ($action === 'store') {
    $data = [
        'nombre' => $_POST['nombre'],
    ];
    $controller->store($data);
} elseif ($action === 'show') {
    $id = $_GET['id'] ?? null;
    $controller->show($id);
} elseif ($action === 'edit') {
    $id = $_GET['id'] ?? null;
    $controller->edit($id);
} elseif ($action === 'update') {
    $id = $_GET['id'] ?? null;
    $data = [
        'nombre' => $_POST['nombre'],
    ];
    $controller->update($id, $data);
} elseif ($action === 'delete') {
    $id = $_GET['id'] ?? null;
    $controller->delete($id);
} else {
    // Manejar acción inválida
    echo 'Acción inválida';
}

?>