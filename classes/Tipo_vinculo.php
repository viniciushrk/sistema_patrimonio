<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:59
 */
require_once "Conexao.php";

class Tipo_vinculo extends Conexao
{
    private $idTipo_vinculo;
    private $tipo_vinculo;

    public function selecionaPorIdTipoVinculo($idTipo_vinculo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from tipo_vinculo where idTipo_vinculo = ?");
            $resul->bindValue(1, $idTipo_vinculo);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idTipo_vinculo = $idTipo_vinculo;
                $this->tipo_vinculo = $resul[0];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    public function selecionaPorTipoVinculo($tipo_vinculo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from tipo_vinculo where tipo_vinculo = ?");
            $resul->bindValue(1, $tipo_vinculo);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idTipo_vinculo = $resul[0];
                $this->tipo_vinculo = $tipo_vinculo;
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
    public function getIdTipoVinculo()
    {
        return $this->idTipo_vinculo;
    }



    /**
     * @param mixed $idTipo_vinculo
     */
    public function setIdTipoVinculo($idTipo_vinculo): void
    {
        $this->idTipo_vinculo = $idTipo_vinculo;
    }

    /**
     * @param mixed $tipo_vinculo
     */
    public function setTipoVinculo($tipo_vinculo)
    {
        $this->tipo_vinculo = $tipo_vinculo;
    }

}