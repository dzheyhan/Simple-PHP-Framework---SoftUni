<?php

/**
 * Description of BaseController
 *
 * @author PC
 */
abstract class BaseController {

    protected $layoutName = DEFAULT_LAYOUT;
    protected $controllerName;
    protected $isViewRendered = FALSE;
    protected $isPost = false;
    protected $isLoggedIn;
    protected $vialidationErrors; 
    
    function __construct($controllerName) {
        $this->controllerName = $controllerName;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }
        
        if(isset($_SESSION['username'])){
            $this->isLoggedIn=true;
            
        }
        $this->onInit();
    }

    public function onInit() {
        //Implement initializing Logic in the subclasses
    }

    public function index() {
        //Implement the default action in the subclasses
    }

    public function renderView($viewName = 'index', $includeLeyout = TRUE) {
        if (!$this->isViewRendered) {
          
            }
            $viweFileName = 'views/' . $this->controllerName . '/' . $viewName . '.php';
            if ($includeLeyout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once ($headerFile);
            }
            include_once ($viweFileName);
            if ($includeLeyout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once ($footerFile);
            }
            $this->isViewRendered = TRUE;
        }
    
    public function redirectToUrl($url) {
        header("Location:".$url);
        die;
    }

    public function redirect($controllerName, $actionName = NULL,$params=NULL) {

        $url = '/' . urlencode($controllerName);
        if ($actionName != NULL) {
            $url.='/' . urlencode($actionName);
        }
        if ($params != NULL) {
            $encodedParams = array_map($params, 'urlencode');
            $url.=implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }
    
    public function authorize(){
        
        if(!$this->isLoggedIn){
            $this->addErrorMessage('Please login firs');
            $this->redirect('account','login');
            
        }
        
    }

    public function addValidationError($field,$message){
        $this->vialidationErrors[$field]=$message;
    }

    public function getValidationError($field){
     return $this->vialidationErrors[$field];   
        
    }

    
    public function addInfoMessage($msg){
        
        $this->addMessage($msg,'info');
    }
    
    public function addErrorMessage($msg){
        
        $this->addMessage($msg,'error');
    }
    
    public function addMessage($msg,$type){
        if(!isset($_SESSION['messages'])){
            $_SESSION['messages']=array();
        }
        array_push($_SESSION['messages'],
                array('text' => $msg, 'type'=>$type));
    }


}
