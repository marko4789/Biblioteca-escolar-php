<?php

    class Server {

        public $server;
        public $user;
        public $pass;
        public $db;
        public $conexion;

        public function conectar () {

            $this->conexion = new mysqli( $this->server, $this->user, $this->pass, $this->db );

            if ( $this->conexion -> connect_error) {
                die ("Error: " . $this->conexion->connect_error);
            }

        }// Fin - conectar

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
                $sql = "Select * FROM usuarios WHERE idUsuario = $usuario AND status = 'Activo';";  
            }else{
                $sql = "Select * FROM usuarios WHERE CONCAT(
                    idUsuario,
                    nombreUsuario, 
                    nombre, 
                    apellidoPaterno, 
                    apellidoMaterno) like '%$usuario%' AND status = 'Activo';";    
            }
            
            return $this->conexion->query($sql);
        }

        public function buscarAutor($autor) {
            if (is_int($autor)){
                $sql = "Select * FROM autores WHERE idAutor = $autor AND status = 'Activo';";  
            }else{
                $sql = "Select * FROM autores WHERE CONCAT(
                    idAutor,
                    nombre, 
                    apellidoPaterno, 
                    apellidoMaterno) like '%$autor%' AND status = 'Activo';";    
            }
            
            return $this->conexion->query($sql);
        }

        public function buscarEditorial($editorial) {
            if (is_int($editorial)){
                $sql = "Select * FROM editoriales WHERE idEditorial = $editorial AND status = 'Activo';";  
            }else{
                $sql = "Select * FROM editoriales WHERE CONCAT(
                    idEditorial,
                    editorial) like '%$editorial%' AND status = 'Activo';";    
            }
            
            return $this->conexion->query($sql);
        }

    }// Fin - Clase Server

    $server = new Server;

    $server->server = "127.0.0.1";
    $server->user = "root";
    $server->pass = "";
    $server->db = "bd_biblioteca";

    $server->conectar();

?>