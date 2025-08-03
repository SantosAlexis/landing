<section id="selfEvalSection" class="section">
    <h1>Autoevaluación</h1>

    <?php if (!$logueado): ?>
        <?php include "registro_login.php"; ?>

    <?php else: ?>
        <?php if (!$redir_done): ?>
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.location.hash = '#selfEvalSection';
                    if (typeof navigation !== 'undefined') {
                        navigation.showSection('selfEval');
                    }
                });
            </script>
        <?php endif; ?>

        <?= $examen_html ?? "<p>No se pudo cargar el examen.</p>" ?>
    <?php endif; ?>
</section>
