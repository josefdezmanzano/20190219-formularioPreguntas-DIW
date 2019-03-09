<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <!-- Mis estilos -->
    <link rel="stylesheet" href="css/estilo.css" />
    <!-- Botones de la w3school -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Fuentes de google -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <!--  <script src="js/script.js" defer></script>
-->
</head>

<body>

    <?php
 //obtenemos el contenido del archivo json
    $datos = file_get_contents('preguntas.json');
    //nos llevamos la informacion a un array asociativo
    $json = json_decode($datos, true);


    ?>


    <header class="mititulo">
        <h1 class="mititulo">Examen tipo text DIW</h1>
    </header>
    <section>
        <form action="" method="post">
            <?php 
            if (isset($_POST['enviar'])) {
              compruebaPregunta($json);
            }
            //Controlamos el parametro get pregunta
            if (isset($_GET['pregunta'])) { //si existe 
              //echo "existo";  
              $preguntaActual = $_GET['pregunta'];
            }
            foreach ($json['preguntas'] as $field => $value) {
              //metemos los estilo a cara perro
              echo "<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
      <link rel='stylesheet' href='css/estilo.css' />";
              //si la pregunta esta parametrizada
              if (isset($_GET['pregunta'])) {
                //mostramos La pregunta actual
                if ($field == $preguntaActual) {
                  //ahora pasamos a comprobar el tipo de pregunta
                  if ($value['tipo'] == "radio") {
                    //echo "esta es la key: ".$field ;
                    echo "<form action='' method='post'>";
                    echo "<article class='pregunta' id='pregunta'>";

                    echo "<label for='pregunta'>" . $value['pregunta'] . "</label></br>";
                    echo "<input  type='radio' id='" . key($value['respuestas'][0]) . "' name='respuesta1' value='" . $value['respuestas'][0]['1'] . "' />";
                    echo "<label for'1' id='1-1'> " . $value['respuestas'][0]['1'] . "</label>";
                    echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][1]) . "' name='respuesta2' value='" . $value['respuestas'][1]['2'] . "'>";
                    echo "<label id='2'> " . $value['respuestas'][1]['2'] . "</label>";
                    echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][0]) . "' name='respuesta1' value='" . $value['respuestas'][2]['3'] . "'>";
                    echo "<label id='3'> " . $value['respuestas'][2]['3'] . "</label></br>";
                    echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>";

                    echo "</article>";
                    echo "</form>";
                  }
                  //si la pregunta es multiple la pintaremos de esta forma
                  if ($value['tipo'] == "multiple") {
                    echo "<form action='' method='post'>";

                    echo "<article class='pregunta' id='pregunta'>";

                    echo "<label for='pregunta'>" . $value['pregunta'] . "</label></br>";
                    echo "<select name='respuesta1' id='select' multiple>
            <option value='" . key($value['respuestas'][0]) . "'>" . $value['respuestas'][0]['1'] . "</option>
            <option value='" . key($value['respuestas'][1]) . "'>" . $value['respuestas'][1]['2'] . "</option>
            <option value='" . key($value['respuestas'][2]) . "'>" . $value['respuestas'][2]['3'] . "</option>
         
            </select></br>";
                    echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>";

                    echo "</article>";
                    echo "</form>";
                  }
                  //si la pregunta es de comppletar se pintara de esta forma
                  if ($value['tipo'] == "completar") {
                    echo "<form action='' method='post'>";

                    echo "<article class='pregunta' id='pregunta'>";

                    echo "<label for='pregunta'>" . $value['pregunta'] . "<input  margin-top:10px;' type='text' class='1-2' id='completar' name='respuesta1'></label></br>";

                    echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>";

                    echo "</article>";
                    echo "</form>";
                  }
                }
              } else {
                if ($field == 1) {
                  // echo "esta es la key: ".$field ;
                  if ($value['tipo'] == "radio") {
                    echo "<form action='' method='post'>";

                    echo "<article class='pregunta' id='pregunta'>";

                    echo "<label for='pregunta'>" . $value['pregunta'] . "</label></br>";
                    echo "<input  type='radio' id='" . key($value['respuestas'][0]) . "' name='respuesta1' value='" . $value['respuestas'][0]['1'] . "' />";
                    echo "<label for'1' id='1-1'> " . $value['respuestas'][0]['1'] . "</label>";
                    echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][1]) . "' name='respuesta2' value='" . $value['respuestas'][1]['2'] . "'>";
                    echo "<label id='2'> " . $value['respuestas'][1]['2'] . "</label>";
                    echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][2]) . "' name='respuesta3' value='" . $value['respuestas'][2]['3'] . "'>";
                    echo "<label id='3'> " . $value['respuestas'][2]['3'] . "</label></br>";
                    echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>";


                    echo "</article>";
                    echo "</form>";
                  }
                }
              }


              // echo $value["pregunta"];
            }
            ?>
            <br>

            <?php 


            function siguiente($actual, $json)
            {

              if ($actual >= count($json['preguntas'])) {
                $actual = 1;
              } else {
                $actual++;
              }


              echo "<center>
                <a class='w3-btn w3-black w3-border w3-round-large' href='index.php?pregunta=$actual'>Siguiente pregunta</a>
                </center>";
            }

            if (isset($preguntaActual)) {
              siguiente($preguntaActual, $json);
            } else {
              echo siguiente(1, $json);
            }


            function compruebaPregunta($json)
            {
              if(isset($_POST['']))
              $respuesta=$_POST[''];
              $correcta;
              if (!isset($_GET['pregunta'])) {
                $pregunta = 1;
              } else {
                $pregunta = $_GET['pregunta'];
              }


              echo "esta es la pregunta actual: " . $pregunta;


              echo '<script>
          
          
          
          </script>';
            }

            ?>






    </section>
</body>

</html> 