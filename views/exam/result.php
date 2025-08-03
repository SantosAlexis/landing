
<h3>📄 Descargar PDF</h3>
<button onclick="generarPDF()">Descargar Retroalimentación</button>
<p><em>Nota: Esta revisión detallada solo se mostrará una vez aquí. Pero se guardará en tu archivo de retroalimentación.</em></p>
<div id="pdf-content">
    <h2>Autoevaluación</h2>
    <p>Hola, <?= htmlspecialchars($_SESSION["username"]) ?> estos son tus resultados</p>
<?php if (isset($total)): ?>
    <p>Tu puntaje: <?= $puntaje ?> / <?= $total ?></p>
<?php else: ?>
    <p>Tu calificación: <?= $puntaje ?> (Guardado previamente)</p>
<?php endif; ?>


<?php if (isset($nivel)): ?>
    <p><strong>Nivel obtenido:</strong> <?= $nivel ?></p>
<?php endif; ?>
<p><?= $mensaje ?></p>

<hr>

<?php if (!empty($resumenCategoria)): ?>
    <hr>
    <h3>📊 Desglose por categoría</h3>
    <ul>
        <?php foreach ($resumenCategoria as $cat): ?>
            <li>
                <?= $cat["nombre"] ?>: <?= $cat["correctas"] ?>/<?= $cat["total"] ?> correctas
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (!empty($detallePorCategoria)): ?>
    <hr>
    <h3>📋 Revisión de tus respuestas por categoría</h3>
    

    <?php foreach ($detallePorCategoria as $categoria => $preguntas): ?>
        <h4>🗂 <?= $categoria ?></h4>
        <ul>
            <?php foreach ($preguntas as $detalle): ?>
                <li>
                    <strong>Pregunta:</strong> <?= $detalle["pregunta"] ?><br>
                    <strong>Tu respuesta:</strong> <?= $detalle["respuesta_marcada"] ?><br>
                    <strong>Respuesta correcta:</strong> <?= $detalle["respuesta_correcta"] ?><br>
                    <?= $detalle["correcta"] ? "✅ Correcto" : "❌ Incorrecto" ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<hr>
<a href="index.php?action=logout">Volver al inicio</a>
<script src="/landing/assets/js/html2pdf.bundle.min.js"></script>
<script>
function generarPDF() {
    const element = document.getElementById('pdf-content');
    const opt = {
        margin:       0.5,
        filename:     'retroalimentacion-examen.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
}
</script>