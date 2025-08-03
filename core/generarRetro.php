<?php

class FeedbackGenerator
{
    public function generar(int $puntaje, array $categoriasAprobadas, array $categoriasTotales): array
    {
        $totalCategorias = count($categoriasTotales);
        $aprobadas = count($categoriasAprobadas);
        $reprobadas = array_diff($categoriasTotales, $categoriasAprobadas);
        $nivel = $this->calcularNivel($aprobadas);

        $mensaje = "Nivel obtenido: <strong>$nivel</strong><br>";

        switch ($nivel) {
            case "Pro":
                if ($puntaje == 10) {
                    $mensaje .=
                        "¡Excelente! Dominaste todos los temas. Aun así, te invitamos a reforzar con el curso de <strong>APIs y consumo de servicios</strong> como reto.";
                } elseif ($puntaje == 9) {
                    $catFallo = current($reprobadas);
                    $mensaje .= "Muy bien. Solo fallaste en <strong>$catFallo</strong>. Te sugerimos reforzar con ese curso.";
                } else {
                    // 8
                    $mensaje .=
                        "Buen trabajo, pero fallaste en las categorías básicas. Te sugerimos repasar <strong>Fundamentos</strong> y <strong>PHP con BD</strong>.";
                }
                break;

            case "Avanzado":
                if ($puntaje == 9) {
                    $mensaje .=
                        "Muy buen nivel. Solo tuviste un error en un tema avanzado. Refuerza con <strong>" .
                        implode(", ", $reprobadas) .
                        "</strong>.";
                } elseif ($puntaje == 8) {
                    $mensaje .=
                        "Buen resultado. Fallaste en temas intermedios y avanzados. Enfócate en <strong>" .
                        implode(", ", $reprobadas) .
                        "</strong>.";
                } else {
                    $mensaje .=
                        "Buen esfuerzo. Revisa principalmente <strong>" .
                        implode(", ", $reprobadas) .
                        "</strong> para mejorar.";
                }
                break;

            case "Intermedio":
                $mensaje .=
                    "Nivel intermedio. Necesitas reforzar: <strong>" . implode(", ", $reprobadas) . "</strong>.";
                break;

            case "Básico":
                if (count($categoriasAprobadas) === 1 && $puntaje >= 2) {
                    $mensaje .= "Tu punto fuerte es <strong>{$categoriasAprobadas[0]}</strong>, pero necesitas revisar el resto.";
                } else {
                    $mensaje .=
                        "Estás en etapa inicial. Te recomendamos tomar los cursos del 1 al 4 en orden para fortalecer tu base.";
                }
                break;

            case "Elemental":
                if ($puntaje >= 4) {
                    $mensaje .=
                        "Hay potencial. Muestra inicial de comprensión en algunas áreas. Te invitamos a tomar nuestra ruta completa de aprendizaje.";
                } else {
                    $mensaje .=
                        "Es importante comenzar desde lo básico. Toma los cursos desde <strong>Fundamentos</strong> y sigue el orden.";
                }
                break;
        }

        return [
            "nivel" => $nivel,
            "mensaje" => $mensaje,
        ];
    }

    private function calcularNivel(int $aprobadas): string
    {
        return match ($aprobadas) {
            4 => "Pro",
            3 => "Avanzado",
            2 => "Intermedio",
            1 => "Básico",
            default => "Elemental",
        };
    }
}
