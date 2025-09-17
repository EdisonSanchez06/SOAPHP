<h1>Lista de Productos</h1>
<a href="?action=crear">➕ Crear nuevo producto</a>
<ul>
<?php foreach ($productos as $p): ?>
    <li>
        <?= $p['nombre'] ?> - $<?= $p['precio'] ?> (Stock: <?= $p['stock'] ?>)
        <a href="?action=editar&id=<?= $p['id'] ?>">✏️ Editar</a>
    </li>
<?php endforeach; ?>
</ul>
