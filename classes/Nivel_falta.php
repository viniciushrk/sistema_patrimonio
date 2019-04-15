<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:59
 */

class Nivel_falta extends Conexao
{
    private $idNivel_falta;
    private $nivel_falta;
    private $dias_penalidade;

    public function selecionaPorId($idNivel_falta)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from nivel_falta where idNivel_falta = ?");
            $resul->bindValue(1, $idNivel_falta);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idNivel_falta = $resul[0];
                $this->nivel_falta = $resul[1];
                $this->dias_penalidade = $resul[2];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaFaltas()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from nivel_falta ");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaPorNivelFalta($nivel_falta)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from nivel_falta where nivel_falta like %?%");
            $resul->bindValue(1, $nivel_falta);
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



    /**
     * @return mixed
     */
    public function getIdNivelFalta()
    {
        return $this->idNivel_falta;
    }

    /**
     * @return mixed
     */
    public function getNivelFalta()
    {
        return $this->nivel_falta;
    }

    /**
     * @param mixed $nivel_falta
     */
    public function setNivelFalta($nivel_falta)
    {
        $this->nivel_falta = $nivel_falta;
    }

    /**
     * @return mixed 
     */
    public function getDiasPenalidade()
    {
        return $this->dias_penalidade;
    }

}