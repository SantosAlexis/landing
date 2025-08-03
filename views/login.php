<?php
public function login()
{
    if (isLoggedIn()) {
        header("Location: ver.php");
        exit();
    }

    $error = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["btnLogin"])) {
        $username = $_POST["userLogin"] ?? "";
        $password = $_POST["passLogin"] ?? "";

        if (login($username, $password)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }

    // La vista puede acceder a $error para mostrar mensajes
    require_once __DIR__ . '/../views/registro_login.php';
}


?>
