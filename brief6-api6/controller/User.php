<?php

require_once "./model/UserModel.php";
class User
{

    function index()
    {
        
           
					session_start();
					// session_destroy();
					$ref=$_SESSION['reference'];
					$sign=new UserModel();
                    $sign->ref=$ref;
					$result =$sign->getref();
					echo json_encode($result);

           // UserModel::getAll();
            //require_once __DIR__.'/../view/user/index.php';
       
     }

    function select()
	{
		$sign=new UserModel();
		$result =$sign->getAll();
		echo json_encode($result);

	}

	function selectref()
	{
		$sign=new UserModel();
		$data = json_decode(file_get_contents("php://input"));
		$sign->ref=$data ->ref;
		$result =$sign->getref();
		echo json_encode($result);

	}



    function save(){

		// On récupère les informations envoyées
		$data = json_decode(file_get_contents("php://input"));

		$rdv=new UserModel();

		if(!empty($data->reference) && !empty($data->cin) && !empty($data->nom) && !empty($data->prenom) && !empty($data->age) && !empty($data->tel) && !empty($data->email))
		{
			$rdv->reference=$data->reference;
			$rdv->cin=$data->cin;
			$rdv->nom=$data->nom;
            $rdv->prenom=$data->prenom;
			$rdv->age=$data->age;
            $rdv->tel=$data->tel;
            $rdv->email=$data->email;

			$value=$rdv->save();
			if($value)
			{
			// Ici la création a fonctionné
			// On envoie un code 201
			http_response_code(201);
			echo json_encode(["message" => "L'ajout a été effectué".$value]);
			}else
			{
				// Ici la création n'a pas fonctionné
				// On envoie un code 503
				http_response_code(503);
				echo json_encode(["message" => "L'ajout n'a pas été effectué".$value]);         
			}
		}else
		{
			// On gère l'erreur
			http_response_code(405);
			echo json_encode(["message" => "La méthode n'est pas autorisée"]);
		}
	}
	

    function delete()
		{

			// On récupère les informations envoyées
		$data = json_decode(file_get_contents("php://input"));

		$rdv=new UserModel();

		if(!empty($data->reference))
		{
			$rdv->reference=$data->reference;
			$value=$rdv->supprimerref();
			if($value)
			{
			// Ici la création a fonctionné
			// On envoie un code 201
			http_response_code(201);
			echo json_encode(["message" => "supprision  a été effectué".$value]);

			}else
			{
				// Ici la création n'a pas fonctionné
				// On envoie un code 503
				http_response_code(503);
				echo json_encode(["message" => "la supprision n'a pas été effectué".$value]);         
			}
		}else
		{
			// On gère l'erreur
			http_response_code(405);
			echo json_encode(["message" => "La méthode n'est pas autorisée"]);
		}
			
		}


}