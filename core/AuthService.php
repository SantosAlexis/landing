<?php

class AuthService
{
    private $db;

    public function __construct(mysqli $conexion)
    {
        $this->db = $conexion;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Intenta iniciar sesión con las credenciales proporcionadas.
     */
    public function login(string $username, string $password): bool
    {
        var_dump($username, $password, md5($password));

        $stmt = $this->db->prepare("SELECT id_user, user FROM user WHERE user = ? AND pass = md5(?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $user = $resultado->fetch_assoc();
            $_SESSION["user_id"] = $user["id_user"];
            $_SESSION["username"] = $user["user"];
            $_SESSION["redir_done"] = false;
            return true;
        }

        return false;
    }

    /**
     * Verifica si hay sesión iniciada.
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION["user_id"]);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }
}
