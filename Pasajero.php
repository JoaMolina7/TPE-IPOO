<?php
/**Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase
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
class Pasajero{
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;

    public function __construct($nombre,$apellido,$nroDocumento,$telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
    }

    //Métodos de acceso

    //Getters

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getNroDocumento(){
        return $this->nroDocumento;
    }
    public function getTelefono(){
        return $this->telefono;
    }

    //Setters

    /**
     * Set nombre
     * @param string $newNombre
     */
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    /**
     * Set apellido
     * @param string $newApellido
     */
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    /**
     * Set nroDocumento
     * @param int $newNroDocumento
     */
    public function setNroDocumento($newNroDocumento){
        $this->nroDocumento = $newNroDocumento;
    }
    /**
     * Set telefono
     * @param int $newTelefono
     */
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }

    public function __toString(){
        return "Nombre: ". $this->getNombre() ."\nApellido: ". $this->getApellido() ."\nNro Documento: ". $this->getNroDocumento() 
        ."\nTelefono: ". $this->getTelefono() ."\n";
    }
}







?>