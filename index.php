<?php
// Debug opcional:
// echo "<pre>"; var_dump($_POST); echo "</pre>";

// ========== CORE ==========
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/core/conex.php";
require_once __DIR__ . "/core/AuthService.php";
require_once __DIR__ . "/core/View.php";
require_once __DIR__ . "/controllers/ExamController.php";

// ========== CONTROLADORES ==========
require_once __DIR__ . "/controllers/UserController.php";

// ========== ENRUTAMIENTO ==========
session_start(); // necesario para manejar $_SESSION

$action = $_GET["action"] ?? "home";

$auth = new AuthService($conexion);
$userController = new UserController();
$view = new View();

switch ($action) {
    case "login":
        $userController->login();
        break;

    case "logout":
        $userController->logout();
        break;

    case "register":
        $userController->register();
        break;
    case "exam":
        $examController = new ExamController($conexion);
        $examController->mostrarExamen();
        break;

    case "submit_exam":
        $examController = new ExamController($conexion);
        $examController->procesarExamen();
        break;

    case "home":
    default:
        $logueado = $auth->isLoggedIn();
        $redir_done = $_SESSION["redir_done"] ?? false;

        if ($logueado && !isset($_SESSION["redir_done"])) {
            $_SESSION["redir_done"] = true;
        }

        // Lógica de examen (renderiza form o resultado)
        $exam_html = "";
        if ($logueado) {
            $examController = new ExamController($conexion);
            ob_start();
            $examController->mostrar();
            $exam_html = ob_get_clean();
        }

        $view->section("inicio", "views/inicio.php");
        $view->section("oferta", "views/oferta.php");
        $view->section("referencias", "views/referencias.php");
        $view->section("conocete", "views/conocete.php", [
            "logueado" => $logueado,
            "redir_done" => $redir_done,
            "examen_html" => $exam_html,
        ]);

        $view->render("views/layout.php", ["auth" => $auth]);
        break;
}
