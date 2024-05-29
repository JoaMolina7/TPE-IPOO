<?php
class PasajeroEstandar extends Pasajero{

    public function __construct($nombre,$apellido,$nroDocumento,$telefono,$numAsiento,$numTicket){
        parent::__construct($nombre,$apellido,$nroDocumento,$telefono,$numAsiento,$numTicket);
    }
    
    
    public function __toString(){
        return parent::__toString();
    }   

    /**Implementar el método darPorcentajeIncremento() que retorne el porcentaje que debe aplicarse como incremento según
    las características del pasajero. Por último, para los pasajeros comunes el porcentaje de incremento es del 10 %. */
    public function darPorcentajeIncremento(){
        $porcentaje = parent::darPorcentajeIncremento();//Solo para mostrar que es una funcion polimorfica
        $porcentaje = 10;
        return $porcentaje;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>