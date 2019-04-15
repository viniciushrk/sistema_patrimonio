<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 16:01
 */

class Motivo extends Conexao
{
    private $idMotivo;
    private $nome;
    private $servidor_idServidor;
    private $nivel_falta_idNivel_falta;

    public function seleciona($idMotivo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo where idMotivo = ?");
            $resul->bindValue(1, $idMotivo);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idMotivo = $resul[0];
                $this->nome = $resul[1];
                $this->servidor_idServidor= $resul[2];
                $this->nivel_falta_idNivel_falta= $resul[3];
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
    public function getIdMotivo()
    {
        return $this->idMotivo;
    }

    public function selecionaMotivoPorNome_e_NivelFalta($nome, $nivel_falta_idNivel_falta)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo where nivel_falta_idNivel_falta = ? and nome like %?%");
            $resul->bindValue(1, $nivel_falta_idNivel_falta);
            $resul->bindValue(2, $nome);
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

    public function selecionaMotivoPorNivelFalta($nivel_falta_idNivel_falta)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo where nivel_falta_idNivel_falta = ?");
            $resul->bindValue(1, $nivel_falta_idNivel_falta);
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

    public function selecionaMotivoPorNome($nome)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo where nome like %?%");
            $resul->bindValue(1, $nome);
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

    public function selecionaMotivoPorServidorQueCadastrou($servidor_idServidor)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo where servidor_idServidor = ?");
            $resul->bindValue(1, $servidor_idServidor);
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

    public function salvar()
    {
        if (empty($this->idMotivo)) {
            try {
                $con = $this->conecta();
                $sql = $con->prepare('insert into motivo(nome, servidor_idServidor, nivel_falta_idNivel_falta) values (?,?,?)');
                $sql->bindValue(1, $this->nome);
                $sql->bindValue(2, $this->servidor_idServidor);
                $sql->bindValue(3, $this->nivel_falta_idNivel_falta);
                $sql->execute();
                $this->idMotivo = $con->lastInsertId();
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }else{
            $this->atualizar();
        }
    }

    public function atualizar()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("update motivo set nome = ?, idsevidor = ?, idNivel_falta = ? where idMotivo = ?");
            $resul->bindValue(1, $this->nome);
            $resul->bindValue(2, $this->servidor_idServidor);
            $resul->bindValue(3, $this->nivel_falta_idNivel_falta);
            $resul->bindValue(4, $this->idMotivo);
            $resul->execute();
            $con = null;
            return true;
        } catch
        (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function excluir()
    {
        if (!empty($this->idMotivo)) {
            try {
                $con = $this->conecta();
                $resul = $con->prepare("delete motivo where idMotivo = ?");
                $resul->bindValue(1, $this->idMotivo);
                $resul->execute();
                $con = null;
                return true;
            } catch
            (PDOException $e) {
                return $e->getMessage();
            }
        }else{
            $this->setNome(null);
            $this->setDiasPenalidade(null);
            $this->servidor_idServidor = null;
            $this->nivel_falta_idNivel_falta = null;
        }
    }

    public function listaMotivo()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from motivo");
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
    public function getIdcadastroFalta()
    {
        return $this->idMotivo;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDiasPenalidade()
    {
        return $this->dias_penalidade;
    }

    /**
     * @param mixed $dias_penalidade
     */
    public function setDiasPenalidade($dias_penalidade)
    {
        $this->dias_penalidade = $dias_penalidade;
    }

    /**
     * @return mixed
     */
    public function getServidoridServidor()
    {
        return $this->servidor_idServidor;
    }

    /**
     * @return mixed
     */
    public function getNivelfaltaIdNivelFalta()
    {
        return $this->nivel_falta_idNivel_falta;
    }
}