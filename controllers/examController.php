<?php

require_once __DIR__ . "/../core/Exam.php";
require_once __DIR__ . "/../core/View.php";

class ExamController
{
    private $model;
    private $view;

    public function __construct()
    {
        global $conexion;
        $this->model = new ExamModel($conexion); // este es tu "modelo"
        $this->view = new View();
    }

    public function mostrar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            require_once __DIR__ . "/../core/generarRetro.php";

            $puntaje = 0;
            $total = 0;
            $respuestasPorCategoria = [];
            $respuestasUsuario = [];
            $detallePorCategoria = [];

            foreach ($_POST as $key => $respuesta_id) {
                if (strpos($key, "pregunta_") === 0) {
                    $pregunta_id = (int) str_replace("pregunta_", "", $key);
                    $pregunta = $this->model->obtenerPreguntaPorId($pregunta_id);
                    $categoria = $pregunta["categoria"];

                    $respuestasUsuario[$pregunta_id] = $respuesta_id;
                    $esCorrecta = $this->model->esRespuestaCorrecta($pregunta_id, $respuesta_id);
                    $respuestasPorCategoria[$categoria][] = $esCorrecta;

                    $respuestaCorrecta = $this->model->obtenerRespuestaCorrecta($pregunta_id);
                    $respuestaMarcada = $this->model->obtenerTextoRespuesta($respuesta_id);
                    $detallePorCategoria[$categoria][] = [
                        "pregunta" => $pregunta["texto"],
                        "respuesta_marcada" => $respuestaMarcada,
                        "respuesta_correcta" => $respuestaCorrecta,
                        "correcta" => $esCorrecta,
                    ];

                    if ($esCorrecta) {
                        $puntaje++;
                    }
                    $total++;
                }
            }

            $categoriasAprobadas = [];
            foreach ($respuestasPorCategoria as $categoria => $respuestas) {
                $correctas = array_filter($respuestas);
                if (count($correctas) >= 2) {
                    $categoriasAprobadas[] = $categoria;
                }
            }

            $categoriasTotales = array_keys($respuestasPorCategoria);

            $feedbackGen = new FeedbackGenerator();
            $feedback = $feedbackGen->generar($puntaje, $categoriasAprobadas, $categoriasTotales);

            $this->model->guardarResultado($_SESSION["user_id"], $feedback["nivel"], $puntaje, $feedback["mensaje"]);

            $resumenPorCategoria = $this->model->obtenerResumenPorCategoria($respuestasUsuario);

            $this->view->render("views/exam/result.php", [
                "puntaje" => $puntaje,
                "total" => $total,
                "resumenCategoria" => $resumenPorCategoria,
                "mensaje" => $feedback["mensaje"],
                "detallePorCategoria" => $detallePorCategoria,
            ]);
        } else {
            // Verificar si ya hay resultado guardado
            $resultado = $this->model->obtenerResultadoPorUsuario($_SESSION["user_id"]);

            if ($resultado) {
                // Mostrar resultado resumido SIN desglose
                $this->view->render("views/exam/result.php", [
                    "puntaje" => $resultado["calificacion"],
                    "mensaje" => $resultado["retroalimentacion"],
                    "nivel" => $resultado["nivel"],
                    "total" => null,
                    "resumenCategoria" => [],
                    "detallePorCategoria" => [],
                ]);
                return;
            }

            // No tiene resultado, mostrar examen
            $preguntas = $this->model->obtenerPreguntas();
            foreach ($preguntas as &$pregunta) {
                $pregunta["respuestas"] = $this->model->obtenerRespuestas($pregunta["id"]);
            }

            $this->view->render("views/exam/form.php", ["preguntas" => $preguntas]);
        }
    }
}
