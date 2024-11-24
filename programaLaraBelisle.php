<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/** Apellido, Nombre. Legajo. Carrera. mail. Usuario Github
* Lara Lautaro FAI-5517 Tecnicatura en desarrollo web lautaronicolas.lara@est.fi.uncoma.edu.ar LautaroLaraFai 
* Belisle Federico FAI-5572 Tecnicatura en desarrollo web federico.belisle@est.fi.uncoma.edu.ar Federico Belisle
*/
/* ****COMPLETADO***** */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras(){
    //array[] $coleccionPalabras
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        /* Agregar 5 palabras más */
        "PERRO", "TRIGO", "VAGOS", "MONTE", "TRAPO"
    ];

    return $coleccionPalabras;
}

/* ****A MEDIO COMPLETAR***** */
/** Este modulo guarda partidas 
 * TIENE RETORNO?
 */
function cargarPartidas(){
    //array[] $coleccionPartidas
    $coleccionPartidas=[
        array("palabraWordix"=>"QUESO", "jugador" => "majo", "intentos" => 0,"puntaje"=>0),
        array("palabraWordix"=>"CASAS", "jugador" => "rudolf", "intentos" => 3,"puntaje"=>14),
        array("palabraWordix"=>"QUESO", "jugador" => "pink2000", "intentos" => 6,"puntaje"=>10),
        array("palabraWordix"=>"PERRO", "jugador" => "ricardo", "intentos" => 4,"puntaje"=>4),
        array("palabraWordix"=>"TRIGO", "jugador" => "ninja", "intentos" => 2,"puntaje"=>12),
        array("palabraWordix"=>"HUEVO", "jugador" => "majo", "intentos" => 1,"puntaje"=>7),
        array("palabraWordix"=>"TRAPO", "jugador" => "lautaro", "intentos" => 5,"puntaje"=>18),
        array("palabraWordix"=>"MELON", "jugador" => "pink2000", "intentos" => 6,"puntaje"=>6),
        array("palabraWordix"=>"FUEGO", "jugador" => "majo", "intentos" => 2,"puntaje"=>7),
        array("palabraWordix"=>"YUYOS", "jugador" => "sebastian", "intentos" => 3,"puntaje"=>9),
    ];}
/** Este modulo le pide al usuario un nombre y se asegura que la primera letra sea s@tring
 * @return $palabra
 */
function solicitarJugador(){
    //string $nombre
    //preguntar si se tiene que volver a preguntar el nombre si la primera letra no es una letra
    echo "ingrese nombre de usuario: ";
    $nombre=trim(fgets(STDIN));
    $nombre=strtolower($nombre);
    ctype_alpha($nombre[0]);

    return $nombre;
}
/** Este modulo es un menu y se encarga de que el usuario ingrese una opcion correcta
 * 
 */
function seleccionarOpcion(){
    // int $min;$max;$opcion
    echo "Menu \n 1) Jugar al wordix con una palabra elegida \n 2) Jugar al wordix con una palabra aleatoria \n 3) Mostrar una partida \n 4) Mostrar la primer partida ganadora \n 5) Mostrar resumen de jugador \n 6) Mostrar listados de partidas ordenados por jugador y palabra \n 7) Agregar una palabra de 5 letras al wordix \n 8) Salir \n" ;
    $min=1;
    $max=8;
    $opcion=solicitarNumeroEntre($min, $max);
    }
/** Este modulo muestra la partida que el usuario desea ver
 * @param array[] $coleccionPartidas
 * 
 */
function mostrarPartida($coleccionPartidas){
     //int $nroPartida
    echo "ingrese un numero de partida a ver: ";
    $nroPartida=trim(fgets(STDIN));
    //dentro de una repetitiva
    if(is_numeric($nroPartida)){
        echo "******************************************** \n";
        echo "partida WORDIX " . $nroPartida . ": palabra " .  $coleccionPartidas[$nroPartida-1]["palabraWordix"] . "\n";
        echo "jugador: " . $coleccionPartidas[$nroPartida-1]["jugador"] . "\n";
        echo "puntaje: " . $coleccionPartidas[$nroPartida-1]["puntaje"] . "\n";
        echo "intento: " . ($coleccionPartidas[$nroPartida-1]["intentos"]>0) ? "adivino la palabra en " . $coleccionPartidas[$nroPartida-1]["intentos"] . " intentos \n" : "no adivino la palabra";
        echo "******************************************** "
    }else{
        echo "numero invalido, ingrese un nuevo numero";
        $nroPartida=trim(fgets(STDIN));
    }
}

/** Este modulo agrega una palabra que el usuario ingresa al array de palabras
 * @param array[] $coleccionPalabras
 * @param string $palabra
 * @return array[]
 */
function agregarPalabra($coleccionPalabras,$palabra){
    //int $cant
    $cant=count($coleccionPalabras);
    $coleccionPalabras[$cant]=$palabra;
    return $coleccionPalabras;
}


    //preguntar si esto va en el algoritmo principal
    leerPalabra5Letras();

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();
seleccionarOpcion();

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
