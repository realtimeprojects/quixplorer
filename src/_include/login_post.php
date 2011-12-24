<?php   
    
session_start();

$loginname = $_POST["loginname"];
$password  = stripslashes($_POST["password"]);

if (!isset($loginname) || !isset($password))
{
    require qx_link("login.php"); 
}

if (!user_activate($loginname, md5($password)))
{
    logout();
    require qx_link("login.php");
}


$_SESSION["s_user"] = $_POST["loginname"];

?>
