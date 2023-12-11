<?php
    class Taller extends Conectar{
        public function get_producto() {
            $conectar = parent::conexion();
            parent::set_names();
        }
    }
?>