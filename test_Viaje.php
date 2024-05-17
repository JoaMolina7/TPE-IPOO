<?php
include_once('Viaje.php');
include_once('Pasajero.php');
include_once('ResponsableV.php');
include_once('PasajeroVIP.php');
include_once('PasajeroEspecial.php');

function opcionModificar($objViaje){
    do{
        echo "Que desea modificar?\n";
        echo "1. Destino\n";
        echo "2. Cantidad maxima de pasajeros\n";
        echo "3. Pasajeros\n";
        echo "4. Responsable\n";
        echo "5. Salir\n";
        $opcion2 = trim(fgets(STDIN));
        switch ($opcion2) {
            case 1:
                echo "Destino actual: " . $objViaje->getDestino() . "\n";
                echo "Ingrese el nuevo destino\n";
                $destino = trim(fgets(STDIN));
                $objViaje->setDestino($destino);
                break; 
            case 2:
                echo "La cantidad maxima de pasajeros actual es: " . $objViaje->getCantMaxPasajeros() . "\n";
                echo "Ingrese la nueva cantidad maxima de pasajeros\n";
                $cantMaxPasajeros = trim(fgets(STDIN));
                $objViaje->setCantMaxPasajeros($cantMaxPasajeros);
                break;
            case 3:
                do{
                    echo "Elija una opcion\n";
                    echo "1. Modificar un pasajero\n";
                    echo "2. Agregar pasajeros\n";
                    echo "3. Salir\n";
                    $opcion3 = trim(fgets(STDIN));
                    switch ($opcion3) {
                        case 1:
                            echo "Ha elegido modificar un pasajero\n";
                            modificarPasajero($objViaje);
                            break;       
                        case 2:
                            agregarPasajero($objViaje);
                            break;
                        case 3:
                            echo "Saliendo...\n";
                            break;
                        default:
                            echo "Ingrese una opción valida\n";
                            break;
                    }       
                }while($opcion3 != 3);
                break;
            case 4:
                echo "Ha decidido modificar el responsable\n";
                echo "El responsable actual es: \n".$objViaje->getObjResponsableV();
                echo "Ingrese los datos del nuevo responsable\n";
                echo "Nombre: ";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Apellido: ";
                $apellidoResponsable = trim(fgets(STDIN));
                echo "Nro Empleado: ";
                $nroEmpleado = trim(fgets(STDIN));
                echo "Nro Licencia: ";
                $nroLicencia = trim(fgets(STDIN));
                $objResponsableV = new ResponsableV($nombreResponsable,$apellidoResponsable,$nroEmpleado,$nroLicencia);
                $objViaje->setObjResponsableV($objResponsableV);
                break;
            case 5:
                echo "Saliendo...\n";
                break;
            default:
                echo "Ingrese una opción valida\n";
                break;
        } 
    }while ($opcion2 != 5);
}

function ingresarPasajeroStandard() {
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Nro Documento: ";
    $nroDocumento = trim(fgets(STDIN));
    echo "Telefono: ";
    $telefono = trim(fgets(STDIN));
    echo "Nro Asiento: ";
    $numAsiento = trim(fgets(STDIN));
    echo "Nro Ticket: ";
    $numTicket = trim(fgets(STDIN));
    return new Pasajero($nombre, $apellido, $nroDocumento, $telefono, $numAsiento, $numTicket);
}

function ingresarPasajeroVIP() {
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Nro Documento: ";
    $nroDocumento = trim(fgets(STDIN));
    echo "Telefono: ";
    $telefono = trim(fgets(STDIN));
    echo "Nro Asiento: ";
    $numAsiento = trim(fgets(STDIN));
    echo "Nro Ticket: ";
    $numTicket = trim(fgets(STDIN));
    echo "Nro Viajero Frecuente: ";
    $numViajeroFrecuente = trim(fgets(STDIN));
    echo "Cant Millas: ";
    $cantMillas = trim(fgets(STDIN));
    return new PasajeroVIP($nombre, $apellido, $nroDocumento, $telefono, $numAsiento, $numTicket, $numViajeroFrecuente, $cantMillas);
}

function ingresarPasajeroEspecial() {
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Nro Documento: ";
    $nroDocumento = trim(fgets(STDIN));
    echo "Telefono: ";
    $telefono = trim(fgets(STDIN));
    echo "Nro Asiento: ";
    $numAsiento = trim(fgets(STDIN));
    echo "Nro Ticket: ";
    $numTicket = trim(fgets(STDIN));
    echo "Necesita servicio especial? Si necesita ingrese true, si no ingrese false: ";
    $servicioEspecial = trim(fgets(STDIN));
    echo "Necesita asistencia? Si necesita ingrese true, si no ingrese false: ";
    $asistencia = trim(fgets(STDIN));
    echo "Necesita comida especial? Si necesita ingrese true, si no ingrese false: ";
    $comidaEspecial = trim(fgets(STDIN));
    return new PasajeroEspecial($nombre, $apellido, $nroDocumento, $telefono, $numAsiento, $numTicket, $servicioEspecial, $asistencia, $comidaEspecial);
}

function modificarPasajero($objViaje) {
    $encontrado = false;
    $i = 0;
    echo "Ingrese el DNI del pasajero a modificar\n";
    $DNIpasajero = trim(fgets(STDIN));
    while(!$encontrado && $i < count($objViaje->getColObjPasajeros())) {
        if ($objViaje->getColObjPasajeros()[$i]->getNroDocumento() == $DNIpasajero) {
            echo "Pasajero encontrado\n";
            $encontrado = true;
            $tipoPasajero = null;

            if($objViaje->getColObjPasajeros()[$i] instanceof Pasajero){
                $tipoPasajero = "s";
            } else if($objViaje->getColObjPasajeros()[$i] instanceof PasajeroVIP){
                $tipoPasajero = "v";
            } else if($objViaje->getColObjPasajeros()[$i] instanceof PasajeroEspecial){
                $tipoPasajero = "e";
            }

            switch($tipoPasajero){
                case 's':  
                    $newPasajero = ingresarPasajeroStandard();
                    break;
                case 'v':  
                    $newPasajero = ingresarPasajeroVIP();
                    break;
                case 'e':  
                    $newPasajero = ingresarPasajeroEspecial();
                    break;
            }
            $objViaje->modificarPasajero($newPasajero);
        }
        $i++;
    }
    if(!$encontrado){
        echo "Pasajero no encontrado\n";
    }
}

function agregarPasajero($objViaje) {
    if (count($objViaje->getColObjPasajeros()) >= $objViaje->getCantMaxPasajeros()) {
        echo "No se pueden agregar más pasajeros. La cantidad máxima ha sido alcanzada.\n";
    } else {
        echo "Ha elegido agregar un pasajero\n";
        echo "Su pasajero es Standard(s), VIP(v) o Especial(e)?: ";
        $tipo = trim(fgets(STDIN));
        switch($tipo){
            case 's':
                $newPasajero = ingresarPasajeroStandard();
                break;
            case 'v':
                $newPasajero = ingresarPasajeroVIP();
                break;
            case 'e':
                $newPasajero = ingresarPasajeroEspecial();
                break;
            default:
                echo "Ingrese una opción valida\n";
                return;
        }
        if(($objViaje->venderPasaje($newPasajero)) > 0){
            echo "Pasajero agregado con exito\n";
        } else {
            echo "No se pudo agregar el pasajero, ya existe un pasajero con ese DNI\n";
        }
    }
}

function ingresarViaje() {
    echo "Ingrese los datos del viaje\n";
    echo "Codigo: ";
    $codigo = trim(fgets(STDIN));
    echo "Destino: ";
    $destino = trim(fgets(STDIN));
    echo "Cant max pasajeros: ";
    $cantMaxPasajeros = trim(fgets(STDIN));
    echo "Costo pasaje: ";
    $costoViaje = trim(fgets(STDIN));
    $sumaCostos = 0;

    echo "Datos del responsable: \n";
    echo "Nombre: ";
    $nombreResponsable = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellidoResponsable = trim(fgets(STDIN));
    echo "Nro Empleado: ";
    $nroEmpleado = trim(fgets(STDIN));
    echo "Nro Licencia: ";
    $nroLicencia = trim(fgets(STDIN));
    $objResponsableV = new ResponsableV($nombreResponsable, $apellidoResponsable, $nroEmpleado, $nroLicencia);

    echo "Ingrese los datos de los pasajeros\n";
    echo "Recuerde que la cantidad máxima de pasajeros es: " . $cantMaxPasajeros . "\n";
    $objColObjPasajeros = [];
    $objViaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $objColObjPasajeros, $objResponsableV, $costoViaje, $sumaCostos); 
    $i = 0; 
    while ($i < $cantMaxPasajeros) {
        echo "Su pasajero es Standard(s), VIP(v) o Especial(e)?: ";
        $tipo = trim(fgets(STDIN));
        switch($tipo){
            case 's':
                $objPasajero = ingresarPasajeroStandard();
                break;
            case 'v':
                $objPasajero = ingresarPasajeroVIP();
                break;
            case 'e':
                $objPasajero = ingresarPasajeroEspecial();
                break;
            default:
                echo "Ingrese una opción valida\n";
                continue 2; // Regresa al principio del while
        }
        $objViaje->venderPasaje($objPasajero);
        $i++; 
        if ($i >= $cantMaxPasajeros) {
            break;
        }
        echo "Desea agregar otro pasajero? (s/n): ";
        $continuar = trim(fgets(STDIN));
        if ($continuar != 's') {
            break;
        }
    }

    return $objViaje;
}

/******************************PROGRAMA PRINCIPAL*********************************/
$objetoViaje = ingresarViaje();
do {
    echo "Elija una opción...\n";
    echo "1. Ver datos del viaje\n";
    echo "2. Modificar datos del viaje\n";
    echo "3. Salir\n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1:
            echo $objetoViaje;
            break;
        case 2:
            opcionModificar($objetoViaje);
            break;
        case 3:
            echo "Saliendo...\n";
            break;
        default:
            echo "Ingrese una opción valida\n";
            break;
    }
} while ($opcion != 3);
?>
