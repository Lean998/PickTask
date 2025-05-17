-<h1>Editar Tarea</h1>
<form action="<?= base_url('tarea/actualizar') ?>" method="post">
    <input type="hidden" name="id" value="<?= esc($tarea['id']) ?>">

    <label>Título:</label>
    <input type="text" name="titulo" value="<?= esc($tarea['titulo']) ?>" required><br>

    <label>Descripción:</label>
    <textarea name="descripcion"><?= esc($tarea['descripcion']) ?></textarea><br>

    <label>Prioridad:</label>
    <select name="prioridad">
        <option value="baja" <?= $tarea['prioridad'] == 'baja' ? 'selected' : '' ?>>Baja</option>
        <option value="normal" <?= $tarea['prioridad'] == 'normal' ? 'selected' : '' ?>>Normal</option>
        <option value="alta" <?= $tarea['prioridad'] == 'alta' ? 'selected' : '' ?>>Alta</option>
    </select><br>

    <label>Fecha de vencimiento:</label>
    <input type="date" name="fecha_vencimiento" value="<?= esc($tarea['fecha_vencimiento']) ?>"><br>

    <label>Fecha de recordatorio:</label>
    <input type="date" name="fecha_recordatorio" value="<?= esc($tarea['fecha_recordatorio']) ?>"><br>

    <label>Color:</label>
    <input type="text" name="color" value="<?= esc($tarea['color']) ?>"><br>

    <button type="submit">Actualizar</button>
</form>