<p><strong>Pon a prueba tus habilidades</strong></p>
  <p>Realiza un diagnóstico rápido (menos de 5 minutos) y descubre una <strong>ruta de aprendizaje personalizada</strong> según tu nivel.</p>

  <ul>
    <li>Fácil y rápido</li>
    <li>Resultados inmediatos</li>
    <li>Recomendaciones hechas para ti</li>
  </ul>

  <p>Si ya tienes cuenta, <strong>inicia sesión</strong> para comenzar tu evaluación.</p>
  <p>Si aún no la tienes, <strong>regístrate</strong> y empieza ahora mismo.</p>
  <p>Y si ya realizaste la prueba, ¡puedes <strong>consultar tus resultados</strong> iniciando sesión!</p>


<section class="auth-tabs">
    
    <?php if (!empty($_SESSION["login_error"])): ?>
    <div class="error">
        <?= $_SESSION["login_error"] ?>
        <?php unset($_SESSION["login_error"]); ?>
    </div>
<?php endif; ?>
    <?php if (!empty($_SESSION["register_error"])): ?>
    <div class="error">
        <?= $_SESSION["register_error"] ?>
        <?php unset($_SESSION["register_error"]); ?>
    </div>
<?php endif; ?>
    
  
    
    <div class="tabs-header">
        <button id="loginTab" class="active">Iniciar Sesión</button>
        <button id="registerTab">Registrarse</button>
    </div>

    <div class="login_card">
        <div id="loginForm" class="tab-content active">
            <h2>Iniciar sesión</h2>

           

            <form method="POST" action="<?= BASE_URL ?>index.php?action=login">
                <input type="text" name="userLogin" placeholder="Usuario" required>
                <input type="password" name="passLogin" placeholder="Contraseña" required>
                <button type="submit" name="btnLogin">Iniciar Sesión</button>
            </form>
        </div>

        <div id="registerForm" class="tab-content">
            <h2>Registrarse</h2>

            

            <form method="POST" action="<?= BASE_URL ?>index.php?action=register">
                <input type="text" name="userReg" placeholder="Usuario" required>
                <input type="password" name="pass1" placeholder="Contraseña" required>
                <input type="password" name="pass2" placeholder="Confirmar contraseña" required>
                <button type="submit" name="btnRegistrar">Registrar</button>
            </form>
        </div>
    </div>
</section>
<script src="/landing/assets/js/tabs.js"></script>