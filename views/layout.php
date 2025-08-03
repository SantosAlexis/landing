<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoevaluación</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   
    <?php
    $authLocal = $auth ?? null;
    include "header.php";
    ?>

    <main>
        <?= $inicio ?? "" ?>
        <?= $oferta ?? "" ?>
        <?= $referencias ?? "" ?>
        <?= $conocete ?? "" ?>
    </main>

    <?php include "footer.php"; ?>

<?php if (isset($_SESSION["redirect_to_section"])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sectionId = "<?= $_SESSION["redirect_to_section"] ?>";
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: "smooth" });
                window.location.hash = "#" + sectionId;

                // Simular navegación si usas tabs/secciones dinámicas
                if (typeof navigation !== 'undefined' && typeof navigation.showSection === 'function') {
                    navigation.showSection(sectionId.replace("Section", ""));
                }

                // Alternativamente, simular un clic si tu UI depende de eso
                const navLink = document.querySelector(`a[href="#${sectionId}"]`);
                if (navLink) navLink.click();
            }
        });
    </script>
    <?php unset($_SESSION["redirect_to_section"]); ?>
<?php endif; ?>

</html>
