
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro y Búsqueda de Materias</title>
</head>
<body>
    
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


try {
    $db = new PDO('mysql:host=localhost;dbname=universidad;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
       
        $nombre = $_POST['nombre'];
        $profesor = $_POST['profesor'];

     
        echo "Materia añadida con éxito.";
    } elseif (isset($_POST['search'])) {
    
        $nombre = $_POST['nombre_buscar'];

        $stmt = $db->prepare("SELECT * FROM MATERIA WHERE nombre LIKE ?");
        $stmt->execute(['%' . $nombre . '%']);
        $materia = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

    <h1>Registro de Materia</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre de la materia:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="profesor">Profesor:</label>
        <input type="text" id="profesor" name="profesor" required>
        <br>
        <input type="submit" name="add" value="Añadir Materia">
    </form>

    <h1>Buscar Materia</h1>
    <form method="POST" action="">
        <label for="nombre_buscar">Nombre de la materia:</label>
        <input type="text" id="nombre_buscar" name="nombre_buscar" required>
        <br>
        <input type="submit" name="search" value="Buscar">
    </form>

    <?php if (isset($materia)): ?>
        <h2>Resultados de la Búsqueda:</h2>
        <ul>
            <?php foreach ($materia as $materia): ?>
                <li><?php echo htmlspecialchars($materia['nombre']) . " - " . htmlspecialchars($materia['profesor']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
