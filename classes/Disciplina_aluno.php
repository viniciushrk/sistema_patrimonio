<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 18/10/2018
 * Time: 14:53
 */

class disciplina_aluno extends Conexao
{
    private $disciplina_idDisciplina;
    private $aluno_num_matricula;
    private $tipo_vinculo_idTipo_Vinculo;
    private $faltas_justificadas;
    private $numero_faltas;
    private $percetual_faltas;
    private $frequencia;
    private $turma_idTurma;

    public function selecionaIdDisciplina($disciplina_idDisciplina)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where  disciplina_idDisciplina = ?");
            $resul->bindValue(1, $disciplina_idDisciplina);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->disciplina_idDisciplina = $resul[0];
                $this->aluno_num_matricula = $resul[1];
                $this->tipo_vinculo_idTipo_Vinculo = $resul[2];
                $this->faltas_justificadas = $resul[3];
                $this->numero_faltas = $resul[4];
                $this->percetual_faltas = $resul[5];
                $this->frequencia = $resul[6];
                $this->turma_idTurma= $resul[7];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function selecionaDisciplinaAlunosPorIdAluno($aluno_num_matricula)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where aluno_num_matricula= ?");
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

    public function selecionaDisciplinaAlunosPorIdDisciplina($disciplina_iddisciplina)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where disciplina_iddisciplina = ?");
            $resul->bindValue(1, $disciplina_iddisciplina);
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

    public function selecionaDisciplinaAlunosPorIdTipoVinculo($tipo_vinculo_idtipo_Vinculo)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where tipo_vinculo_idtipo_vinculo = ?");
            $resul->bindValue(1, $tipo_vinculo_idtipo_Vinculo);
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

    public function selecionaDisciplinaAlunosPorPercentualFaltas($percentual_faltas)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where percentual_faltas = ?");
            $resul->bindValue(1, $percentual_faltas);
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


    public function selecionaDisciplinaAlunosPorPercentualFaltasMaiorQue($percentual_faltas)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where percentual_faltas < ?");
            $resul->bindValue(1, $percentual_faltas);
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

    public function selecionaDisciplinaAlunosPorPercentualFaltasMenorQue($percentual_faltas)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina_aluno where percentual_faltas > ?");
            $resul->bindValue(1, $percentual_faltas);
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

    public function verificaSeNaoExiste() {
        try {
            $con = $this->conecta();
            $sql = $con->prepare('select faltas_justificadas from disciplina_aluno where disciplina_idDisciplina = ? and tipo_vinculo_idTipo_vinculo = ? and aluno_num_matricula = ? and turma_idTurma = ?');
            $sql->bindValue(1, $this->disciplina_idDisciplina);
            $sql->bindValue(2, $this->tipo_vinculo_idTipo_Vinculo);
            $sql->bindValue(3, $this->aluno_num_matricula);
            $sql->bindValue(4, $this->turma_idTurma);
            $sql->execute();
            $con = null;
            if ($sql->rowCount() > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function salvar()
    {
        try {
            $con = $this->conecta();
            $sql = $con->prepare('insert into disciplina_aluno(disciplina_idDisciplina, tipo_vinculo_idTipo_vinculo, aluno_num_matricula, turma_idTurma) values (?,?,?,?)');
            $sql->bindValue(1, $this->disciplina_idDisciplina);
            $sql->bindValue(2, $this->tipo_vinculo_idTipo_Vinculo);
            $sql->bindValue(3, $this->aluno_num_matricula);
            $sql->bindValue(4, $this->turma_idTurma);
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
            $resul = $con->prepare("update disciplina_aluno set disciplina_idDisciplina = ?, tipo_vinculo_idTipo_vinculo = ?, aluno_num_matricula = ? where  turma_idTurma = ? ");
            $resul->bindValue(1, $this->disciplina_idDisciplina);
            $resul->bindValue(2, $this->tipo_vinculo_idTipo_Vinculo);
            $resul->bindValue(3, $this->aluno_num_matricula);
            $resul->bindValue(4, $this->turma_idTurma);
            $resul->execute();
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
    public function getDisciplinaIdDisciplina()
    {
        return $this->disciplina_idDisciplina;
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
    public function getPercetualFaltas()
    {
        return $this->percetual_faltas;
    }

    /**
     * @param mixed $disciplina_idDisciplina
     */
    public function setDisciplinaIdDisciplina($disciplina_idDisciplina): void
    {
        $this->disciplina_idDisciplina = $disciplina_idDisciplina;
    }

    /**
     * @param mixed $aluno_num_matricula
     */
    public function setAlunoNumMatricula($aluno_num_matricula): void
    {
        $this->aluno_num_matricula = $aluno_num_matricula;
    }

    /**
     * @param mixed $tipo_vinculo_idTipo_Vinculo
     */
    public function setTipoVinculoIdTipoVinculo($tipo_vinculo_idTipo_Vinculo): void
    {
        $this->tipo_vinculo_idTipo_Vinculo = $tipo_vinculo_idTipo_Vinculo;
    }

    /**
     * @param mixed $percetual_faltas
     */
    public function setPercetualFaltas($percetual_faltas): void
    {
        $this->percetual_faltas = $percetual_faltas;
    }

    /**
     * @return mixed
     */


    /**
     * @return mixed
     */
    public function getTipoVinculoIdTipoVinculo()
    {
        return $this->tipo_vinculo_idTipo_Vinculo;
    }

    /**
     * @return mixed
     */
    public function getFaltasJustificadas()
    {
        return $this->faltas_justificadas;
    }

    /**
     * @return mixed
     */
    public function getNumeroFaltas()
    {
        return $this->numero_faltas;
    }

    /**
     * @return mixed
     */
    public function getPercentualFaltas()
    {
        return $this->percentual_faltas;
    }

    /**
     * @return mixed
     */
    public function getFrequencia()
    {
        return $this->frequencia;
    }

    /**
     * @param mixed $faltas_justificadas
     */
    public function setFaltasJustificadas($faltas_justificadas)
    {
        $this->faltas_justificadas = $faltas_justificadas;
    }

    /**
     * @param mixed $numero_faltas
     */
    public function setNumeroFaltas($numero_faltas)
    {
        $this->numero_faltas = $numero_faltas;
    }

    /**
     * @param mixed $percetual_faltas
     */
    public function setPercentualFaltas($percentual_faltas)
    {
        $this->percetual_faltas = $percentual_faltas;
    }

    /**
     * @param mixed $frequencia
     */
    public function setFrequencia($frequencia)
    {
        $this->frequencia = $frequencia;
    }

    /**
     * @return mixed
     */
    public function getTurmaIdTurma()
    {
        return $this->turma_idTurma;
    }

    /**
     * @param mixed $turma_idTurma
     */
    public function setTurmaIdTurma($turma_idTurma): void
    {
        $this->turma_idTurma = $turma_idTurma;
    }
}