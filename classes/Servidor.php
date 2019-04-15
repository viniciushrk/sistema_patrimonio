<?php
/**
 * Created by PhpStorm.
 * User: viniciushrk
 * Date: 05/10/2018
 * Time: 14:53
 */
require_once "Conexao.php";
require_once "php-mysql-aes-crypt-master/src/Crypter.php";
class Servidor extends Conexao
{

    private $idServidor;
    private $siape;
    private $login_email;
    private $nome;
    private $senha;
    private $cargo_idCargo;
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCargoIdCargo()
    {
        return $this->cargo_idCargo;
    }

    /**
     * @param mixed $cargo_idcargo
     */
    public function setCargoIdCargo($cargo_idCargo)
    {
        $this->cargo_idCargo = $cargo_idCargo;
    }

    public function selecionaPorIdServidor($idServidor)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where idServidor = ?");
            $resul->bindValue(1, $idServidor);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
                $this->status = $resul[6];

            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

//    public function selecionaServidoresPorNome($nome)
//    {
//        try {
//            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
//            $con = $this->conecta();
//            $resul = $con->prepare("select idServidor, siape, login_email, nome, cast(senha as binary), cargo_idcargo, status from servidor where nome like %?%");
//            $resul->bindValue(1, $nome);
//            $resul->execute();
//            $con = null;
//            if ($resul->rowCount() > 0) {
//                return $resul->fetchall();
//            } else {
//                return 0;
//            }
//        } catch (PDOException $e) {
//            return $e->getMessage();
//        }
//    }

    public function selecionaSiape($siape)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where siape = ?");
            $resul->bindValue(1, $siape);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaLoginEmail($login_email)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where login_servidor = ?");
            $resul->bindValue(1, $login_email);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaPorCargo($cargo_idCargo)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where cargo_idCargo = ?");
            $resul->bindValue(1, $cargo_idCargo);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function selecionaPorLoginEmail($login_email)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where login_email = ?");
            $resul->bindValue(1, $login_email);
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function autenticarLogin($email, $senha)
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("select idServidor, siape, login_email, nome, senha, cargo_idcargo, status from servidor where login_email = ? and senha = ? and status = 'A'");
            $resul->bindValue(1, $email);
            $resul->bindValue(2, $obj->encrypt($senha));
            $resul->execute();
            $con = null;
            if ($resul->rowCount() > 0) {
                $resul = $resul->fetch();
                $this->idServidor = $resul[0];
                $this->siape = $resul[1];
                $this->login_email = $resul[2];
                $this->nome = $resul[3];
                $this->senha = $obj->decrypt($resul[4]);
                $this->cargo_idCargo = $resul[5];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaServidores()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from servidor");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaServidoresAtivados()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from servidor where status like 'A'");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listaServidoresDesativados()
    {
        try {
            $con = $this->conecta();
            $resul = $con->prepare("select * from servidor where status like 'D'");
            $resul->execute();
            $con = null;
            return $resul->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function atualizar()
    {
        try {
            $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
            $con = $this->conecta();
            $resul = $con->prepare("update servidor set siape= ?, login_email= ?, nome= ?, senha= ?, cargo_idCargo = ?, status = ? where idServidor = ?");
          $resul->bindValue(1, $this->siape);
         $resul->bindValue(2, $this->login_email);
            $resul->bindValue(3, $this->nome);
        $resul->bindValue(4,$obj->encrypt($this->senha));
            $resul->bindValue(5, $this->getCargoIdcargo());
            $resul->bindValue(6, $this->getStatus());
            $resul->bindValue(7, $this->getIdServidor());
       $resul->execute();
          $con = null;
           return true;
       } catch
       (PDOException $e) {
           return $e->getMessage();
       }
   }

    public function salvar()
    {
        if (empty($this->idServidor)) {
            try {
                $obj = new \NoProtocol\Encryption\MySQL\AES\Crypter("39IsoQcrzyblPAEZ");
                $con = $this->conecta();
                $resul = $con->prepare("insert into servidor(nome, siape, login_email, senha, cargo_idCargo, status) values(?,?,?,?,?,?)");
                $resul->bindValue(1, $this->getNome());
                $resul->bindValue(2, $this->getSiape());
                $resul->bindValue(3, $this->getLoginEmail());
                $resul->bindValue(4, $obj->encrypt($this->getSenha()));
                $resul->bindValue(5, $this->getCargoIdCargo());
                $resul->bindValue(6, $this->getStatus());
                $resul->execute();
                $con = null;
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }else{
            $this->atualizar();
        }
    }

//    public function excluir()
//    {
//        if (!empty($this->idServidor)) {
//            try {
//                $con = $this->conecta();
//                $resul = $con->prepare("delete servidor where idServidor = ?");
//                $resul->bindValue(1, $this->idServidor);
//                $resul->execute();
//                $con = null;
//                return true;
//            } catch
//            (PDOException $e) {
//                return $e->getMessage();
//            }
//        }else{
//            $this->setSiape(null);
//            $this->setLoginEmail(null);
//            $this->setNome(null);
//            $this->setSenha(null);
//            $this->cargo_idCargo = null;
//        }
//    }


    /**
     * @return mixed
     */
    public function getIdServidor()
    {
        return $this->idServidor;
    }

    /**
     * @return mixed
     */
    public function getSiape()
    {
        return $this->siape;
    }

    /**
     * @param mixed $siape
     */
    public function setSiape($siape)
    {
        $this->siape = $siape;
    }

    /**
     * @return mixed
     */
    public function getLoginEmail()
    {
        return $this->login_email;
    }

    /**
     * @param mixed $login_email
     */
    public function setLoginEmail($login_email)
    {
        $this->login_email = $login_email;
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
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

}