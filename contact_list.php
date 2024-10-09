<?php
session_start();

// Cargar los datos de los contactos desde data.php si no están ya en la sesión
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = require 'data.php';
}
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-5">
    <h2>Lista de Contactos</h2>
    <a href="contact_form.php" class="btn btn-primary mb-3">Crear nuevo contacto</a>

    <?php if (!empty($_SESSION['contacts'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['contacts'] as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['id']); ?></td>
                        <td><?php echo htmlspecialchars($contact['title']); ?></td>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['surname']); ?></td>
                        <td>
                            <a href="contact_form.php?id=<?php echo htmlspecialchars($contact['id']); ?>" class="btn btn-warning">Editar/Ver</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay contactos disponibles.</p>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>
