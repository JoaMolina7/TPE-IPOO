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

    /**
     * Método constructor
     * @param string $codigo
     * @param string $destino
     * @param int $cantMaxPasajeros
     * @param array $colObjPasajeros
     * @param object $objResponsableV
     */
    public function __construct($codigo,$destino,$cantMaxPasajeros,$colObjPasajeros,$objResponsableV){
        $this->codigoViaje = $codigo;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->colObjPasajeros = $colObjPasajeros;
        $this->objResponsableV = $objResponsableV;
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

    //Setters

    /** Set codigoViaje
     * @param string $newCodigoViaje
     */
    public function setCodigoViaje($newCodigoViaje){
        $this->codigoViaje = $newCodigoViaje;
    }
     /** Set destino
     * @param string $newDestino
     */
    public function setDestino($newDestino){
        $this->destino = $newDestino;
    }
     /** Set cantMaxPasajeros
     * @param int $newCantMaxPasajeros
     */
    public function setCantMaxPasajeros($newCantMaxPasajeros){
        $this->cantMaxPasajeros = $newCantMaxPasajeros;
    }
     /** Set colObjPasajeros
     * @param array $newcolObjPasajeros
     */
    public function setColObjPasajeros($newcolObjPasajeros){
        $this->colObjPasajeros = $newcolObjPasajeros;
    }
     /** Set objResponsableV
     * @param object $newObjResponsableV
     */
    public function setObjResponsableV($newObjResponsableV){
        $this->objResponsableV = $newObjResponsableV;
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
        ."\nPasajeros: \n". $cadenaPasajeros . "\nResponsable: \n". $this->getObjResponsableV();
    }

    /**
     * Método para modificar los datos de un pasajero.
     * @param object $objPasajero Objeto de la clase Pasajero con los nuevos datos del pasajero.
     */
    public function modificarPasajero($objPasajero){
        $arregloPasajeros = $this->getColObjPasajeros();
        foreach($arregloPasajeros as $cadaObjeto){
            if($cadaObjeto->getNroDocumento() == $objPasajero->getNroDocumento()){
                $cadaObjeto->setNombre($objPasajero->getNombre());
                $cadaObjeto->setApellido($objPasajero->getApellido());
                $cadaObjeto->setTelefono($objPasajero->getTelefono());
            }
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

}









?>