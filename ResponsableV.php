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
class ResponsableV{
    private $nombre;
    private $apellido;
    private $nroEmpleado;
    private $nroLicencia;

    public function __construct($nombre,$apellido,$nroEmpleado,$nroLicencia){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
    }

    //Métodos de acceso

    //Getters

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
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
     * Set nroEmpleado
     * @param int $newNroEmpleado
     */
    public function setNroEmpleado($newNroEmpleado){
        $this->nroEmpleado = $newNroEmpleado;
    }
    /**
     * Set nroLicencia
     * @param int $newNroLicencia
     */
    public function setnroLicencia($newNroLicencia){
        $this->nroLicencia = $newNroLicencia;
    }

    public function __toString(){
        return "Nombre: ". $this->getNombre() ."\nApellido: ". $this->getApellido() ."\nNro Documento: ". $this->getNroEmpleado() 
        ."\nnroLicencia: ". $this->getNroLicencia() ."\n";
    }
}







?>