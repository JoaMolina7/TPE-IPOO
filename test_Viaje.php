<?php
include_once('Viaje.php');
include_once('Pasajero.php');
include_once('ResponsableV.php');

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
        case 1://Modificar destino
            echo "Destino actual: " . $objViaje->getDestino() . "\n";
            echo "Ingrese el nuevo destino\n";
            $destino = trim(fgets(STDIN));
            $objViaje->setDestino($destino);
            break; 
        case 2://Modificar la cantidad maxima de pasajeros
            echo "La cantidad maxima de pasajeros actual es: " . $objViaje->getCantMaxPasajeros() . "\n";
            echo "Ingrese la nueva cantidad maxima de pasajeros\n";
            $cantMaxPasajeros = trim(fgets(STDIN));
            $objViaje->setCantMaxPasajeros($cantMaxPasajeros);
            break;
        case 3://Modificar los pasajeros
            do{
            echo "Elija una opcion\n";
            echo "1. Modificar un pasajero\n";
            echo "2. Cambiar todos los pasajeros\n";
            echo "3. Agregar pasajeros\n";
            echo "4. Salir\n";
            $opcion3 = trim(fgets(STDIN));
            switch ($opcion3) {
                case 1://modificar un pasajero
                    echo "Ingrese el DNI del pasajero a modificar\n";
                    $DNIpasajero = trim(fgets(STDIN));
                    $encontrado = false;
                    foreach ($objViaje->getColObjPasajeros() as $pasajero) {
                            if ($pasajero->getNroDocumento() == $DNIpasajero) {
                                echo "Pasajero encontrado\n";
                                $encontrado = true;
                                echo "Ingrese los nuevos datos del pasajero\n";
                                echo "Nombre: ";
                                $nombre = trim(fgets(STDIN));
                                echo "Apellido: ";
                                $apellido = trim(fgets(STDIN));
                                echo "Telefono: ";
                                $telefono = trim(fgets(STDIN));
                                $newPasajero = new Pasajero($nombre,$apellido,$DNIpasajero,$telefono);
                                $objViaje->modificarPasajero($newPasajero);
                            }
                    }
                            if($encontrado == false){
                                echo "Pasajero no encontrado\n";
                             }
                    break;
                    case 2://cambiar todos los pasajeros
                        echo "Ha elegido cambiar algunos pasajeros\n";
                        $cantMaxPasajeros = $objViaje->getCantMaxPasajeros();
                        echo "Ingrese el número de pasajeros que desea cambiar (máximo $cantMaxPasajeros): ";
                        $numCambios = intval(trim(fgets(STDIN)));
                        if ($numCambios > $cantMaxPasajeros) {
                            echo "El número ingresado excede la cantidad máxima de pasajeros.\n";
                            break;
                        }
                        
                        $newColObjPasajeros = [];
                        for ($i = 0; $i < $numCambios; $i++) {
                            echo "Ingrese los nuevos datos del pasajero\n";
                            echo "Nombre: ";
                            $nombre = trim(fgets(STDIN));
                            echo "Apellido: ";
                            $apellido = trim(fgets(STDIN));
                            echo "Nro Documento: ";
                            $nroDocumento = trim(fgets(STDIN));
                            echo "Telefono: ";
                            $telefono = trim(fgets(STDIN));
                            $newPasajero = new Pasajero($nombre, $apellido, $nroDocumento, $telefono);
                            $newColObjPasajeros[] = $newPasajero;
                        }
                        $objViaje->setColObjPasajeros($newColObjPasajeros);
                        break;
                    
                case 3://agregar pasajeros
                    // Verificar si la cantidad máxima de pasajeros ya ha sido alcanzada
                    if (count($objViaje->getColObjPasajeros()) >= $objViaje->getCantMaxPasajeros()) {
                        echo "No se pueden agregar más pasajeros. La cantidad máxima ha sido alcanzada.\n";
                        }else{
                    "Ha elegido agregar un pasajero\n";
                    echo "Ingrese los datos del nuevo pasajero\n";
                    echo "Nombre: ";
                    $nombre = trim(fgets(STDIN));
                    echo "Apellido: ";
                    $apellido = trim(fgets(STDIN));
                    echo "Nro Documento: ";
                    $nroDocumento = trim(fgets(STDIN));
                    echo "Telefono: ";
                    $telefono = trim(fgets(STDIN));
                    $newPasajero = new Pasajero($nombre,$apellido,$nroDocumento,$telefono);
                    if($objViaje->agregarPasajero($newPasajero)){
                        echo "Pasajero agregado con exito\n";
                    }else{
                        echo "No se pudo agregar el pasajero, ya existe un pasajero con ese DNI\n";
                    }
                    }
                    break;
                case 4:
                    "Saliendo...\n";
                    break;
                default:
                    echo "Ingrese una opción valida\n";
                    break;
                }       
            }while($opcion3 != 4);
            break;
        case 4://modificar responsable
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
            "Saliendo...\n";
            break;
        default:
            echo "Ingrese una opción valida\n";
            break;
        } 
    }while ($opcion2 != 5);
}
function ingresarViaje(){
    echo "Ingrese los datos del viaje\n";
    echo "Codigo: ";
    $codigo = trim(fgets(STDIN));
    echo "Destino: ";
    $destino = trim(fgets(STDIN));
    echo "Cant max pasajeros: ";
    $cantMaxPasajeros = trim(fgets(STDIN));
    
    echo "Datos del responsable: \n";
    echo "Nombre: ";
    $nombreResponsable = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellidoResponsable = trim(fgets(STDIN));
    echo "Nro Empleado: ";
    $nroEmpleado = trim(fgets(STDIN));
    echo "Nro Licencia: ";
    $nroLicencia = trim(fgets(STDIN));
    $objResponsableV = new ResponsableV($nombreResponsable,$apellidoResponsable,$nroEmpleado,$nroLicencia);
    
    echo "Ingrese los datos de los pasajeros\n";
echo "Recuerde que la cantidad máxima de pasajeros es: " . $cantMaxPasajeros . "\n";
$objColObjPasajeros = [];
$i = 0; // Contador para llevar el registro de la cantidad de pasajeros ingresados
while ($i < $cantMaxPasajeros) { 
    echo "Pasajero #" . ($i+1) . "\n";
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Nro Documento: ";
    $nroDocumento = trim(fgets(STDIN));
    echo "Telefono: ";
    $telefono = trim(fgets(STDIN));
    $objPasajero = new Pasajero($nombre,$apellido,$nroDocumento,$telefono);
    $objColObjPasajeros[] = $objPasajero;
    $i++; // Incrementar el contador
    // Verificar si se ha alcanzado la cantidad máxima permitida
    if ($i >= $cantMaxPasajeros) {
        break; // Salir del bucle
    }
    // Preguntar al usuario si desea seguir ingresando pasajeros
    echo "Desea agregar otro pasajero? (s/n): ";
    $continuar = trim(fgets(STDIN));
    if ($continuar != 's') {
        break; // Salir del bucle si la respuesta no es 's'
    }
}
    $objViaje = new Viaje($codigo,$destino,$cantMaxPasajeros,$objColObjPasajeros,$objResponsableV);   
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
            "Saliendo...\n";
            break;

       }
       } while ($opcion != 3);
                




?>