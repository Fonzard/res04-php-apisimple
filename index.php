<?php

require 'AbstractManager.php';
require 'AbstractController.php';

require 'user.php';

require 'UserManager.php';
require 'UserController.php';
require 'router.php';

if(isset($_GET["route"]))
{
    $route = $_GET['route'];
    
}
?>