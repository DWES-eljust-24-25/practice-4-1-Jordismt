<?php
function validate_contact($data) {
    $errors = [];
    $validatedData = [];

    // Validar Nombre
    if (empty($data['name'])) {
        $errors[] = 'El nombre es obligatorio.';
    } else {
        $validatedData['name'] = htmlspecialchars(trim($data['name']));
    }

    // Validar Apellido
    if (empty($data['surname'])) {
        $errors[] = 'El apellido es obligatorio.';
    } else {
        $validatedData['surname'] = htmlspecialchars(trim($data['surname']));
    }

    // Validar Fecha de Nacimiento
    if (empty($data['birthdate'])) {
        $errors[] = 'La fecha de nacimiento es obligatoria.';
    } else {
        $validatedData['birthdate'] = htmlspecialchars(trim($data['birthdate']));
    }

    // Validar Título
    $validatedData['title'] = !empty($data['title']) ? htmlspecialchars(trim($data['title'])) : 'Mr.';

    // Validar Teléfono
    if (empty($data['phone']) || !preg_match('/^[0-9]+$/', $data['phone'])) {
        $errors[] = 'El teléfono es obligatorio y debe ser un número válido.';
    } else {
        $validatedData['phone'] = htmlspecialchars(trim($data['phone']));
    }

    // Validar Correo Electrónico
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'El correo electrónico es obligatorio y debe ser válido.';
    } else {
        $validatedData['email'] = htmlspecialchars(trim($data['email']));
    }

    // ID y Tipo no necesitan validación

    return [$validatedData, $errors];
}
?>
