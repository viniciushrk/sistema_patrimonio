<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:31
 */

class Turno extends Conexao
{
    private $idTurno;
    private $turno;

    public function seleciona($idTurno) //by PK
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from turno where idTurno = ?");
            $resul->bindValue(1, $idTurno);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idTurno = $resul[0];
                $this->turno = $resul[1];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function selecionaTurnosPorTurno($turno) //partial string or not
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from turno where turno = ?");
            $resul->bindValue(1, $turno);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                return $resul->fetchall();
                
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaTurnos()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from turno");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getIdTurno()
    {
        return $this->idTurno;
    }

    /**
     * @return mixed
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * @param mixed $turno
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;
    }


}