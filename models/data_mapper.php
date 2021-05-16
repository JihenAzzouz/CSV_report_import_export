<?php

require ("src/config/config.php");
class DataMapper {
	private $login;
	private $pass;
	private $conf;
	private $connec;
	private $config ;
    private $dsn;
   
	
    public function __construct(){
    	if($this->config=database_cfg()){
            
		    $this->login = $config['db_user'];
		    $this->pass = $config['db_password'];
		    $this->conf =$config['db_options'];
		    $this->dsn="mysql:host=".$config['db_host'].";dbname=".$config['db_name']."";
		    $this->connexion();
	    }
	}
	private function connexion(){
		try
		{
			
	      
             $bdd = new PDO(
                             $this->dsn, 
                             $this->login, 
                             $this->pass
                 );
			$this->connec = $bdd;
		}
		catch (PDOException $e)
		{
			echo"hello2";
			$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			die($msg);
		}
	}
	public function prepareStmt($sql){
       return $this->connec->prepare($sql);
	}


    public function excute($stmt)
    {       
	    return $stmt->execute();
    }

	
    static function closeConnection(&$conn) {
        $conn=null;
    }


}

?>