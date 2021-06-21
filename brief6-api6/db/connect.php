<?php

class Connection {
   public $servername = 'localhost';
   public $username = 'root';
   public $dbname = 'gestionrdv';
   public $password = '';
   public $sql;


   function __construct()
   {
      try {
         $this->sql = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            
         } catch(PDOException $e) {
            echo "connection failde: " . $e->getMessage();
         }
   } 

//    --------------------------------------select

   function select($table)
   {
      $qry="select * from ".$table;
      return $this->sql->query($qry)->fetchAll(PDO::FETCH_ASSOC);
   }
//    --------------------------------------select ref
   function selectref($table,$ref)
   {
      $qry="select * from ".$table ." where reference='".$ref."'";
      return $this->sql->query($qry)->fetchAll(PDO::FETCH_ASSOC);
   }

//    --------------------------------------delete

   function delete($table,$id)
   {
      $qry="delete from `".$table."` where id=".$id;
      if($this->sql->query($qry))
      return true;
      else
       return false;
      
   }

   function deleteref($table,$ref)
   {
      $qry="delete from `".$table."` where reference='".$ref."'";
      if($this->sql->query($qry))
      return true;
      else
       return false;
      
   }

//    --------------------------------------insert
   
   function insert($table,$tabName,$tabValue)
   {
      $name="";
      $value="";
      $vrg=""; 
      for($i=0;$i<count($tabName);$i++)
      {
         if($i>0)
         {
            $vrg=",";
         }

         $name.=$vrg."`".$tabName[$i]."`";
      }
      
      $vrg="";
      for($i=0;$i<count($tabValue);$i++)
      {
         if($i>0)
         {
            $vrg=",";
         }
         $value.=$vrg."'".$tabValue[$i]."'";
      }
      $qry="INSERT INTO ".$table." (".$name.") VALUES (".$value.")";
      
      
      if($this->sql->query($qry)){
            return true;
        }
        return false;
   }

//    --------------------------------------update

   function update($table,$tabName, $tabValue,$id)
   {
      $name="";
      $value="";
      for($i=0;$i<count($tabName);$i++)
      {
         $vrg="";
         if($i>0)
         {
            $vrg=",";
         }
         $name.=$vrg."`".$tabName[$i]."`='".$tabValue[$i]."'";
      }
      
      $qry="UPDATE ".$table." SET ".$name." WHERE id=".$id;
     
      if($this->sql->query($qry))
      return true;
      else
       return false;
   }

//    --------------------------------------select

   function edit($table,$id)
   {
      $qry="select * from ".$table." where id=".$id;
      return $this->sql->query($qry)->fetchAll()[0];
   }

   function selectById($table,$id)
   {
      $qry="select * from ".$table." where id=".$id;
      return $this->sql->query($qry)->fetchAll()[0];
   }
}



