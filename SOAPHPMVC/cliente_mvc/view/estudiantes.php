<h1>Lista de Estudiantes</h1>
<ul>
<?php foreach($data as $estudiante): ?>
    <li><?= $estudiante["id"] ?> - <?= $estudiante["nombre"] ?> <?= $estudiante["apellido"] ?></li>
<?php endforeach; ?>
</ul>
