<?php

$nombreBanco = "Bancolombia";
$usuarios = [
    "usuario1" => ["tipo" => "debito",[
        
        "numeroTarjeta" => "12345", 
        "saldo" => 0,  
        "clave" => "12345"   
    ]],

    ["tipo" => "credito",[
        
        "numeroTarjeta" => "54321", 
        "saldo" => 0,  
        "clave" => "54321"   
    ]],
    "usuario2" => ["tipo" => "debito",[
        
        "numeroTarjeta" => "67890", 
        "saldo" => 0,  
        "clave" => "67890"   
    ]],

    ["tipo" => "credito",[
        
        "numeroTarjeta" => "09876", 
        "saldo" => 0,  
        "clave" => "09876"   
    ]],
    ];
// Funciones
function mostrarOpcionesMenu() {
    echo "Seleccione una opción:\n";
    echo "1. Retirar dinero\n";
    echo "2. Consignar dinero\n";
    echo "3. Consultar saldo\n";
    echo "4. Salir\n";
    echo "Ingrese su elección: ";
}

function mostrarOpcionesRetiro() {
    echo "Seleccione una cantidad a retirar:\n";
    echo "1. 50 mil\n";
    echo "2. 100 mil\n";
    echo "3. 200 mil\n";
    echo "4. 500 mil\n";
    echo "Ingrese su elección: ";
}

function retirarDinero(&$cuenta, $cantidad) {
    if ($cuenta['saldo'] >= $cantidad) {
        $cuenta['saldo'] -= $cantidad;
        echo "Se ha retirado $" . $cantidad . ".\n";
        echo "Su saldo actual es $" . $cuenta['saldo'] . ".\n";
    } else {
        echo "Fondos insuficientes en su cuenta.\n";
    }
}

function consignarDinero(&$cuenta, $cantidad) {
    $cuenta['saldo'] += $cantidad;
    echo "Se ha consignado $" . $cantidad . " a su cuenta.\n";
    echo "Su saldo actual es $" . $cuenta['saldo'] . ".\n";
}

function consultarSaldo($cuenta) {
    echo "Su saldo actual es $" . $cuenta['saldo'] . ".\n";
}

// Mostrar mensaje de bienvenida
echo "¡Bienvenido al " . $nombreBanco . "!\n";

// Iniciar sesión
echo "Ingrese su número de tarjeta: ";
$numeroTarjetaIngresado = readline();
echo "Ingrese su clave: ";
$claveIngresada = readline();

// Verificar tarjeta y clave
$usuarioEncontrado = null;
foreach ($usuarios as $usuario) {
    if ($usuario['numeroTarjeta'] == $numeroTarjetaIngresado && $usuario['clave'] == $claveIngresada) {
        $usuarioEncontrado = $usuario;
        break;
    }
}

if ($usuarioEncontrado == null) {
    echo "Número de tarjeta o clave incorrectos.\n";
    exit;
}

if ($usuarioEncontrado['tipo'] != "debito") {
    echo "Solo se aceptan tarjetas de débito.\n";
    exit;
}

$cuenta = $usuarioEncontrado;

// Menú principal 
$opcion = 0;
while ($opcion != 4) {
    mostrarOpcionesMenu();
    $opcion = readline();
    
    switch ($opcion) {
        case '1':
            if ($cuenta['saldo'] > 0) {
                mostrarOpcionesRetiro();
                $opcionRetiro = readline();
                
                $cantidad = match($opcionRetiro) {
                    '1' => 50000,
                    '2' => 100000,
                    '3' => 200000,
                    default => 0
                };
                
                if ($cantidad > 0) {
                    retirarDinero($cuenta, $cantidad);
                } else {
                    echo "Opción no válida.\n";
                }
            } else {
                echo "No tiene saldo suficiente. Realice una consignación primero.\n";
            }
            break;
        case '2':
            echo "Ingrese la cantidad a consignar: ";
            $cantidadConsignar = readline();
            consignarDinero($cuenta, $cantidadConsignar);
            break;
        case '3':
            consultarSaldo($cuenta);
            break;
        case '4':
            echo "Por favor, retire su tarjeta.\n";
            break;
        default:
            echo "Opción no válida.\n";
            break;
    }
}
?>

