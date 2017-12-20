<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      $url = $this->getUrl();
      //Look in Controllers for first value
      if (file_exists('../app/controllers/'. ucwords($url[0]). '.php')){
        //if controller exists, set it up.
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
      //require and instanciate controller. if none instatnciate index.
      require_once('../app/controllers/'. $this->currentController. '.php');
      $this->currentController = new $this->currentController;
      // Get method
      if (isset($url[1])) {
        if (method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      //Get params
      $this->params = $url ? array_values($url) : [];

      //Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl(){
      // anyhting after "/projects/mvc/public/"...
      if (isset($_GET['url'])) { //$url = "posts/index/userid"
           $url = rtrim($_GET['url'], '/');
           $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode('/', $url);
           return $url;
      // $url = [0]=>posts [1]=>index [2]=>userid
    }
  } 
  
}
  