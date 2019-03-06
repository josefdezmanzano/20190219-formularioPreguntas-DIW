<!DOCTYPE html>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css" />
    <script src="js/script.php" defer></script>
  </head>

  <body>

<?php
//obtenemos el contenido del archivo json
$datos = file_get_contents('preguntas.json');
//nos llevamos la informacion a un array asociativo
$json = json_decode($datos, true);
//mostramos la informacion
//echo '<pre>' . print_r($json, true) . '</pre>';
foreach ($json['preguntas'] as $field => $value) {
  // Use $field and $value here
  echo $value["pregunta"];
}
//$pregunta1 = $json['pregunta1']['pregunta'];
//echo $pregunta1;
?>


  <header class="mititulo">
      <h1 class="mititulo">Examen tipo text DIW</h1>
    </header>
    <section>
      <form action="" method="post">
        <article class="pregunta1" id="pregunta1">
          <label for="pregunta1">Pregunta 1:elige una loco</label>&nbsp;
          <input type="radio" id="pregunta1-1" name="pregunta1" value="1" />
          <p id="1-1">valor1</p>
          <input
            type="radio"
            class="1-2"
            id="pregunta1-2"
            name="pregunta1"
            value="2"
          />
          <p id="1-2">valor2</p>
          <input
            type="radio"
            class="1-3"
            id="pregunta1-3"
            name="pregunta1"
            value="3"
          />
          <p id="1-3">valor3</p>
          &nbsp;
          <input
            type="button"
            id="enviar"
            value="Comprobar"
            onclick="comprobarPregunta(1)"
          />
        </article>

      </form>
    </section>
  </body>
</html>
