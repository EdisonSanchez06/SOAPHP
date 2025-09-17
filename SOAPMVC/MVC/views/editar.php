<h2>Editar Producto</h2>
<form method="POST" action="?action=editar">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required><br>
    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br>
    <label>Stock:</label><br>
    <input type="number" name="stock" value="<?= $producto['stock'] ?>" required><br><br>
    <button type="submit">Actualizar</button>
</form>
