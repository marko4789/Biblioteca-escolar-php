<?php

    class Server {

        public $server;
        public $user;
        public $pass;
        public $db;
        public $conexion;

        public function conectar() {

            $this->conexion = new mysqli( $this->server, $this->user, $this->pass, $this->db );

            if ( $this->conexion -> connect_error) {
                echo "<script>
                            alert('Error: No se ha podido conectar con el servidor.');
                            window.location.href = 'Index.php';
                        </script>";
                die ("Error: " . $this->conexion->connect_error);
                
            }

        }// Fin - conectar

        public function ejecutarConsulta($sql){
           
                if($sentencia = $this->conexion->prepare($sql)){
                    $sentencia->execute();
                    if($resultado = $sentencia->get_result() )
                    return $resultado;
                }
           
        }

        public function consultarTabla($tabla, $condiciones = null) {
            if ($condiciones === null) {
                $sql = "Select * FROM $tabla WHERE status = 'Activo';";
            }else {
                $sql = "Select * FROM $tabla WHERE $condiciones status = 'Activo';";
            }
            
            return $this->conexion->query($sql);
            
        }

        


        public function buscarUsuario($usuario) {
            if (is_int($usuario)){

                $sql = "CALL buscarGeneral('usuarios','idUsuario',$usuario);";

            }else{

                $sql = "CALL buscarUsuario('$usuario');";
           
            }
                       
            if($sentencia = $this->conexion->prepare($sql)){
                $sentencia->execute();
                if($resultado = $sentencia->get_result() )
                return $resultado;
            }
        }


        public function buscarAutor($autor) {
            if (is_int($autor)){
                $sql = "CALL buscarGeneral('autores','idAutor',$autor);";  
            }else{
               
                    $sql = "CALL buscarAutor('$autor');";
            }
            
            //return $this->conexion->query($sql);
            if($sentencia = $this->conexion->prepare($sql)){
                $sentencia->execute();
                if($resultado = $sentencia->get_result() )
                return $resultado;
            }
        }


        public function buscarCategoria($categoria) {
            if (is_int($categoria)){

                $sql = "CALL buscarGeneral('categorias','idCategoria',$categoria);";  

            }else{
                   
                $sql = "CALL buscarCategoria('$categoria');";
            }
            
                //return $this->conexion->query($sql);
                if($sentencia = $this->conexion->prepare($sql)){
                    $sentencia->execute();
                    if($resultado = $sentencia->get_result() )
                    return $resultado;
                }
            }
            

        public function buscarEditorial($editorial) {
            if (is_int($editorial)){

                $sql = "CALL buscarGeneral('editoriales','idEditorial',$editorial);"; 

            }else{
 
                    $sql = "CALL buscarEditorial('$editorial');"; 

            }
            
           // return $this->conexion->query($sql);
           if($sentencia = $this->conexion->prepare($sql)){
            $sentencia->execute();
            if($resultado = $sentencia->get_result() )
            return $resultado;
           }
        }
 

        public function buscarLibro($libro) {
            if (is_int($libro)){

                $sql = "CALL buscarLibroID($libro);";

            }else{

                $sql = "CALL buscarLibro('$libro');";

            }         
           
            if($sentencia = $this->conexion->prepare($sql)){
                $sentencia->execute();
                if($resultado = $sentencia->get_result() )
                 return $resultado;
            }
        }



        public function buscarAlumno($alumno) {
            if (is_int($alumno)){ 
                $sql = "CALL buscarGeneral('alumnos','idAlumno',$alumno);";
            }else{
   
                $sql = "CALL buscarAlumno('$alumno');";

            }
            
          if($sentencia = $this->conexion->prepare($sql)){
            $sentencia->execute();
            if($resultado = $sentencia->get_result() )
            return $resultado;
            }
        }


       public function obtenerAutores($idLibro) {

        $sql = "CALL obtenerAutores($idLibro);";

        if($sentencia = $this->conexion->prepare($sql)){
            $sentencia->execute();
            if($resultado = $sentencia->get_result() )
            return $resultado;
         }
       }


        public function consultarPrestamo(){

            $sql = "CALL consultarPrestamo();";

           // return $this->conexion->query($sql);
            if($sentencia = $this->conexion->prepare($sql)){
                $sentencia->execute();
                if($resultado = $sentencia->get_result() )
                return $resultado;
            }
        }


        public function buscarPrestamo($prestamo) {
            if (is_int($prestamo)){

                     $sql = "CALL buscarPrestamoID('$prestamo');";

            }else{
           
                     $sql = "CALL buscarPrestamo('$prestamo');";

            }
            
           // return $this->conexion->query($sql);
           if($sentencia = $this->conexion->prepare($sql)){
            $sentencia->execute();
            if($resultado = $sentencia->get_result() )
            return $resultado;
            }

        }

    }// Fin - Clase Server

    $server = new Server;

    $server->server = "127.0.0.1";
    $server->user = "root";
    $server->pass = "";
    $server->db = "bd_biblioteca";

    $server->conectar();

?>