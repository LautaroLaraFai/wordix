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
        array("palabraWordix"=>"MELON", "jugador" => "pink2000", "intentos" => 3,"puntaje"=>8),
        array("palabraWordix"=>"FUEGO", "jugador" => "majo", "intentos" => 2,"puntaje"=>7),
        array("palabraWordix"=>"YUYOS", "jugador" => "sebastian", "intentos" => 3,"puntaje"=>9),
    ];
    return $coleccionPartidas;}


    
/** Este modulo es un resumen de un solo jugador
 * @param array[] $coleccionPartidas
 * @param string $jugadorResumen
 * @return array[]
 */

 function resumen($coleccionPartidas,$jugadorResumen){
    //array $arrayResumenJugador
    //int $cantPartidas, $puntajeTotal, $cantVictorias, $intento1, $intento2, $intento3, $intento4, $intento5, $intento6, $i, $cant
    $arrayResumenJugador = [];
    $cantPartidas=0;
    $puntajeTotal=0;
    $cantVictorias=0;
    $intento1=0;
    $intento2=0;
    $intento3=0;
    $intento4=0;
    $intento5=0;
    $intento6=0;
    $cant=count($coleccionPartidas);

    for($i=0;$i<$cant;$i++){
        if($jugadorResumen==$coleccionPartidas[$i]["jugador"]){;
            $cantPartidas++;
            $puntajeTotal+=$coleccionPartidas[$i]["puntaje"];
            if($coleccionPartidas[$i]["puntaje"]>0){
                $cantVictorias++;
            }
            if($coleccionPartidas[$i]["intentos"]==1){
                $intento1++;
            }
            elseif($coleccionPartidas[$i]["intentos"]==2){
                $intento2++;
            }
            elseif($coleccionPartidas[$i]["intentos"]==3){
                $intento3++;
            }
            elseif($coleccionPartidas[$i]["intentos"]==4){
                $intento4++;
            }
            elseif($coleccionPartidas[$i]["intentos"]==5){
                $intento5++;
            }
            elseif($coleccionPartidas[$i]["intentos"]==6){
                $intento6++;
            }
        }
    }

    $arrayResumenJugador=[
        "jugador" => $jugadorResumen,
        "partidas" => $cantPartidas,
        "puntaje" => $puntajeTotal,
        "victorias" => $cantVictorias,
        "intento 1" => $intento1,
        "intento 2" => $intento2,
        "intento 3" => $intento3,
        "intento 4" => $intento4,
        "intento 5" => $intento5,
        "intento 6" => $intento6,
    ];
    return $arrayResumenJugador;
}

/** Este modulo le pide al usuario un nombre y se asegura que la primera letra sea string
 * @return $palabra
 */

 function solicitarJugador(){
    //string $nombre
    echo "ingrese nombre de usuario: ";
    $nombre=trim(fgets(STDIN));
    while(!(ctype_alpha($nombre[0]))){
        echo "el primer digito tiene que ser una letra ";
        $nombre=trim(fgets(STDIN));}
    
    $nombre=strtolower($nombre);
    return $nombre;

}
/** Este modulo es un menu y se encarga de que el usuario ingrese una opcion correcta
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
    while(!(is_numeric($nroPartida)||$nroPartida>0&&$nroPartida==(int)($nroPartida))){
        echo "el valor ingresado no es un numero o es 0, ingrese uno nuevo: ";
        $nroPartida=trim(fgets(STDIN));
    }
    echo "******************************************** \n";
    echo "partida WORDIX " . $nroPartida . ": palabra " .  $coleccionPartidas[$nroPartida-1]["palabraWordix"] . "\n";
    echo "jugador: " . $coleccionPartidas[$nroPartida-1]["jugador"] . "\n";
    echo "puntaje: " . $coleccionPartidas[$nroPartida-1]["puntaje"] . "\n";
    echo "intento: " . ($coleccionPartidas[$nroPartida-1]["intentos"]>0) ? "adivino la palabra en " . $coleccionPartidas[$nroPartida-1]["intentos"] . " intentos \n" : "no adivino la palabra";
    echo "******************************************** ";
    
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


//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

$numPalabrasUsadas=[]; //caso 1

$palabrasUsadas=[]; //caso 2


do {
    echo seleccionarOpcion();
    $opcion = trim(fgets(STDIN));
    
    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
            $cant=count($coleccionPalabras);
            $nombreUsuario=solicitarJugador();
            echo "ingrese un numero de palabra del 1 al " . $cant . ": ";
            $numPalabra=trim(fgets(STDIN));
            $bandera=false;
            for($i=0;$i<$cant&&!$bandera;$i++){
                if($numPalabra==$numPalabrasUsadas[$i]&&$numPalabra<=0&&in_array($numPalabra,$numPalabrasUsadas)){
                    echo "numero de palabra invalido o ya fue utilizado, elija otro";
                    $numPalabra=trim(fgets(STDIN));
                }else{
                    $bandera=true;
                    $palabraOpcion1=$coleccionPalabras[$numPalabra];
                    $numPalabrasUsadas[$i]=$numPalabra;
                }
                
            }
            $partida=jugarWordix($palabraOpcion1,$nombreUsuario);
            $countPartidas=count($coleccionPartidas);
            $coleccionPartidas[$countPartidas]=$partida; //carga la partida en el arreglo de partidas
            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            $nombreUsuario=solicitarJugador();
            $valorMaximo=(count($coleccionPalabras)-1);
            $indice=rand(0,$valorMaximo);
            $palabraWordix=$coleccionPalabras[$indice];

            $partida=jugarWordix($palabraWordix,$nombreUsuario);
            $countPartidas=count($coleccionPartidas);
            $coleccionPartidas[$countPartidas]=$partida;
            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
            $partidaMostrada=mostrarPartida($coleccionPartidas);

            $palabraWordix=$partidaMostrada;
            $partida=jugarWordix($palabraWordix,$nombreUsuario);
            $countPartidas=count($coleccionPartidas);
            $coleccionPartidas[$countPartidas]=$partida;
            break;
        
        case 4:

    }
} while ($opcion != 8);

