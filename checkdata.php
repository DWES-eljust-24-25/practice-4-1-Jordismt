<?php
session_start();
?>

<?php include 'partials/header.php'; ?>

<div class="container mt-5">
    <h2>Datos del Contacto</h2>

    <?php if (isset($_SESSION['contact'])): ?>
        <p>¡Sin errores!</p>
        <ul>
            <li>ID: <?php echo htmlspecialchars($_SESSION['contact']['id']); ?></li>
            <li>Título: <?php echo htmlspecialchars($_SESSION['contact']['title']); ?></li>
            <li>Nombre: <?php echo htmlspecialchars($_SESSION['contact']['name']); ?></li>
            <li>Apellido: <?php echo htmlspecialchars($_SESSION['contact']['surname']); ?></li>
            <li>Fecha de Nacimiento: <?php echo htmlspecialchars($_SESSION['contact']['birthdate']); ?></li>
            <li>Teléfono: <?php echo htmlspecialchars($_SESSION['contact']['phone']); ?></li>
            <li>Correo Electrónico: <?php echo htmlspecialchars($_SESSION['contact']['email']); ?></li>
            <li>Favorito: <?php echo htmlspecialchars($_SESSION['contact']['favourite'] ? 'Sí' : 'No'); ?></li>
            <li>Importante: <?php echo htmlspecialchars($_SESSION['contact']['important'] ? 'Sí' : 'No'); ?></li>
            <li>Archivado: <?php echo htmlspecialchars($_SESSION['contact']['archived'] ? 'Sí' : 'No'); ?></li>
        </ul>
    <?php else: ?>
        <p>No hay datos de contacto disponibles.</p>
    <?php endif; ?>
</div>

<?php include 'partials/footer.php'; ?>
