<?php

require_once "./model/RdvModel.php";
class Rdv
{
	

	function index($ref)
	{
		
					
					// session_start();
					// session_destroy();
					// $ref=$_SESSION['reference'];
					$sign=new RdvModel();
                    $sign->ref=$ref;
					$result =$sign->getref();
					// die(print_r($result));
					echo json_encode($result);

				
					// require_once __DIR__.'/../view/Rdv/index.php';
			 
	}

	function select()
	{
		$sign=new RdvModel();
		$result =$sign->getAll();
		echo json_encode($result);

	}

	function selectref()
	{
		$sign=new RdvModel();
		$data = json_decode(file_get_contents("php://input"));
		$sign->ref=$data ->ref;
		$result =$sign->getref();
		echo json_encode($result);

	}

	function save(){

		// On récupère les informations envoyées
		$data = json_decode(file_get_contents("php://input"));

		$rdv=new RdvModel();

		if(!empty($data->date) && !empty($data->horaire) && !empty($data->typeconsultation) && !empty($data->reference))
		{
			$rdv->date=$data->date;
			$rdv->horaire=$data->horaire;
			$rdv->typeconsultation=$data->typeconsultation;
			$rdv->ref=$data->reference;

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
	
	
	function edit()
	{
			// On récupère les informations envoyées
			$data = json_decode(file_get_contents("php://input"));
			
			$rdv=new RdvModel();
	
			if(!empty($data->id))
			{
				$rdv->id=$data->id;
				$value=$rdv->edit();
				
				if($value)
				{
				// Ici la création a fonctionné
				// On envoie un code 201
				http_response_code(201);
				echo json_encode(["message" => "edit a été effectué ".$value]);
				
				}else
				{
					// Ici la création n'a pas fonctionné
					// On envoie un code 503
					http_response_code(503);
					echo json_encode(["message" => "edit n'a pas été effectué".$value]);         
				}
			}else
			{
				// On gère l'erreur
				http_response_code(405);
				echo json_encode(["message" => "La méthode n'est pas autorisée"]);
			}
		
	}

	function update()
	{
			// On récupère les informations envoyées
			$data = json_decode(file_get_contents("php://input"));
			
			$rdv=new RdvModel();
	
			if(!empty($data->date) && !empty($data->horaire) && !empty($data->typeconsultation) && !empty($data->reference) && !empty($data->id))
			{
				
				$rdv->date=$data->date;
			   	$rdv->horaire=$data->horaire;
				$rdv->typeconsultation=$data->typeconsultation;
				$rdv->ref=$data->reference;
				$rdv->id=$data->id;
				$value=$rdv->modifier();
				
				if($value)
				{
				// Ici la création a fonctionné
				// On envoie un code 201
				http_response_code(201);
				echo json_encode(["message" => "modification a été effectué ".$value]);
				
				}else
				{
					// Ici la création n'a pas fonctionné
					// On envoie un code 503
					http_response_code(503);
					echo json_encode(["message" => "la modification n'a pas été effectué".$value]);         
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

		$rdv=new RdvModel();

		if(!empty($data->id))
		{
			$rdv->id=$data->id;
			$value=$rdv->supprimer();
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
			// if(isset($_POST['supprimer'])){
	
			// 	$rdv=new RdvModel();
			// 	$rdv->id=$_POST["id"];
			// 	$rdv->supprimer();
			// 	header("location:http://localhost/brief6-api/rdv/");
	
			// }
		}
	
}
