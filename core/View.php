<?php
class View
{
    private $sections = [];

    // Guarda la sección con su archivo y variables
    public function section(string $name, string $file, array $vars = [])
    {
        $this->sections[$name] = [
            "file" => $file,
            "vars" => $vars,
        ];
    }

    // Renderiza el layout, y dentro de este las secciones
    public function render(string $layout, array $data = [])
    {
        $renderedSections = [];

        foreach ($this->sections as $name => $section) {
            $vars = $section["vars"] ?? [];
            ob_start();
            extract($vars);
            include $section["file"];
            $renderedSections[$name] = ob_get_clean();
        }

        // Extraer variables de las secciones renderizadas
        extract($renderedSections);

        // Extraer variables pasadas en $data (como $auth)
        extract($data);

        include $layout;
    }
}
