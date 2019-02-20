function comprobarPregunta(numero) {
    let respuesta1 = document.getElementById("pregunta1-1");
    let respuesta2 = document.getElementById("pregunta1-2");
    let respuesta3 = document.getElementById("pregunta1-3");


    if (respuesta1.checked) {
        let divResultado = document.createElement("div");
        divResultado.classList.add("puntuacionVerde")
        document.getElementById("pregunta1").appendChild(divResultado);
        divResultado.innerHTML = 1;
        document.getElementById(numero + "-1").classList.add('respuestaVerde');
        document.getElementById('enviar').disabled = "true";


    }

    if (respuesta2.checked) {
        let divResultado = document.createElement("div");
        divResultado.classList.add("puntuacionRoja")
        document.getElementById("pregunta1").appendChild(divResultado);
        divResultado.innerHTML = 0;
        //la mal 
        document.getElementById(numero + "-2").classList.add('respuestaRoja');
        //marcamos la correcta
        document.getElementById(numero + "-1").classList.add('respuestaVerde');
        document.getElementById('enviar').disabled = "true";

        //mostramos un mensaje indicando por que no es la correcta
        let explicacion = document.createElement("p");
        explicacion.classList.add("puntuacionRoja")
        document.getElementById("pregunta1").appendChild(explicacion);
        explicacion.innerHTML = "La correcta es la primera por que quiero";

    }
    if (respuesta3.checked) {
        let divResultado = document.createElement("div");
        divResultado.classList.add("puntuacionRoja")
        document.getElementById("pregunta1").appendChild(divResultado);
        divResultado.innerHTML = 0;
        //la mal
        document.getElementById(numero + "-3").classList.add('respuestaRoja');
        //marcamos la correcta
        document.getElementById(numero + "-1").classList.add('respuestaVerde');
        document.getElementById('enviar').disabled = "true";

        //mostramos un mensaje indicando por que no es la correcta
        let explicacion = document.createElement("p");
        explicacion.classList.add("puntuacionRoja")
        document.getElementById("pregunta1").appendChild(explicacion);
        explicacion.innerHTML = "La correcta es la primera por que quiero";



    }

}