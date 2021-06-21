<?php
require_once "db/connect.php";

    
    class RdvModel{

        public $ref;
        public $id;
        public $date;
        public $horaire;
        public $typeconsultation;
    
        static private $table="rdv"; 

        function __construct()
        {
            $this->db = new Connection();
        }


    /**
	 * getAll
	 * 
	 **/
	static function getAll()
	{
		$db = new Connection();
		return $db->select(self::$table);
	}

    function save()
	{
	
        return $this->db->insert(self::$table,[ "date", "horaire", "typeconsultation", "reference"], [$this->date,$this->horaire,$this->typeconsultation,$this->ref]);

	}


     function getref()
	{
        
		$db = new Connection();
		return $this->db->selectref(self::$table,$this->ref);
	} 


     function supprimer()
	{
		$db = new Connection();
		return $this->db->delete(self::$table,$this->id);
	}

    function modifier(){
        
        return $this->db->update(self::$table,["date", "horaire", "typeconsultation", "reference"],[$this->date,$this->horaire,$this->typeconsultation,$this->ref],$this->id);
    }

    function edit(){
         
        return $this->db->edit(self::$table,$this->id);
    }


        // select
        // function getAll($ref){
            
        //     $query ="SELECT * FROM `rdv` where referenceuser='$ref'";
        //     $Nobjet = new connection();
        //     $con=$Nobjet->connect();
        //     $result= $con->query($query);
        //     return $result->fetchAll(PDO::FETCH_ASSOC);
        // }
  
      


        // //delete
        // function Delete($id){

        //     $query= "DELETE FROM `rdv` WHERE id=$id";
        //     $Nobjet = new connection();
        //     $con=$Nobjet->connect();
        //     $con->query($query);

        // }

        // //edit
    

        // //update
        // function update(){

        // }

        // //insert
        // function insert(){

           
        // }

    }
