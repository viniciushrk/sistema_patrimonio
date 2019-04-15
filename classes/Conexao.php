<?php
/**
 * Created by PhpStorm.
 * User: k4io_
 * Date: 04/10/2018
 * Time: 15:29
 */

class Conexao
{

    private $user = 'root';
    private $senha = '';
    private $db = 'depae';
    private $host = 'localhost';
    private $port = "3306";

    /**
     * @return PDO|string
     */



    public function conecta()
    {
        $this->host = $this->host.":".$this->port;
        try {
            $con = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->senha/*, array(PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)*/);
            $con->query("SET NAMES utf8; SELECT @aes_key_for_passwd:='39IsoQcrzyblPAEZ';");
            return $con;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e->getMessage();

        }
    }
}


