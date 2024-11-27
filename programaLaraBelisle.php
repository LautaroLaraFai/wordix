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

/* ****COMPLETADO***** */
/** Este modulo guarda partidas 
 */

 function cargarPartidas(){
    //array[] $coleccionPartidas
    $coleccionPartidas=[
        array("palabraWordix"=>"QUESO", "jugador" => "majo", "intentos" => 0,"puntaje"=>0), 
        array("palabraWordix"=>"CASAS", "jugador" => "rudolf", "intentos" => 3,"puntaje"=>14), 
        array("palabraWordix"=>"QUESO", "jugador" => "pink2000", "intentos" => 6,"puntaje"=>0), 
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
            elseif($coleccionPartidas[$i]["intentos"]==1){
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
        "intento1" => $intento1,
        "intento2" => $intento2,
        "intento3" => $intento3,
        "intento4" => $intento4,
        "intento5" => $intento5,
        "intento6" => $intento6,
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
    echo "\n Menu \n 1) Jugar al wordix con una palabra elegida \n 2) Jugar al wordix con una palabra aleatoria \n 3) Mostrar una partida \n 4) Mostrar la primer partida ganadora \n 5) Mostrar resumen de jugador \n 6) Mostrar listados de partidas ordenados por jugador y palabra \n 7) Agregar una palabra de 5 letras al wordix \n 8) Salir \n" ;
    $min=1;
    $max=8;
    $opcion=solicitarNumeroEntre($min, $max);
    return $opcion;
    }
/** Este modulo muestra la partida que el usuario desea ver
 * @param array[] $coleccionPartidas
 * 
 */
function mostrarPartida($coleccionPartidas){
     //int $nroPartida
    echo "ingrese un numero de partida a ver: ";
    $nroPartida=trim(fgets(STDIN));
    $limite=count($coleccionPartidas);
    while(!(is_numeric($nroPartida)||$nroPartida>0&&$nroPartida==(int)($nroPartida)||$nroPartida>$limite)){
        echo "el valor ingresado es invalido, ingrese un numero: ";
        $nroPartida=trim(fgets(STDIN));
    }
    echo "******************************************** \n";
    echo "partida WORDIX " . $nroPartida . ": palabra " .  $coleccionPartidas[$nroPartida-1]["palabraWordix"] . "\n";
    echo "jugador: " . $coleccionPartidas[$nroPartida-1]["jugador"] . "\n";
    echo "puntaje: " . $coleccionPartidas[$nroPartida-1]["puntaje"] . "\n";
    echo "intento: " . (($coleccionPartidas[$nroPartida-1]["intentos"]==0) ? "no adivino la palabra \n" : "adivino la palabra en " . $coleccionPartidas[$nroPartida-1]["intentos"] . " intentos \n" );
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

/**
 * Este modulo devuelve el indice de la primer partida ganada
 * @param array[] $coleccionPartidas
 * @param string $nombreUsuario
 * @return int
 */
function indicePartidaGanada($coleccionPartidas,$nombreUsuario){
    //int $i; $cant; $partidaGanada
    //bool $encontrado
    $i=0;
    $cant=count($coleccionPartidas);
    $encontrado=false;
    while($i<$cant&&!$encontrado){
        if($coleccionPartidas[$i]["puntaje"]>0 && $coleccionPartidas[$i]["jugador"]==$nombreUsuario){
            $partidaGanada=$i;
            $encontrado=true;
        }else{
            $partidaGanada=-1;
            $i++;
        }
    }
    return $partidaGanada;
}  

/**
 * Este modulo ordena las partidas de un array por su nombre si tienen mismo nombre los ordena por palabra
 * @param array[] $coleccionPartidas 
 * @return int
 */
function ordenarPartidas($coleccionPartidas){
    //int $valor,
    $coleccionPartidasOrdenada=$coleccionPartidas;

    uasort($coleccionPartidasOrdenada, function($a,$b){
        if($a["jugador"]<$b["jugador"]){
            $valor=-1;
        }elseif($a["jugador"]>$b["jugador"]){
            $valor=1;
        }else{  //si los jugadores son iguales se los ordena por la palabra
            if($a["palabraWordix"]<$b["palabraWordix"]){
                $valor=-1;
            }elseif($a["palabraWordix"]>$b["palabraWordix"]){
                $valor=1;
            }else{
                $valor=0;
            }
        }
        return $valor;
    });

    print_r($coleccionPartidasOrdenada);
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:

// int $cant; $numPalabra; $i; $countPartidas; $valorMaximo; $indice; $victorias; $partidas
//string $nombreUsuario; $numPalabra; $palabraOpcion1; $palabraWordix; $jugadorResumen
//bool $bandera
//array[] $coleccionPalabras; $numPalabrasUsadas; $coleccionPartidas; $partidaMostrada; $arrayResumenJugador

//Inicialización de variables:

$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();

$numPalabrasUsadas[0]=-1; //caso 1

$palabrasUsadas[0]="a"; //caso 2

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

do {
   $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: 
            // Juega una partida de WORDIX con el numero de palabra que el usuario elija
            $cant=count($coleccionPalabras)-1;
            $nombreUsuario=solicitarJugador();
            echo "ingrese un numero de palabra del 1 al " . $cant . ": ";
            $numPalabra=trim(fgets(STDIN));
            $bandera=false;
            for($i=0;$i<$cant&&!$bandera;$i++){
                if($numPalabra==$numPalabrasUsadas[$i]||$numPalabra<=0||$numPalabra>$cant){
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
            // Juega una partida de WORDIX con una palabra aleatoria
            $nombreUsuario=solicitarJugador();
            $valorMaximo=(count($coleccionPalabras)-1);
            $indice=rand(0,$valorMaximo);
            
            $bandera=false;
            $limite=count($palabrasUsadas);
            for($i=0;$i<$limite;$i++){
                if($coleccionPalabras[$indice]==$palabrasUsadas){
                    $indice=rand(0,$valorMaximo);
                }
            }
            $palabraWordix=$coleccionPalabras[$indice];
            $palabrasUsadas=$coleccionPalabras[$indice];
            $partida=jugarWordix($palabraWordix,$nombreUsuario);
            $countPartidas=count($coleccionPartidas);
            $coleccionPartidas[$countPartidas]=$partida;
            break;
        case 3: 
            // Muestra una partida que el usuario elija
            $partidaMostrada=mostrarPartida($coleccionPartidas);
            break;
        case 4:
            // Muestra la primera partida ganada de un jugador seleccionado
            echo "ingrese un nombre de usuario para ver su primera victoria: ";
            $nombreUsuario=trim(fgets(STDIN));
            $indice=indicePartidaGanada($coleccionPartidas,$nombreUsuario);
            $limite=count($coleccionPartidas);
            
            
            if($indice>=0){
                echo "************************************************ \n";
                echo "partida WORDIX " . $indice+1 . ": palabra " . $coleccionPartidas[$indice]["palabraWordix"] . "\n";
                echo "jugador: " . $coleccionPartidas[$indice]["jugador"] . "\n";
                echo "puntaje: " . $coleccionPartidas[$indice]["puntaje"] . "\n";
                echo "puntaje: " . $coleccionPartidas[$indice]["intentos"] . "\n";
                echo "************************************************ \n";
            }else{
                echo "el usuario ingresado no gano ninguna partida o no existe";
            }
            break;
        case 5:
            //Muestra el resumen de un jugador
            echo "ingrese el jugador para mostrar su resumen: ";
            $jugadorResumen=trim(fgets(STDIN));
            $limite=count($coleccionPartidas);
            $bandera=false;
            $arrayResumenJugador=resumen($coleccionPartidas,$jugadorResumen);
            if($arrayResumenJugador["partidas"]>0){
                $bandera=true;
            }
            if($bandera){
                $victorias=$arrayResumenJugador["victorias"];
                $partidas=$arrayResumenJugador["partidas"];
                echo "********************************************";
                echo "Jugador: " . $arrayResumenJugador["jugador"] . "\n";
                echo "Partidas: " . $arrayResumenJugador["partidas"] . "\n";
                echo "puntaje total: " . $arrayResumenJugador["puntaje"] . "\n";
                echo "Victorias: " . $arrayResumenJugador["victorias"] . "\n";
                echo "Porcentaje Victorias: " . ($victorias/$partidas)*100  . "\n";
                echo "adivinadas: \n intento 1: " . $arrayResumenJugador["intento1"] . "\n";
                echo "intento 2: " . $arrayResumenJugador["intento2"] . "\n";
                echo "intento 3: " . $arrayResumenJugador["intento3"] . "\n";
                echo "intento 4: " . $arrayResumenJugador["intento4"] . "\n";
                echo "intento 5: " . $arrayResumenJugador["intento5"] . "\n";
                echo "intento 6: " . $arrayResumenJugador["intento6"] . "\n";
                echo "********************************************";
            }else{
                echo "el usuario ingresado no ha jugado al wordix \n";
            }

            break;
        case 6:
            // Ordena las partidas
            ordenarPartidas($coleccionPartidas);
            break;
        case 7:
            // Añade una palabra al Wordix
            $palabra=leerPalabra5Letras();
            $coleccionPalabras=agregarPalabra($coleccionPalabras,$palabra);
            echo "Su palabra se ha añadido a WORDIX";            
            break;}
} while ($opcion != 8);