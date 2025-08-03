<?php

class ExamModel
{
    private $conexion;

    public function __construct(mysqli $conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerPreguntas()
    {
        $stmt = $this->conexion->query("SELECT * FROM preguntas ORDER BY RAND() LIMIT 10");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerRespuestas($pregunta_id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM respuestas WHERE pregunta_id = ?");
        $stmt->bind_param("i", $pregunta_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function esRespuestaCorrecta($pregunta_id, $respuesta_id)
    {
        $stmt = $this->conexion->prepare("
            SELECT 1 FROM respuestas 
            WHERE id = ? AND pregunta_id = ? AND es_correcta = 1
        ");
        $stmt->bind_param("ii", $respuesta_id, $pregunta_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function obtenerCategoriaPregunta($pregunta_id)
    {
        $stmt = $this->conexion->prepare("SELECT id_cat FROM preguntas WHERE id = ?");
        $stmt->bind_param("i", $pregunta_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["id_cat"] ?? null;
    }

    /* public function guardarResultado($user_id, $nivel, $calificacion, $retro)
    {
        $stmt = $this->conexion->prepare("
            INSERT INTO resultados (id_user_reg, nivel, calificacion, retroalimentacion)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isis", $user_id, $nivel, $calificacion, $retro);
        return $stmt->execute();
    }*/
    public function guardarResultado($userId, $nivel, $calificacion, $retroalimentacion)
    {
        // Verificar si ya existe un resultado
        $stmt = $this->conexion->prepare("SELECT id FROM resultados WHERE id_user_reg = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Ya hay un resultado, no insertes de nuevo
            return false;
        }

        // Insertar si no existe
        $stmt = $this->conexion->prepare(
            "INSERT INTO resultados (id_user_reg, nivel, calificacion, retroalimentacion) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $userId, $nivel, $calificacion, $retroalimentacion);
        return $stmt->execute();
    }

    public function obtenerPreguntaPorId(int $id): array
    {
        $stmt = $this->conexion->prepare("SELECT p.id, p.texto, c.nombre AS categoria
                                FROM preguntas p
                                JOIN categorias c ON p.id_cat = c.id
                                WHERE p.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerResumenPorCategoria(array $respuestasUsuario): array
    {
        foreach ($respuestasUsuario as $preguntaId => $respuestaId) {
            $stmt = $this->conexion->prepare("
            SELECT p.id_cat, c.nombre AS categoria_nombre, r.es_correcta
            FROM preguntas p
            JOIN categorias c ON p.id_cat = c.id
            JOIN respuestas r ON r.pregunta_id = p.id AND r.id = ?
            WHERE p.id = ?
        ");

            $stmt->bind_param("ii", $respuestaId, $preguntaId);
            $stmt->execute();
            $stmt->bind_result($idCat, $nombreCat, $esCorrecta);

            if ($stmt->fetch()) {
                if (!isset($resumen[$idCat])) {
                    $resumen[$idCat] = [
                        "nombre" => $nombreCat,
                        "correctas" => 0,
                        "total" => 0,
                    ];
                }

                $resumen[$idCat]["total"]++;
                if ($esCorrecta) {
                    $resumen[$idCat]["correctas"]++;
                }
            }

            $stmt->close();
        }

        return $resumen;
    }

    public function obtenerTextoRespuesta($respuesta_id)
    {
        $stmt = $this->conexion->prepare("SELECT texto FROM respuestas WHERE id = ?");
        $stmt->bind_param("i", $respuesta_id);
        $stmt->execute();
        $stmt->bind_result($texto);
        $stmt->fetch();
        $stmt->close();
        return $texto ?? "";
    }

    public function obtenerRespuestaCorrecta($pregunta_id)
    {
        $stmt = $this->conexion->prepare("SELECT texto FROM respuestas WHERE pregunta_id = ? AND es_correcta = 1");
        $stmt->bind_param("i", $pregunta_id);
        $stmt->execute();
        $stmt->bind_result($texto);
        $stmt->fetch();
        $stmt->close();
        return $texto ?? "";
    }
    public function obtenerResultadoPorUsuario($userId)
    {
        $stmt = $this->conexion->prepare(
            "SELECT nivel, calificacion, retroalimentacion FROM resultados WHERE id_user_reg = ?"
        );
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}
