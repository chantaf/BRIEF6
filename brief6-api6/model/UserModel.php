
<?php
require_once "db/connect.php";

class UserModel
{
	
    public $reference;
    public $cin;
    public $nom;
    public $prenom;
    public $age;
    public $tel;
    public $email;
	public $id;
	static private $table="user";

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
		
	    return $this->db->insert(self::$table,["reference","cin","nom","prenom","age","tel","email"], [$this->reference,$this->cin,$this->nom,$this->prenom,$this->age,$this->tel,$this->email]);

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


	function supprimerref()
	{
		$db = new Connection();
		return $this->db->deleteref(self::$table,$this->reference);
	}

    

}








