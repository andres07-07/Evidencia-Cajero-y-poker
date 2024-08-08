<?php

function crearMazo() {
    $palos = ['♥', '♦', '♣', '♠'];
    $valores = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $mazo = [];
    
    foreach ($palos as $palo) {
        foreach ($valores as $valor) {
            $mazo[] = "$valor de $palo";
        }
    }
    
    shuffle($mazo);
    return $mazo;
}

function repartirCartas() {
    $mazo = crearMazo();
    return array_splice($mazo, 0, 5);
}

function mostrarCartas($cartas) {
    foreach ($cartas as $carta) {
        echo "$carta\n";
    }
}

function evaluarMano($mano) {
    $valores = array_map(function($carta) {
        return explode(' ', $carta)[0];
    }, $mano);
    
    $repeticiones = array_count_values($valores);
    $escalera = ['A', 'K', 'Q', 'J', '10'];

    if (array_diff($escalera, $valores) === []) {
        return "Escalera Real";}
    elseif (in_array(4, $repeticiones)) {
        return "Póker";}
    elseif (in_array(3, $repeticiones) && in_array(2, $repeticiones)) {
        return "Full House";} 
    elseif (in_array(3, $repeticiones)) {
        return "Trío"; }
     elseif (count(array_filter($repeticiones, fn($v) => $v == 2)) == 2) {
        return "Dos Pares";} 
    elseif (in_array(2, $repeticiones)) {
        return "Un Par";} 
    else {
        return "Carta Alta: " . max($valores);
    }
}

function jugarPoker() {
    echo "Bienvenido al mejor juego de poker\n";
    
    $nombreJugador = readline("Por favor, ingresa tu nombre:");
    $mano = repartirCartas();
    echo "Cartas de $nombreJugador:\n";
    mostrarCartas($mano);
    
    $resultado = evaluarMano($mano);
    echo "Resultado de la mano de $nombreJugador: $resultado\n";
}

jugarPoker();

?>
