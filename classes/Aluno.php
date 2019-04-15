<?php
/**
 * Created by PhpStorm.
 * User: nodo09
 * Date: 05/10/18
 * Time: 14:24
 */

require_once "Conexao.php";

class Aluno extends Conexao
{
    private $num_matricula;
    private $nome;
    private $rg;
    private $cpf;
    private $orgexp;
    private $data_nascimento;
    private $telefone;
    private $email;

    public function seleciona($num_matricula)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from aluno where num_matricula= ?");
            $resul->bindValue(1, $num_matricula);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->num_matricula = $resul[0];
                $this->nome = $resul[1];
                $this->rg = $resul[2];
                $this->cpf = $resul[3];
                $this->orgexp = $resul[4];
                $this->data_nascimento = $resul[5];
                $this->telefone = $resul[6];
                $this->email = $resul[7];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaAlunosPorNome($nome)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from aluno where nome like %?%");
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

    public function selecionaAlunoPorCPF($cpf)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from aluno where cpf = ?");
            $resul->bindValue(1, $cpf);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idAluno = $resul[0];
                $this->num_matricula = $resul[1];
                $this->nome = $resul[2];
                $this->rg = $resul[3];
                $this->cpf = $resul[4];
                $this->orgexp = $resul[5];
                $this->data_nascimento = $resul[6];
                $this->telefone = $resul[7];
                $this->email = $resul[8];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaAlunoPorEmail($email)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from aluno where email = ?");
            $resul->bindValue(1, $email);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idAluno = $resul[0];
                $this->num_matricula = $resul[1];
                $this->nome = $resul[2];
                $this->rg = $resul[3];
                $this->cpf = $resul[4];
                $this->orgexp= $resul[5];
                $this->data_nascimento = $resul[6];
                $this->telefone = $resul[7];
                $this->email = $resul[8];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaAluno()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from aluno");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaAlunosDaTurma($idTurma)
    {
        try{
            $alunos = array();
            $con = $this->conecta();
            $resul = $con->prepare("select distinct aluno_num_matricula from disciplina_aluno where turma_idTurma = ?");
            $resul->bindValue(1, $idTurma);
            $resul->execute();
            $con = null;
            $numsMatricula = $resul->fetchAll();
            foreach ($numsMatricula as $num_matricula) {
                $con = $this->conecta();
                $resul = $con->prepare("select * from aluno where num_matricula = ?");
                $resul->bindValue(1, $num_matricula['aluno_num_matricula']);
                $resul->execute();
                $con = null;
                $alunos[] = $resul->fetch();
            }
            return $alunos;
        }catch(PDOException $e) {
            return $e->getMessage();
        }


    }

    public function salvar()
    {
        try {
            $con = $this->conecta();
            $sql = $con->prepare('insert into aluno(num_matricula,nome,rg,cpf,orgexp,data_nascimento) values (?,?,?,?,?,?)');
            $sql->bindValue(1, $this->num_matricula);
            $sql->bindValue(2, $this->nome);
            $sql->bindValue(3, $this->rg);
            $sql->bindValue(4, $this->cpf);
            $sql->bindValue(5, $this->orgexp);
            $sql->bindValue(6, $this->data_nascimento);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function atualizar()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("update aluno set num_matricula = ?,nome = ?,rg = ?,cpf = ?,orgexp = ?,data_nascimento = ?,telefone = ?,email = ? where num_matricula = ?");
            $resul->bindValue(1, $this->num_matricula);
            $resul->bindValue(2, $this->nome);
            $resul->bindValue(3, $this->rg);
            $resul->bindValue(4, $this->cpf);
            $resul->bindValue(5, $this->orgexp);
            $resul->bindValue(6, $this->data_nascimento);
            $resul->bindValue(7, $this->telefone);
            $resul->bindValue(8, $this->email);
            $con = null;
            return true;
        } catch
        (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getOrgexp()
    {
        return $this->orgexp;
    }

    /**
     * @param mixed $orgexp
     */
    public function setOrgexp($orgexp): void
    {
        $this->orgexp = $orgexp;
    }
    /**
     * @param mixed $idAluno
     */
    public function getNumMatricula()
    {
        return $this->num_matricula;
    }

    /**
     * @param mixed $num_matricula
     */
    public function setNumMatricula($num_matricula)
    {
        $this->num_matricula = $num_matricula;
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
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @param mixed $data_nascimento
     */
    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}