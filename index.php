<?php 
session_start();
?>
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

        <?php 
        if (isset($_GET['puntuacion'])) {

          echo "<div class='explicacion' style='margin:4%' > <b>Tu puntuacion total es</b> <br>" . $_SESSION['puntuacion'] . "</div>";
          echo "<center>
         <a class='w3-btn w3-black w3-border w3-round-large' style='margin:3%' href='index.php?pregunta=1'>Volver a realizar el text</a>
         </center>";
          $_SESSION['puntuacion'] = 0;
          die();
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
                echo "<form action='' method='post'> \n";
                echo "<article class='pregunta' id='pregunta'>\n";

                echo "<label for='pregunta'>" . $value['pregunta'] . "</label>\n</br>\n";
                echo "<input  type='radio' id='" . key($value['respuestas'][0]) . "' name='respuesta' value='" . $value['respuestas'][0]['1'] . "'>\n";
                echo "<label for'1' id='1-1'>" . $value['respuestas'][0]['1'] . "</label>\n";
                echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][1]) . "' name='respuesta' value='" . $value['respuestas'][1]['2'] . "'>\n";
                echo "<label id='1-2'>" . $value['respuestas'][1]['2'] . "</label>\n";

                echo "<input  margin-top:10px;' type='radio' class='1-2' id='" . key($value['respuestas'][0]) . "' name='respuesta' value='" . $value['respuestas'][2]['3'] . "'>\n";

                echo "<label id='1-3'> " . $value['respuestas'][2]['3'] . "</label>\n</br>\n";
                echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>\n";

                echo "</article>\n";
                echo "</form>\n";
              }
              //si la pregunta es multiple la pintaremos de esta forma
              if ($value['tipo'] == "multiple") {
                echo "<form action='' method='post'>\n";

                echo "<article class='pregunta' id='pregunta'>\n";

                echo "<label for='pregunta'>" . $value['pregunta'] . "</label>\n</br>\n";
                echo "<select name='respuestaMultiple[]' id='select' multiple>\n
            <option value='" . key($value['respuestas'][0]) . "'>" . $value['respuestas'][0]['1'] . "</option>\n
            <option value='" . key($value['respuestas'][1]) . "'>" . $value['respuestas'][1]['2'] . "</option>\n
            <option value='" . key($value['respuestas'][2]) . "'>" . $value['respuestas'][2]['3'] . "</option>\n
         
            </select>\n</br>\n";
                echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>\n";

                echo "</article>\n";
                echo "</form>\n";
              }
              //si la pregunta es de comppletar se pintara de esta forma
              if ($value['tipo'] == "completar") {
                echo "<form action='' method='post'>\n";

                echo "<article class='pregunta' id='pregunta'>\n";

                echo "<label for='pregunta'>" . $value['pregunta'] . "<input  margin-top:10px;' type='text' class='1-2' id='completar' name='respuesta'>\n</label>\n</br>\n";

                echo "<input class='comprobar' type='submit' name='enviar' id='enviar' value='Comprobar'>\n";

                echo "</article>\n";
                echo "</form>\n";
              }
            }
          } else {
            if ($field == 1) {
              header("location:index.php?pregunta=1");
            }
          }
        }


        // echo $value["pregunta"];

        ?>
        <br>

        <?php 
        if (isset($_POST['enviar'])) {
          compruebaPregunta($json);
        }

        function siguiente($actual, $json)
        {

          if ($actual > count($json['preguntas'])) {
            echo "<center>
            <a class='w3-btn w3-black w3-border w3-round-large' href='index.php?puntuacion'>Comprobar puntuacion total</a>
            </center>";
            $actual = count($json['preguntas']);
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
          //Comprobamos si nos llega la respuestaS
          if (isset($_POST['respuesta'])) {
            $respuesta = $_POST['respuesta'];
            $opcion = 1;
          }

          if (!isset($_GET['pregunta'])) {
            $pregunta = 1;
          } else {
            $pregunta = $_GET['pregunta'];
          }
          //echo "Esta es la pregunta actual= ".$pregunta;
          //recogemos la correcta
          $correcta = $json['preguntas'][$pregunta]['correcta'];
          //explicacion
          $explicacion = $json['preguntas'][$pregunta]['explicacion'];
          //echo "La respuesta es " . $respuesta . " Y la correcta es: " . $correcta;


          echo "<script defer>
                  let respuesta1 = document.getElementById('1-1');
                  let respuesta2 = document.getElementById('1-2');
                  let respuesta3 = document.getElementById('1-3');
                  //alert(respuesta1.textContent);
                  //alert(respuesta2.textContent);
                  //alert(respuesta3.textContent);

                  if(respuesta1.textContent=='" . $correcta . "'){
                    //alert('entro1');
                    //la mal 
                    respuesta2.classList.add('respuestaRoja');
                
                    respuesta3.classList.add('respuestaRoja');
      
                    //marcamos la correcta
      
                    respuesta1.classList.add('respuestaVerde');
                    //la volvemos a poner el check
                  
      
                    document.getElementById('enviar').disabled = 'true';
                    document.getElementById('enviar').classList.add('off');

                
        
                  }
                  if(respuesta2.textContent=='" . $correcta . "'){
                  //alert('entro2');

                    //la mal 
                    respuesta1.classList.add('respuestaRoja');
                
                    respuesta3.classList.add('respuestaRoja');
      
                    //marcamos la correcta
      
                    respuesta2.classList.add('respuestaVerde');
      
                    document.getElementById('enviar').disabled = 'true';
                    document.getElementById('enviar').classList.add('off');

                   
        
                  }
                  if(respuesta3.textContent=='" . $correcta . "'){
                //alert('entro3');

                    //la mal 
                    respuesta2.classList.add('respuestaRoja');
                
                    respuesta1.classList.add('respuestaRoja');
      
                    //marcamos la correcta
      
                    respuesta3.classList.add('respuestaVerde');
      
                    document.getElementById('enviar').disabled = 'true';
                    document.getElementById('enviar').classList.add('off');

        
                  }
            
                  </script>";
          

                  //controlamos los demas tipos de preguntas
                  if(isset($_POST["respuestaMultiple"])){
              
              foreach($_POST['respuestaMultiple'] as $indice => $valor){
              $respuesta=$respuesta.$valor; 
              }
              echo "esta es la respuesta de la multiple: " . $respuesta;

            }
          if ($correcta != @$respuesta) {
            
            echo "<script>
                    let divResultado = document.createElement('div');
                    divResultado.classList.add('puntuacionRoja')
                    document.getElementById('pregunta').appendChild(divResultado);
                    divResultado.innerHTML = 0;
                    //la explicacion
                    let explicacion = document.createElement('p');
                    explicacion.classList.add('explicacion')
                    document.getElementById('pregunta').appendChild(explicacion);
                    explicacion.innerHTML = '" . $explicacion . "';
                    </script>";
          }
          if ($correcta == @$respuesta) {
            $_SESSION['puntuacion'] = $_SESSION['puntuacion'] + 1;
            echo "<script>
                    let divResultado = document.createElement('div');
                    divResultado.classList.add('puntuacionVerde')
                    document.getElementById('pregunta').appendChild(divResultado);
                    divResultado.innerHTML = 1;
                    //la explicacion
                    let explicacion = document.createElement('p');
                    explicacion.classList.add('explicacion')
                    document.getElementById('pregunta').appendChild(explicacion);
                    explicacion.innerHTML = '" . $explicacion . "';
                  </script>";
          }
        }
        ?>






    </section>
</body>

</html> 