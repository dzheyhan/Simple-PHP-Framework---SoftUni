<?php
class AuthorsController extends BaseController {
    private $db;


    public function onInit() {
        $this->title="Authors";
        $this->db=new AuthorsModel();
    }
    
    public function index() {
        $this->authorize();
        $this->authors=$this->db->getAll();
                 $this->renderView();
    }
    
    public function create() {
         $this->authorize();
        if($this->isPost){
            $name=$_POST['author_name'];
            
            if(strlen($name)<2){
               // $this->addFieldValue("author_name",$name); // not found addFieldValue
                $this->addValidationError("author_name",'The author name length shold be greater tha 2');
                return $this->renderView(__FUNCTION__);
                
            }
            
            if($this->authors=$this->db->createAuthor($name)){
              $this->addInfoMessage('Author created.');
                $this->redirect('authors');
            }else {
                $this->addErrorMessage("Rrror creating author.");
            }
            
            
            }
            $this->renderView(__FUNCTION__);
    }
    
     public function delete($id) {
          $this->authorize();
            if($this->db->deleteAuthor($id)){
            $this->addInfoMessage('Author DELITET.');
        } 
        else {
            $this->addErrorMessage("Cannot delite author.");}
            $this->renderView(__FUNCTION__);
    }
}