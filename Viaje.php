<?php
/**La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes.
 *De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase
(incluso los datos de los pasajeros). 
Utilice clases y arreglos  para   almacenar la información correspondiente a los pasajeros.
Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.

Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar
 la información del viaje, modificar y ver sus datos.

Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los 
atributos nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a 
una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona 
responsable de realizar el viaje, para ello cree una clase ResponsableV que
 registre el número de empleado, número de licencia, nombre y apellido. 
 La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero.
 Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
 Se debe verificar que el pasajero no este cargado mas de una vez en el viaje.
  De la misma forma cargue la información del responsable del viaje. */
class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $colObjPasajeros;
    private $objResponsableV;
    private $costoViaje;
    private $sumaCostos;

    /**
     * Método constructor
     * @param string $codigo
     * @param string $destino
     * @param int $cantMaxPasajeros
     * @param array $colObjPasajeros
     * @param object $objResponsableV
     */
    public function __construct($codigo,$destino,$cantMaxPasajeros,$colObjPasajeros,$objResponsableV,$costoViaje,$sumaCostos){
        $this->codigoViaje = $codigo;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->colObjPasajeros = $colObjPasajeros;
        $this->objResponsableV = $objResponsableV;
        $this->costoViaje = $costoViaje;
        $this->sumaCostos = $sumaCostos;
    }

    //Métodos de acceso

    //Getters

    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getColObjPasajeros(){
        return $this->colObjPasajeros;
    }
    public function getObjResponsableV(){
        return $this->objResponsableV;
    }
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function getSumaCostos(){
        return $this->sumaCostos;
    }

    //Setters
    public function setCodigoViaje($newCodigoViaje){
        $this->codigoViaje = $newCodigoViaje;
    }
    public function setDestino($newDestino){
        $this->destino = $newDestino;
    }
    public function setCantMaxPasajeros($newCantMaxPasajeros){
        $this->cantMaxPasajeros = $newCantMaxPasajeros;
    }
    public function setColObjPasajeros($newcolObjPasajeros){
        $this->colObjPasajeros = $newcolObjPasajeros;
    }
    public function setObjResponsableV($newObjResponsableV){
        $this->objResponsableV = $newObjResponsableV;
    }
    public function setCostoViaje($newCostoViaje){
        $this->costoViaje = $newCostoViaje;
    }
    public function setSumaCostos($newSumaCostos){
        $this->sumaCostos = $newSumaCostos;
    }   

     /**
     * Método privado para mostrar los datos de los pasajeros en forma de cadena de texto.
     * @param array $arrayObjPasajeros Colección de objetos de la clase Pasajero.
     * @return string Cadena de texto con los datos de los pasajeros.
     */
    private function verDatosArrayObjetos($arrayObjPasajeros){
        $cadena = "";
        foreach($arrayObjPasajeros as $cadaObjeto){
            $cadena = $cadena . $cadaObjeto->getNombre() ." ". $cadaObjeto->getApellido() ." - ". $cadaObjeto->getNroDocumento() ."\n";
        }
        return $cadena;
    }
    public function __toString(){
        $arregloPasajeros = $this->getColObjPasajeros();
        $cadenaPasajeros = $this->verDatosArrayObjetos($arregloPasajeros);
        return "Codigo viaje: ". $this->getCodigoViaje() ."\nDestino: ". $this->getDestino() ."\nCantidad max pasajeros: ". $this->getCantMaxPasajeros() 
        ."\n\nPasajeros: \n". $cadenaPasajeros . "\nResponsable: ". $this->getObjResponsableV() ."\nCosto viaje: ". $this->getCostoViaje() ."\nSuma costos: ". $this->getSumaCostos() . "\n";
    }

    /**
     * Método para modificar los datos de un pasajero.
     * @param object $objPasajero Objeto de la clase Pasajero con los nuevos datos del pasajero.
     */
    public function modificarPasajero($objPasajero) {
        $arregloPasajeros = $this->getColObjPasajeros();
        $encontrado = false;
        $indice = 0;
    
        while (!$encontrado && $indice < count($arregloPasajeros)) {
            if ($arregloPasajeros[$indice]->getNroDocumento() == $objPasajero->getNroDocumento()){
                if($objPasajero instanceof Pasajero){
                    $arregloPasajeros[$indice]->setNombre($objPasajero->getNombre());
                    $arregloPasajeros[$indice]->setApellido($objPasajero->getApellido());
                    $arregloPasajeros[$indice]->setTelefono($objPasajero->getTelefono());
                    $arregloPasajeros[$indice]->setNumAsiento($objPasajero->getNumAsiento());
                    $arregloPasajeros[$indice]->setNumTicket($objPasajero->getNumTicket());   
                }
                if($objPasajero instanceof PasajeroVIP){
                    $arregloPasajeros[$indice]->setNombre($objPasajero->getNombre());
                    $arregloPasajeros[$indice]->setApellido($objPasajero->getApellido());
                    $arregloPasajeros[$indice]->setNroDocumento($objPasajero->getNroDocumento());
                    $arregloPasajeros[$indice]->setTelefono($objPasajero->getTelefono());
                    $arregloPasajeros[$indice]->setNumAsiento($objPasajero->getNumAsiento());
                    $arregloPasajeros[$indice]->setNumTicket($objPasajero->getNumTicket());
                    $arregloPasajeros[$indice]->setNumViajeroFrecuente($objPasajero->getNumViajeroFrecuente());
                    $arregloPasajeros[$indice]->setCantMillas($objPasajero->getCantMillas());
                }
                if($objPasajero instanceof PasajeroEspecial){
                    $arregloPasajeros[$indice]->setNombre($objPasajero->getNombre());
                    $arregloPasajeros[$indice]->setApellido($objPasajero->getApellido());
                    $arregloPasajeros[$indice]->setNroDocumento($objPasajero->getNroDocumento());
                    $arregloPasajeros[$indice]->setTelefono($objPasajero->getTelefono());
                    $arregloPasajeros[$indice]->setNumAsiento($objPasajero->getNumAsiento());
                    $arregloPasajeros[$indice]->setNumTicket($objPasajero->getNumTicket());
                    $arregloPasajeros[$indice]->setServicioEspecial($objPasajero->getServicioEspecial());
                    $arregloPasajeros[$indice]->setAsistencia($objPasajero->getAsistencia());
                    $arregloPasajeros[$indice]->setComidaEspecial($objPasajero->getComidaEspecial());
                }
                $encontrado = true;
            }
            $indice++;
        }
    }

    /**
     * Método para agregar un pasajero al viaje.
     * @param object $objPasajero Objeto de la clase Pasajero a agregar al viaje.
     * @return bool Devuelve true si se pudo agregar el pasajero correctamente, false en caso contrario.
     */
    public function agregarPasajero($objPasajero){
        $sePudoAgregar = false;
        if((count($this->getColObjPasajeros()) < $this->getCantMaxPasajeros()) && ($this->pasajeroYaExiste($objPasajero) == false)){
        $arregloPasajeros = $this->getColObjPasajeros();
        $arregloPasajeros[] = $objPasajero;
        $this->setColObjPasajeros($arregloPasajeros);
        $sePudoAgregar = true;
    }
        return $sePudoAgregar;
    }

    /**
     * Método para verificar si un pasajero ya está agregado al viaje.
     * @param object $objPasajero Objeto de la clase Pasajero a verificar.
     * @return bool Devuelve true si el pasajero ya existe en el viaje, false en caso contrario.
     */
    public function pasajeroYaExiste($objPasajero){    
        $encontrado = false;
        $arregloPasajeros = $this->getColObjPasajeros();
        $i = 0;
        while(!$encontrado && $i < count($arregloPasajeros)){
            if($arregloPasajeros[$i]->getNroDocumento() == $objPasajero->getNroDocumento()){
                $encontrado = true;
            }
            $i++;
        }
        return $encontrado;
    }
 
    /**Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros e
    implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros 
    ( solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado
    por el pasajero.*/
    public function venderPasaje($objPasajero){
        $costoFinal = -1;
            if($this->hayPasajeDisponible()){
                $this->agregarPasajero($objPasajero);
                $porcentaje = ($objPasajero->darPorcentajeIncremento())/100;
                $costo = $this->getCostoViaje();
                $costoFinal = $costo + ($costo * $porcentaje);
                $sumaCostos = $this->getSumaCostos();
                $sumaCostos = $sumaCostos + $costoFinal;
                $this->setSumaCostos($sumaCostos);
            }
        return $costoFinal;
    }

      /*Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor
    a la cantidad máxima de pasajeros y falso caso contrario */
    public function hayPasajeDisponible(){
        $cantidadPasajeros = count($this->getColObjPasajeros());
        $cantidadMaximaPasajeros = $this->getCantMaxPasajeros();
        $menor = false;

            if($cantidadPasajeros < $cantidadMaximaPasajeros){
                $menor = true;
            }

        return $menor;
    }
    
    
    
    
    
    
    
    
}
?>