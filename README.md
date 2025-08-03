# Informe Técnico – Prueba de Desarrollo

Se agregan las respuestas a las preguntas planteadas.

---

## 1. ¿Describe tu enfoque para la planificación y el desarrollo de esta prueba técnica?

El enfoque utilizado fue aplicar el modelo **MVC (Modelo-Vista-Controlador)**, que me permitió separar responsabilidades
y tener una mejor organización de las acciones dentro del sistema. Comencé analizando el comportamiento general del
sitio, enfocándome en la parte de la evaluación diagnóstica. Me interesaba especialmente cómo iba a evaluar al usuario.

Por lo que se me ocurrió implementar una lógica basada en **categorías**, evaluando si cada una estaba aprobada o
no, para poder recomendar cursos específicos en función del desempeño. Esta estructura ayudó a construir una experiencia
más personalizada y útil para el usuario final.

---

## 2. ¿Qué desafíos encontraste durante el desarrollo y cómo los resolviste?

El desafío más grande fue encontrar una manera efectiva de **evaluar las preguntas** para generar una retroalimentación
clara y útil. Opté por organizar las preguntas en categorías, cada una representando una temática dentro de una ruta de
aprendizaje compuesta por cuatro cursos.

Esto me permitió construir una lógica de evaluación por niveles (de básicos a avanzados) y determinar con precisión qué
cursos sugerir al usuario según su resultado.

---

## 3. ¿Explica las decisiones arquitectónicas clave que tomaste (por ejemplo, estructura de carpetas, elección de tecnologías)?

Dado que ya había trabajado con **PHP** en proyectos pequeños, retomé esa tecnología y estructuré el proyecto siguiendo
el patrón **MVC**. Esto me permitió separar la lógica del negocio (controladores), el manejo de datos (modelos) y la
interfaz (vistas), haciendo que todo fuera más comprensible y mantenible.

Organizar todo en carpetas según su responsabilidad también facilitó crear funciones reutilizables y trabajar de manera
más ordenada.

---

## 4. ¿Cómo probaste tu código? ¿Qué estrategias de prueba utilizaste?

Realicé pruebas de manera local, comenzando desde el inicio de sesión hasta completar la evaluación. Probé flujos
completos simulando posibles errores o caminos que un usuario podría tomar.

Me enfoqué en que todo fuera claro y fluido, minimizando clics innecesarios y asegurando que la navegación fuera
intuitiva. También validé que los resultados se almacenaran correctamente y que la retroalimentación fuera coherente.

---

## 5. ¿Qué mejoras o características adicionales agregarías si tuvieras más tiempo?

Me gustaría implementar un **catálogo de categorías**, cada una con su propio grupo de cursos. De esta manera, el
usuario podría elegir una temática específica, y el sistema le mostraría un **reporte detallado** con sugerencias de
cursos relacionados y un trazado de ruta de aprendizaje personalizado.

También integraría más elementos visuales e interactivos para hacer la experiencia más atractiva sin perder el foco
educativo.

---

## 6. ¿Describe tu experiencia trabajando con React.js/Next.js (o la tecnología frontend elegida)?

En este proyecto utilicé HTML, CSS y JavaScript puro para el desarrollo del frontend. Me enfoqué en construir una
interfaz clara y funcional, manteniendo los objetivos de una landing page orientada al usuario.

Sin embargo, me hubiera gustado incorporar más interacciones dinámicas para hacer la experiencia más atractiva,
especialmente en la retroalimentación de resultados.

---

## 7. ¿Cuál fue tu experiencia con el backend (Node.js/Express o PHP)?

Utilicé **PHP** como tecnología principal del backend. Uno de los retos más importantes fue el manejo de **sesiones**,
sobre todo para controlar qué vista mostrar según el estado del usuario (si ya había iniciado sesión o si ya tenía una
calificación asignada).

Esta parte me ayudó a reforzar conocimientos sobre autenticación, control de flujo y vistas condicionales.

---

## 8. ¿Cómo manejaste la gestión de estados en tu aplicación frontend?

La gestión de vistas fue clave para mantener la claridad. En lugar de tener todo en una sola página, lo trabajé
dividiendo el contenido en vistas específicas. Gracias al **enrutamiento entre vistas**, pude controlar de manera más
ordenada el flujo de la aplicación y el acceso a cada sección.

Esto también me permitió mejorar la escalabilidad del proyecto.

---

## 9. Si utilizaste herramientas de IA como bolt.new o v0 by Vercel, ¿explica por qué y cómo las usaste?

Utilicé **Copilot** como asistente de inteligencia artificial, principalmente para la **generación de imágenes** y
también para ayudar en la creación de preguntas relacionadas con la temática elegida. Para creacion de perfiles de
testimonios use la pagina de Fake Person Generator ya que son personas que no existen y no cuentan con derechos de
autor. La IA me ayudó a acelerar el desarrollo creativo en relacion a imagenes sin comprometer la lógica personalizada
que implementé en el sistema.

---

## 10. ¿Qué aprendiste o reforzaste al completar esta prueba técnica?

Reforcé conceptos fundamentales como la **arquitectura MVC**, el uso eficiente de **funciones reutilizables** y la
importancia de mantener un código limpio y bien organizado.

También mejoré mi comprensión sobre la **relación entre tablas en SQL**, lo que me permitió implementar una lógica más
compleja y efectiva para manejar categorías, preguntas, resultados y recomendaciones. En general, fue una experiencia
muy enriquecedora a nivel técnico y estructural.

---
