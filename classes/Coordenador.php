<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 15:53
 */

class Coordenador extends Conexao
{
    private $idCoordenador = "";
    private $servidor_idServidor = "";
    private $curso_idCurso = "";

    /**
     * @return mixed
     */
    public function seleciona($idCoordenador)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from coordenador where idCoordenador = ?");
            $resul->bindValue(1, $idCoordenador);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idcoordenador = $resul[0];
                $this->servidor_idServidor = $resul[1];
                $this->curso_idCurso= $resul[2];
            } else {
                $this->idCoordenador = "";
                $this->servidor_idServidor = "";
                $this->curso_idCurso = "";
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaPorServidor($idServidor) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from coordenador where servidor_idServidor = ?");
            $resul->bindValue(1, $idServidor);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
               return $resul->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function _selecionaPorServidor($idServidor) {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from coordenador where servidor_idServidor = ?");
            $resul->bindValue(1, $idServidor);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetchAll();
                $resul = $resul[0];
                $this->idcoordenador = $resul[0];
                $this->servidor_idServidor = $resul[1];
                $this->curso_idCurso= $resul[2];
            } else {
                $this->idCoordenador = "";
                $this->servidor_idServidor = "";
                $this->curso_idCurso = "";
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function excluir() {
        try {
            $con = $this->conecta();
            if ($this->idCoordenador === "")
                return false;
            $resul = $con->prepare("delete from coordenador where idCoordenador = ?");
            $resul->bindValue(1, $this->idCoordenador);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $this->idCoordenador = "";
                $this->servidor_idServidor = "";
                $this->curso_idCurso = "";
                return true;
            } else {
                $this->idCoordenador = "";
                $this->servidor_idServidor = "";
                $this->curso_idCurso = "";
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function salvar()
    {
        ini_set('memory_limit', '256M');

        if ($this->idCoordenador !== ""){
            return $this->atualizar();
        }
        $tmp = $this->selecionaPorServidor($this->servidor_idServidor);


        if (is_array($tmp)){
            $tmp2 = array();
            foreach ($tmp as $_tmp) {
                if ($this->idCoordenador === $_tmp['idCoordenador'] and $this->curso_idCurso === $_tmp['curso_idCurso']) {
                    $tmp2[count($tmp2)] = $_tmp;
                }
            }

            $tmp = $tmp2;

            for ($c = 1; $c < count($tmp); $tmp++) {
                $coord = new Coordenador();
                $coord->seleciona($tmp[$c]['idCoordenador']);
                $coord->excluir();
            }

            ini_restore('memory_limit');
            return true;
        }

        try {
            $con = $this->conecta();
            $sql = $con->prepare('insert into coordenador(servidor_idServidor, curso_idCurso) values (?, ?)');
            $sql->bindValue(1, $this->servidor_idServidor);
            $sql->bindValue(2, $this->curso_idCurso);
            $sql->execute();
            $this->id = $con->lastInsertId();
            ini_restore('memory_limit');
            return true;
        } catch (PDOException $e) {
            ini_restore('memory_limit');
            return $e->getMessage();
        }
    }

    public function atualizar()
    {
        ini_set('memory_limit', '256M');
        if ($this->idCoordenador === "") {
            return $this->salvar();
        }

        try {
            $con = $this->conecta();
            $sql = $con->prepare('update coordenador set curso_idCurso = ? where idCoordenador = ?');
            $sql->bindValue(1, $this->curso_idCurso);
            $sql->execute();
            ini_restore('memory_limit');
            return true;
        } catch (PDOException $e) {
            ini_restore('memory_limit');
            return $e->getMessage();
        }
    }



    public function getIdcoordenador()
    {
        return $this->idcoordenador;
    }

    /**
     * @return mixed
     */
    public function getServidorIdServidor()
    {
        return $this->servidor_idServidor;
    }

    /**
     * @return mixed
     */
    public function getCursoIdCurso()
    {
        return $this->curso_idCurso;
    }

    /**
     * @param mixed $idCoordenador
     */
    public function setIdCoordenador($idCoordenador)
    {
        $this->idCoordenador = $idCoordenador;
    }

    /**
     * @param mixed $servidor_idServidor
     */
    public function setServidorIdServidor($servidor_idServidor)
    {
        $this->servidor_idServidor = $servidor_idServidor;
    }

    /**
     * @param mixed $curso_idCurso
     */
    public function setCursoIdCurso($curso_idCurso)
    {
        $this->curso_idCurso = $curso_idCurso;
    }


    
}