<?php
    define("_ROOT_", "/var/www/html");
    
	include(_ROOT_."/class/template.class");
	include(_ROOT_."/config/config.php");
	include(_ROOT_."/config/pass.php");
	include(_ROOT_."/lib/connection.php");
    include(_ROOT_."/lib/database.php");
    
    $recCode = null;

    if(isset($_GET['rec']))
    {
        $recCode = $_GET['rec'];
    }
    if(isset($_POST['name']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['rpass']))
    {
        $user['name'] = $_POST['name'];
        $user['user'] = $_POST['user'];
        $user['password'] = hash(HASH_CRIP, $_POST['pass']);

        $user['privileges'] = 0;
        if(false)
        {
            $user['privileges'] = 1;
        }

        DBInsert("user", $user);

        session_start();
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pass'] = $_POST['pass'];

        header("location: /php/auth.php");
    }
    else
    {
        $register 	= new Template(_ROOT_."/templates/register.html");
    
    
        $register->set("PageCharset", HTML_CHARSET);
        $register->set("PageTitle", HTML_TITLE);
        $register->set("StyleSheetLink", MAIN_CSS);
        
    
        echo $register->output();
    }


?>