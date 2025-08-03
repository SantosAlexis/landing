<h2>Examen Interactivo</h2>
<form id="examForm" action="index.php?action=home#selfEvalSection" method="POST">
    <?php foreach ($preguntas as $index => $preg): ?>
        <div class="question-slide <?= $index === 0 ? "active" : "" ?>">
            <strong><?= htmlspecialchars($preg["texto"]) ?></strong><br>
           <?php foreach ($preg["respuestas"] as $resp): ?>
    <div>
        <input type="radio" id="resp_<?= $resp["id"] ?>" name="pregunta_<?= $preg["id"] ?>" value="<?= $resp[
    "id"
] ?>" required>
        <label class="opcion" for="resp_<?= $resp["id"] ?>">
            <?= htmlspecialchars($resp["texto"]) ?>
        </label>
    </div>
<?php endforeach; ?>
            <div class="nav-buttons">
                <?php if ($index < count($preguntas) - 1): ?>
                    <button type="button" class="next-btn">Siguiente</button>
                <?php else: ?>
                    <button type="submit">Calificar Examen</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</form>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slides = document.querySelectorAll(".question-slide");
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((s, i) => s.classList.toggle("active", i === index));
        }

        document.querySelectorAll(".next-btn").forEach((btn, index) => {
            btn.addEventListener("click", () => {
                const currentInputs = slides[index].querySelectorAll("input[type='radio']");
                const answered = Array.from(currentInputs).some(i => i.checked);

                if (!answered) {
                    alert("Por favor responde esta pregunta antes de continuar.");
                    return;
                }

                if (index + 1 < slides.length) {
                    currentSlide = index + 1;
                    showSlide(currentSlide);
                }
            });
        });

        showSlide(currentSlide);
    });
</script>
