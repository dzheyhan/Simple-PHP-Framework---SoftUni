<?php


class AuthorsModel extends BaseModel {
    public function getAll(){
        $statement=  self::$db->query(
                "SELECT * FROM authors ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function   createAuthor($name)
    {
        if($name=='')
        {
            return false;
        }
        $statemant=  self::$db->prepare( "INSERT INTO authors VALUE (NULL, ?)");
        $statemant->bind_param("s",$name);
        $statemant->execute();
        return $statemant->affected_rows>0;
        
        
    }
    
    public function   deleteAuthor($id)
    {
        
        $statemant=  self::$db->prepare( "DELETE FROM authors WHERE id=?");
        $statemant->bind_param("i",$id);
        $statemant->execute();
        return $statemant->affected_rows>0;
        
        
    }
    
}
