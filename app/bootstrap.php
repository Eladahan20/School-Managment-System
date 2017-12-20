<?php
  //Load Config and Constants
  require_once 'config/config.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/File.php';
  require_once 'helpers/Validation.php';

  //Autoload core libraries
  spl_autoload_register (function($className) {
    require_once 'libraries/'. $className . '.php';
  });
  
  ?>