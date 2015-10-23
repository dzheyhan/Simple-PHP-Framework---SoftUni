<?php

class AccountController extends BaseController{
    private  $db;
    
    public function onInit() {
        $this->db=new AccountModel();
    }
    
    public function register (){
       
        if($this->isPost){       
            $username=$_POST['username'];
            if($username==null || strlen($username)<3){
                $this->addErrorMessage("Username is invalid");
                $this->redirect("account", "register");
            }
            $password=$_POST['password'];
            $isRegistered=$this->db->register($username, $password);
            if($isRegistered){
               $_SESSION['username']=$username;
               $this->addInfoMessage("Registerid!");
               $this->redirect("books","index"); 
            } 
            else {
                $this->addErrorMessage("Register Feilid!");
            }
            
        }
        $this->renderView(__FUNCTION__);
        
    }
    public function login (){
        if($this->isPost){       
            $username=$_POST['username'];
            $password=$_POST['password'];
            $isLoggedID=$this->db->login($username,$password);
            if($isLoggedID){
                $_SESSION['username']=$username; 
                $this->addInfoMessage("Successful login!");
                return $this->redirect("books","index");
           }
           else { 
                $this->addErrorMessage("Login error");    
                
           }
        }
        $this->renderView(__FUNCTION__);
        
    }
    public function logout (){
         $this->authorize();
        
        unset($_SESSION['username']);
        $this->addInfoMessage('Bay PICH');
        $this->redirectToUrl('/');
    }
    
    public function index() {
       $this->renderView(__FUNCTION__);
    }
}