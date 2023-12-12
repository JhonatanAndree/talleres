<?php
    class Taller extends Conectar{
        public function get_taller() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "select * FROM tm_taller WHERE estado=1";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_taller_x_id($taller_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "select * FROM tm_taller WHERE taller_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$taller_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_taller($taller_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_taller
                set
                    estado=0,
                    fech_elim=now()
                WHERE
                    taller_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$taller_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_taller($taller_nom) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_taller (taller_id, taller_nom, taller_dia_turno, taller_hora, taller_sede, fech_crea, fech_modi, fech_elim, estado) VALUES (NULL, ?, '', '', '', now(), NULL, NULL, 1);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$taller_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_taller($taller_id, $taller_nom) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_taller
                set
                    taller_nom=?,
                    fech_modi=now()
                WHERE
                    taller_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$taller_nom);
            $sql->bindValue(2,$taller_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>