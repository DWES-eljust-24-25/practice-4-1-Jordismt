<?php
session_start();
require_once 'functions.php';

// Inicializar variables
$id = '';
$title = 'Mr.';
$name = '';
$surname = '';
$birthdate = '';
$phone = '';
$email = '';
$favourite = false;
$important = false;
$archived = false;

// Asegurar que la sesión de contactos esté inicializada
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = require 'data.php'; // Cargar contactos de data.php en la sesión
}

// Verificar si se está editando un contacto
if (isset($_GET['id'])) {
    $contactId = $_GET['id'];
    // Buscar el contacto por ID
    foreach ($_SESSION['contacts'] as $contact) {
        if ($contact['id'] == $contactId) {
            // Cargar datos del contacto encontrado
            $id = $contact['id'];
            $title = $contact['title'];
            $name = $contact['name'];
            $surname = $contact['surname'];
            $birthdate = $contact['birthdate'];
            $phone = $contact['phone'];
            $email = $contact['email'];
            $favourite = $contact['favourite'];
            $important = $contact['important'];
            $archived = $contact['archived'];
            break;
        }
    }
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    list($validatedData, $errors) = validate_contact($_POST);

    if (empty($errors)) {
        // Guardar o actualizar datos
        if (!empty($_POST['id'])) {
            // Actualizar el contacto existente
            foreach ($_SESSION['contacts'] as &$contact) {
                if ($contact['id'] == $_POST['id']) {
                    $contact = array_merge($contact, $validatedData);
                    // Guardar los datos del contacto actualizado en la sesión para checkdata.php
                    $_SESSION['contact'] = $contact; // Solo guarda el contacto actualizado
                    break;
                }
            }
        } else {
            // Crear un nuevo contacto
            $validatedData['id'] = count($_SESSION['contacts']) + 1; // Asigna un nuevo ID
            $_SESSION['contacts'][] = $validatedData; // Agrega el nuevo contacto
            // Guardar los datos del nuevo contacto en la sesión para checkdata.php
            $_SESSION['contact'] = $validatedData; // Solo guarda el nuevo contacto
        }

        header('Location: checkdata.php');
        exit();
    } else {
        // Mostrar errores
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
        }
    }
}
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-5">
    <h2>Formulario de Contacto</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="id" value="<?php echo htmlspecialchars($id); ?>" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Título</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="title" value="Mr." <?php echo ($title == 'Mr.') ? 'checked' : ''; ?>>
                <label class="form-check-label">Sr.</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="title" value="Mrs." <?php echo ($title == 'Mrs.') ? 'checked' : ''; ?>>
                <label class="form-check-label">Sra.</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="title" value="Miss" <?php echo ($title == 'Miss') ? 'checked' : ''; ?>>
                <label class="form-check-label">Srta.</label>
            </div>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Fecha de nacimiento</label>
            <input type="date" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" >
        </div>
        <div class="form-group">
            <label>Tipo</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="favourite" <?php echo $favourite ? 'checked' : ''; ?>>
                <label class="form-check-label">Favorito</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="important" <?php echo $important ? 'checked' : ''; ?>>
                <label class="form-check-label">Importante</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="archived" <?php echo $archived ? 'checked' : ''; ?>>
                <label class="form-check-label">Archivado</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo empty($id) ? 'Guardar' : 'Actualizar'; ?></button>
        <a href="contact_list.php" class="btn btn-secondary">Volver a la lista</a>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
