<?php

class BooksModel extends BaseModel{
    
    public function  getAll(){
       $statemant=self::$db->query('SELECT id,title FROM books');
       $result=$statemant->fetch_all();
       return $result;
    }
    public function getFilteredBooks($from,$size)
    {
       $statemant=self::$db->prepare('SELECT id,title FROM books LIMIT ?,?');
       $statemant->bind_param('ii',$from,$size);
       $statemant->execute();
       
       $result=$statemant->get_result()->fetch_all();
       return $result; 
        
    }
}
