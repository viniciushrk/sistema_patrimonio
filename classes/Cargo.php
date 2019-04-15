<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:56
 */

class Cargo extends Conexao
{
    private $idcargo;
    private $cargo;

    public function __construct()
    {
    }


    public function seleciona($idcargo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from cargo where idCargo = ?");
            $resul->bindValue(1, $idcargo);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idcargo = $resul[0];
                $this->cargo = $resul[1];

            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function selecionaCargoporCargo($cargo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from cargo where cargo like %?%");
            $resul->bindValue(1, $cargo);
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

    public function listaCargos()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from cargo");
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

    public function getIdcargo()
    {
        return $this->idcargo;
    }

    /**
     * @return mixed
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param mixed $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }


}