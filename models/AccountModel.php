<?php

class AccountModel extends BaseModel {
    
    public function  register($username,$password){
     $statement=self::$db->prepare("SELECT COUNT(Id) FROM Users WHERE Username=?");
     $statement->bind_param("s",$username);
     $statement->execute();
     $result=$statement->get_result()->fetch_assoc();
     if($result['COUNT(Id)']){
         return false;
     }
     $hash_pass=  password_hash($password, PASSWORD_BCRYPT);
     $registerStatemant=self::$db->prepare("INSERT INTO users (username,pass_hash) VALUES (?,?)");
     $registerStatemant->bind_param("ss",$username, $hash_pass);
     $registerStatemant->execute();
     return  TRUE;
    }
    
    public function  login($username,$password){
     $statement=self::$db->prepare("SELECT Id, username,pass_hash FROM Users WHERE Username=?");
     $statement->bind_param("s",$username);
     $statement->execute();
     $result=$statement->get_result()->fetch_assoc();
     $a=$result['pass_hash'];
     
//     var_dump($result['pass__hash']);
     if(password_verify($password, $a)){
         return true;
     }else
         return false;
        
        
    }
}