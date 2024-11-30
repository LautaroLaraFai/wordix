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
            $cantPartidas++; //guarda la cantitdad total de partidas
            $puntajeTotal+=$coleccionPartidas[$i]["puntaje"];
            if($coleccionPartidas[$i]["puntaje"]>0){
                $cantVictorias++; //guarda la cantitdad total de victorias
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
    while(!(ctype_alpha($nombre[0]))){ //verifica que la primera letra sea un string
        echo "el primer digito tiene que ser una letra ";
        $nombre=trim(fgets(STDIN));
    }
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
    $opcion=solicitarNumeroEntre($min, $max); //se asegura que el numero ingresado este dentro de los limites del menu
    return $opcion;
    }
/** Este modulo muestra la partida que el usuario desea ver
 * @param array[] $coleccionPartidas
 */
function mostrarPartida($coleccionPartidas){
     //int $nroPartida, $min, $max, $limite
    $min=1;
    $max=count($coleccionPartidas); //cuenta los elementos del array
    echo "ingrese un numero de partida a ver de 1 a " . $max . ": ";
    $nroPartida=solicitarNumeroEntre($min, $max); //se asegura que el numero de partida este dentro de los valores definidos
    $limite=count($coleccionPartidas); //cuenta la cantidad de elementos en el array de partidas
    while(!(is_numeric($nroPartida)||$nroPartida>0&&$nroPartida==(int)($nroPartida))||$nroPartida>$limite){ //verifica que el valor ingresado sea un numero entero mayor a 0 y que no se pase de los limites
        echo "el valor ingresado es invalido, ingrese un numero: ";
        $nroPartida=trim(fgets(STDIN)); //si el valor ingresado no cumple las condiciones vuelve a pedirlo
    }
    echo "\n******************************************** \n";
    echo "partida WORDIX " . $nroPartida . ": palabra " .  $coleccionPartidas[$nroPartida-1]["palabraWordix"] . "\n";
    echo "jugador: " . $coleccionPartidas[$nroPartida-1]["jugador"] . "\n";
    echo "puntaje: " . $coleccionPartidas[$nroPartida-1]["puntaje"] . "\n";
    echo "intento: " . (($coleccionPartidas[$nroPartida-1]["intentos"]==0) ? "no adivino la palabra \n" : "adivino la palabra en " . $coleccionPartidas[$nroPartida-1]["intentos"] . " intentos \n" );
    echo "******************************************** \n";
    
}

/** Este modulo agrega una palabra que el usuario ingresa al array de palabras
 * @param array[] $coleccionPalabras
 * @param string $palabra
 * @return array[]
 */
function agregarPalabra($coleccionPalabras,$palabra){
    //int $cant

    $cant=count($coleccionPalabras);
    $coleccionPalabras[$cant]=$palabra; //agrega $palabra en la ultima posicion del array de partidas
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
    while($i<$cant && !$encontrado){
        if($coleccionPartidas[$i]["puntaje"]>0 && $coleccionPartidas[$i]["jugador"]==$nombreUsuario){ //si el usuario tiene un puntaje >0 devuelve el indice de esa partida
            $partidaGanada=$i;
            $encontrado=true;
        }else{ //si no gano ninguna devuelve el indice -1
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

// int $cant, $min, $max, $numPalabra, $i, $countPartidas, $valorMaximo, $indice, $limite, $victorias, $partidas, $cantPartidas, $cantPalabras
// string $opcion, $nombreUsuario, $palabraOpcion1, $palabraWordix, $palabra, $jugadorResumen
// bool $bandera, $repetida, $yaExiste
// array[] $coleccionPalabras, $coleccionPartidas, $arrayResumenJugador

//Inicialización de variables:

$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

do {
   $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: 
            // Juega una partida de WORDIX con el numero de palabra que el usuario elija
            $cant=count($coleccionPalabras);
            $nombreUsuario=solicitarJugador();
            echo "ingrese un numero de palabra del 1 al " . $cant . ": ";
            $min=1; 
            $max=$cant; 
            $numPalabra=solicitarNumeroEntre($min, $max);   //se asegura que los valores sean correctos y este dentro de los valores
            $palabraOpcion1=$coleccionPalabras[$numPalabra-1];
           
            $bandera=false;
            $i=0;
            $countPartidas=count($coleccionPartidas);
            while ($i<$countPartidas && !$bandera){
                if($coleccionPartidas[$i]["palabraWordix"]==$palabraOpcion1 && $coleccionPartidas[$i]["jugador"]==$nombreUsuario||!(is_numeric($numPalabra))||$numPalabra-1>$cant || !((int)($numPalabra)==$numPalabra)){  //verifica que la palabra no haya sido utilizada por el jugador, que sea un numero entero y que no se pase de los limites
                    echo "la palabra ya ha sido utilizada o es invalida, elija otra: ";
                    $numPalabra=trim(fgets(STDIN));
                    if($numPalabra>0 && is_numeric($numPalabra) && (int)($numPalabra)==$numPalabra){   //se asegura que cuando se ingrese la palabra  sea un numero mayor a 0
                        $palabraOpcion1=$coleccionPalabras[$numPalabra-1]; //guarda la palabra que el usuario utilizo
                    }
                    $i=-1;
                }if($i==$countPartidas-1){
                  
                    $bandera=true;
                }
                $i++;
            }

            if($bandera){
                $partida=jugarWordix($palabraOpcion1,$nombreUsuario);
                $coleccionPartidas[$countPartidas]=$partida; //carga la partida en el arreglo de partidas 
            } 
            break;
        case 2: 
            // Juega una partida de WORDIX con una palabra aleatoria
            $nombreUsuario=solicitarJugador();
            $valorMaximo=(count($coleccionPalabras)-1);
            $indice=rand(0,$valorMaximo);            
            $repetida=false;

            $cantPartidas=count($coleccionPartidas);
            for($i=0;$i<$cantPartidas;$i++){
                if($coleccionPartidas[$i]["palabraWordix"]==$coleccionPalabras[$indice] && $coleccionPartidas[$i]["jugador"]==$nombreUsuario){
                    $repetida=true;
                }   //si la palabra fue elegida mas de 1 vez vuelve a elegir otra aleatoriamente
            }
            if(!$repetida){
            $palabraWordix=$coleccionPalabras[$indice];
            $partida=jugarWordix($palabraWordix,$nombreUsuario);
            $coleccionPartidas[$cantPartidas]=$partida;
            }else{
                echo "La palabra ya ha sido elegida ";
            }
            break;
        case 3: 
            // Muestra una partida que el usuario elija
            $partidaMostrada=mostrarPartida($coleccionPartidas);
            break;
        case 4:
            // Muestra la primera partida ganada de un jugador seleccionado
            $nombreUsuario=solicitarJugador();
            $indice=indicePartidaGanada($coleccionPartidas,$nombreUsuario);
            $limite=count($coleccionPartidas); //cuenta cuantos elementos hay en un array
            
            
            if($indice>=0){
                echo "\n************************************************ \n";
                echo "partida WORDIX " . $indice+1 . ": palabra " . $coleccionPartidas[$indice]["palabraWordix"] . "\n";
                echo "jugador: " . $coleccionPartidas[$indice]["jugador"] . "\n";
                echo "puntaje: " . $coleccionPartidas[$indice]["puntaje"] . "\n";
                echo "intentos: " . $coleccionPartidas[$indice]["intentos"] . "\n";
                echo "************************************************ \n";
            }else{
                echo "el usuario ingresado no gano ninguna partida o no existe";
            }
            break;
        case 5:
            //Muestra el resumen de un jugador
            $jugadorResumen=solicitarJugador();
            $limite=count($coleccionPartidas);
            $bandera=false;
            $arrayResumenJugador=resumen($coleccionPartidas,$jugadorResumen);
            if($arrayResumenJugador["partidas"]>0){
                $bandera=true;
            }
            if($bandera){
                $victorias=$arrayResumenJugador["victorias"];
                $partidas=$arrayResumenJugador["partidas"];
                echo "\n******************************************** \n";
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
                echo "******************************************** \n";
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
            $cantPalabras=count($coleccionPalabras);
            $yaExiste=false;
            for($i=0;$i<$cantPalabras;$i++){
                if($palabra==$coleccionPalabras[$i]){
                    $yaExiste=true;
                }
            }
            if(!$yaExiste){
                $coleccionPalabras=agregarPalabra($coleccionPalabras,$palabra);
                echo "\n Su palabra se ha añadido a WORDIX \n";            
            }else{
                echo "\n la palabra ya existe en WORDIX \n";
            }
            
            break;}
} while ($opcion != 8);