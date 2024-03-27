<?php

namespace src\Models;

final class Database {
    private $db;
    private $config;
    public function __construct() {
        $this->config = __DIR__ . '/../../config.php';
        require_once $this->config;
        $this->connect();
    }

    public function connect() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->db = new \PDO($dsn, DB_USER, DB_PWD);
        } catch (\PDOException $error) {
            echo "Erreur de connexion à la Base de Données : " . $error->getMessage();
            die();
        }
    }

    public function init(){
        if($this->doesUserTableExists()){
            $this->updateConfig();
            return "Database already exists.";
        }
        try {
            $sql = file_get_contents(__DIR__ . "/../Migrations/Vercors-database.sql");
            $this->db->query($sql);
            if ($this->updateConfig()){
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $error) {
            return $error->getMessage();
        }
    }

    public function updateConfig(){
        $configFile = fopen($this->config, "w");
        $content = "<?php

        define('DB_HOST', 'localhost');
        define('DB_NAME', 'vercors');
        define('DB_USER', 'vercors');
        define('DB_PWD', 'vercors');
        define('PREFIXE', 'vercors_');
        
        define('HOME_URL', '/');
        
        define('DB_INITIALIZED', TRUE);";
    
        if (fwrite($configFile, $content)) {
            fclose($configFile);
            return true;
        } else {
            return false;
        }
    }

    public function doesUserTableExists(){
        $sql = "SHOW TABLES LIKE '" . PREFIXE ."utilisateurs'";
        $return = $this->db->query($sql)->fetch();
        if ($return && $return[0] == PREFIXE."utilisateurs") {
            return true;
        } else {
            return false;
        }
    }

}