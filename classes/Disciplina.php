<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 14:40
 */

class Disciplina extends Conexao
{
    private $idDisciplina;
    private $materia;
    private $carga_horaria;
    private $aulas_nao_presencias;
    private $aulas_presencias;
    private $curso_idCurso;

    /**
     * @return mixed
     */
    public function getCursoIdCurso()
    {
        return $this->curso_idCurso;
    }

    /**
     * @param mixed $curso_idCurso
     */
    public function setCursoIdCurso($curso_idCurso): void
    {
        $this->curso_idCurso = $curso_idCurso;
    }

    public function seleciona($idDisciplina)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina where idDisciplina = ?");
            $resul->bindValue(1, $idDisciplina);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idDisciplina = $resul[0];
                $this->materia = $resul[1];
                $this->carga_horaria = $resul[2];
                $this->aulas_nao_presencias = $resul[3];
                $this->aulas_presencias =$resul[4];

            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaDisciplinasPorMateria($materia) //Disciplina é materia não?
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina where materia like %?%");
            $resul->bindValue(1, $materia);
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

    public function selecionaDisciplinasPorCargaHoraria($carga_horaria)
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from disciplina where carga_horaria = ?");
            $resul->bindValue(1, $carga_horaria);
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

    public function selecionaDisciplinasPorMateriaECargaHoraria($materia, $carga_horaria, $curso){
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select idDisciplina from disciplina where materia = ? and carga_horaria = ? and curso_idcurso = ?");
            $resul->bindValue(1, $materia);
            $resul->bindValue(2, $carga_horaria);
            $resul->bindValue(3, $curso);
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
        try {
            $con = $this->conecta();
            $sql = $con->prepare("insert into disciplina(materia, carga_horaria, curso_idCurso) values (?,?,?)");
            $sql->bindValue(1, $this->materia);
            $sql->bindValue(2, $this->carga_horaria);
            $sql->bindValue(3, $this->curso_idCurso);
            $sql->execute();
            $this->idDisciplina = $con->lastInsertId();


            $con = null;


            /*$con = $this->conecta();
            $sql = $con->prepare("select idDisciplina from disciplina where materia = ? and carga_horaria = ?");
            $sql->bindValue(1, $this->materia);
            $sql->bindValue(2, $this->carga_horaria);
            $sql->execute();
            $con = null;

            $this->idDisciplina = $sql->fetch()['idDisciplina'];
*/
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function atualizar()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("update disciplina set materia = ?, carga_horaria = ? where idDisciplina = ?");
            $resul->bindValue(1, $this->materia);
            $resul->bindValue(2, $this->carga_horaria);
            $resul->bindValue(3, $this->idDisciplina);
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
    public function getIdDisciplina()
    {
        return $this->idDisciplina;
    }

    /**
     * @return mixed
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * @param mixed $materia
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;
    }

    /**
     * @return mixed
     */
    public function getCargaHoraria()
    {
        return $this->carga_horaria;
    }

    /**
     * @param mixed $carga_horaria
     */
    public function setCargaHoraria($carga_horaria)
    {
        $this->carga_horaria = $carga_horaria;
    }

    /**
     * @return mixed
     */
    public function getAulasNaoPresencias()
    {
        return $this->aulas_nao_presencias;
    }

    /**
     * @param mixed $aulas_nao_presencias
     */
    public function setAulasNaoPresencias($aulas_nao_presencias)
    {
        $this->aulas_nao_presencias = $aulas_nao_presencias;
    }

    /**
     * @return mixed
     */
    public function getAulasPresencias()
    {
        return $this->aulas_presencias;
    }

    /**
     * @param mixed $aulas_presencias
     */
    public function setAulasPresencias($aulas_presencias)
    {
        $this->aulas_presencias = $aulas_presencias;
    }


}