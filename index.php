<?php
ob_start();

session_start();
$_SESSION['admin'] = (empty($_SESSION['admin']) ? 0 : 1);


if(isset($_POST['buttonTxt'])){
    require_once('services/UserService.class.php');
    $obj = new UserService();
    $userValidation = $obj->userValidation($_POST['loginTxt'], $_POST['passwordTxt']);
    $_SESSION['admin'] = (!empty($userValidation)) ? 1 : 0;
    header("Refresh: 0");

}



if($_SESSION['admin'] == 0)
{
    include('presentation/formulier.php');
}
else
{
    include('presentation/admin.php');
}



if(isset($_GET['action']) && ($_GET['action'] == 'logout'))
{
    $_SESSION = array();
    unset($_COOKIE[session_name()]);
    session_destroy();
    header("Location: index.php");
}


ob_flush();





