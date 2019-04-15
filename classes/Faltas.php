<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 16:08
 */

require_once "Conexao.php";

class Faltas extends Conexao
{
    private $idFaltas;
    private $data_inicio;
    private $aluno_num_matricula;
    private $motivo_idMotivo;

    public function seleciona($idFaltas)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where idFaltas = ?");
            $resul->bindValue(1, $idFaltas);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idFaltas = $resul[0];
                $this->data_inicio= $resul[1];
                $this->aluno_num_matricula = $resul[2];
                $this->motivo_idMotivo= $resul[3];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param mixed $aluno_num_matricula
     */
    public function setAlunoNumMatricula($aluno_num_matricula): void
    {
        $this->aluno_num_matricula = $aluno_num_matricula;
    }

    /**
     * @param mixed $motivo_idMotivo
     */
    public function setMotivoIdMotivo($motivo_idMotivo): void
    {
        $this->motivo_idMotivo = $motivo_idMotivo;
    }
    public function listaFaltas()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas order by data_inicio");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaFaltasPorIdAluno($aluno_num_matricula)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where aluno_num_matricula= ?");
            $resul->bindValue(1, $aluno_num_matricula);
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

    public function selecionaFaltasPorDataInicio($data_inicio) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where data_inicio = ?");
            $resul->bindValue(1, $data_inicio);
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

    public function selecionaFaltasDesdeData($data) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where data_inicio > ?");
            $resul->bindValue(1, $data);
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

    public function selecionaFaltasAntesDeData($data) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where data_inicio < ?");
            $resul->bindValue(1, $data);
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

    public function selecionaFaltasDoAno($ano) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where YEAR(data_inicio) = ?");
            $resul->bindValue(1, $ano);
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

    public function selecionaFaltasPorMotivo($motivo_idMotivo) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from faltas where motivo_idMotivo = ?");
            $resul->bindValue(1, $motivo_idMotivo);
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

    public function atualizar()
    {
        if (empty($this->idFaltas)) {
            try {
                $con = $this->conecta();
                $resul = $con->prepare("update faltas set data_inicio = ?, aluno_num_matricula = ?, motivo_idMotivo = ?  where idFaltas = ?");
                $resul->bindValue(1, $this->data_inicio);
                $resul->bindValue(2, $this->aluno_num_matricula);
                $resul->bindValue(3, $this->motivo_idMotivo);
                $resul->bindValue(4, $this->idFaltas);
                $resul->execute();
                $con = null;
                return true;
            } catch
            (PDOException $e) {
                return $e->getMessage();
            }
        }else{
            $this->salvar();
        }
    }

    public function salvar()
    {
        try {
            $con = $this->conecta();
            $sql = $con->prepare('insert into faltas (data_inicio, aluno_num_matricula, motivo_idMotivo) values (?, ?, ?)');
            $sql->bindValue(1, $this->data_inicio);
            $sql->bindValue(2, $this->aluno_num_matricula);
            $sql->bindValue(3, $this->motivo_idMotivo);
            $sql->execute();
            $this->idFaltas = $con->lastInsertId();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getidFaltas()
    {
        return $this->idFaltas;
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->data_inicio;
    }

    /**
     * @return mixed
     */
    public function getAlunoNumMatricula()
    {
        return $this->aluno_num_matricula;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getCadastroFaltasIdCadastroFaltas()
    {
        return $this->motivo_idMotivo;
    }





    /**
     * @param mixed $data_inicio
     */
    public function setDataInicio($data_inicio)
    {
        $this->data_inicio = $data_inicio;
    }


}