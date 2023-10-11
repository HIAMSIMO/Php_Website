<?php
class Database {
    private static $db;
    private $connection;
    private $host = "sql109.infinityfree.com";
    private $user = "if0_35118874";
    private $password = " hH3eSAudFEZ ";
    private $dbname = "if0_35118874_market_tech";

    private $options    = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    private function __construct() {
        $dsn        = "mysql:host=".$this->host.";dbname=".$this->dbname;
        $this->connection = new PDO($dsn, $this->user, $this->password, $this->options);
    }

    function __destruct(){
       $this->connection = null; 
    }

    public  static function getConnection(){
        if(self::$db == null) {
            self::$db = new Database();
        }

        return self::$db->connection;
    }

    // public function displayproducts($reference)
    //     {
    //         $sql = "SELECT reference,ID_cat,brand,model,minor_detail,specification,description,price,photo FROM product,categorie WHERE ID_cat = ID_cat AND reference = '$reference'";
            
    //         $result=$sth->fetchAll();
    //         return $result;
    //     }
}
?>