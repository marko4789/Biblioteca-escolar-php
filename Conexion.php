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

    }// Fin - Clase Server

    $server = new Server;

    $server->server = "127.0.0.1";
    $server->user = "root";
    $server->pass = "";
    $server->db = "bd_biblioteca";

    $server->conectar();

?>