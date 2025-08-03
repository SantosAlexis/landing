<?php
require_once __DIR__ . "/../core/AuthService.php";
require_once __DIR__ . "/../core/conex.php";

class UserController
{
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthService($GLOBALS["conexion"]);
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = $_POST["userLogin"] ?? "";
            $pass = $_POST["passLogin"] ?? "";

            if ($this->auth->login($user, $pass)) {
                $_SESSION["redir_done"] = false;
                $_SESSION["redirect_to_section"] = "selfEvalSection"; // Para scroll automático
            } else {
                $_SESSION["login_error"] = "Credenciales incorrectas.";
                $_SESSION["redirect_to_section"] = "selfEvalSection";
            }

            header("Location: " . BASE_URL . "index.php");
            exit();
        }
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = $_POST["userReg"] ?? "";
            $pass1 = $_POST["pass1"] ?? "";
            $pass2 = $_POST["pass2"] ?? "";

            if (empty($user) || empty($pass1) || empty($pass2)) {
                $_SESSION["register_error"] = "Todos los campos son obligatorios.";
            } elseif ($pass1 !== $pass2) {
                $_SESSION["register_error"] = "Las contraseñas no coinciden.";
            } else {
                $stmt = $GLOBALS["conexion"]->prepare("SELECT id_user FROM user WHERE user = ?");
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $_SESSION["register_error"] = "El usuario ya existe.";
                } else {
                    $stmt = $GLOBALS["conexion"]->prepare("INSERT INTO user (user, pass) VALUES (?, md5(?))");
                    $stmt->bind_param("ss", $user, $pass1);
                    if ($stmt->execute()) {
                        $_SESSION["user_id"] = $GLOBALS["conexion"]->insert_id;
                        $_SESSION["username"] = $user;
                        $_SESSION["redir_done"] = false;
                    } else {
                        $_SESSION["register_error"] = "Error al registrar el usuario.";
                    }
                }
            }

            $_SESSION["redirect_to_section"] = "selfEvalSection";
            header("Location: " . BASE_URL . "index.php");
            exit();
        }
    }

    public function logout()
    {
        $this->auth->logout();
        header("Location: " . BASE_URL . "index.php");
        exit();
    }
}
