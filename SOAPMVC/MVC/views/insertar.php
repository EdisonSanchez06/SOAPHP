<h2>Crear Producto</h2>
<form method="POST" action="?action=crear">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br>
    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" required><br>
    <label>Stock:</label><br>
    <input type="number" name="stock" required><br><br>
    <button type="submit">Guardar</button>
</form>
