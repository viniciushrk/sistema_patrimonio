<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:05
 */

require_once "Conexao.php";

class Curso extends Conexao
{
    private $idCurso;
    private $nome_curso;

    public function selecionaPorIdCurso($idCurso)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from curso where idCurso = ?");
            $resul->bindValue(1, $idCurso);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idCurso = $resul[0];
                $this->nome_curso = $resul[1];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaPorNomeCurso($nome_curso)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select idCurso,nome_curso from curso where nome_curso = ?");
            $resul->bindValue(1, $nome_curso);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idCurso = $resul[0];
                $this->nome_curso = $resul[1];
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function _selecionaPorNomeCurso($nome_curso)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select idCurso,nome_curso from curso where nome_curso like CONCAT('PV - ', UPPER( ? ), ' INTEGRADO')");
//            $resul->bindValue(1, "'".$nome_curso."'");

            $resul->execute(array($nome_curso));
            $con = null;
            if ($resul->rowCount() > 0) {
                return $resul->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }



    public function listaCurso()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from curso");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function salvar()
    {
        try {
            $con = $this->conecta();
            $sql = $con->prepare('insert into curso(nome_curso) values (?)');
            $sql->bindValue(1, $this->nome_curso);
            $sql->execute();
            //$sql = $con->prepare('select idCurso from curso where nome_curso = ?');
            //$sql->bindValue(1, $this->nome_curso);
            //$sql->execute();
            $this->idCurso = $con->lastInsertId();//$sql->fetch()['idCurso'];
            $con = null;
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function atualizar()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("update curso set nome_curso = ? where idCurso = ?");
            $resul->bindValue(1, $this->nome_curso);
            $resul->bindValue(3, $this->idCurso);
            $con = null;
            return true;
        } catch
        (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * @return mixed
     */
    public function getNomeCurso()
    {
        return $this->nome_curso;
    }

    /**
     * @param mixed $nome_curso
     */
    public function setNomeCurso($nome_curso)
    {
        $this->nome_curso = $nome_curso;
    }


}