<?php
    define("_ROOT_", "/var/www/html");

	include(_ROOT_."/config/config.php");
	include(_ROOT_."/config/pass.php");
	include(_ROOT_."/lib/connection.php");
    include(_ROOT_."/lib/database.php");
    

    session_start();

    $user = isset($_POST['user']) ? $_POST['user'] : $_SESSION['user'];
    $pass = isset($_POST['pass']) ? $_POST['pass'] : $_SESSION['pass'];

    $pass = hash(HASH_CRIP, $pass);

    $query = dbRead("user", "WHERE user = '{$user}' and password = '{$pass}'");
    $query = $query[0];

    if($query != null)
    {
        $priv = $query['privileges'];

        $_SESSION['id'] = $query['id'];
        $_SESSION['name'] = $query['name'];
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['privileges'] = $priv;

        if($priv == 0)
        {
            header("location: /php/home.php");
        }
        else if($priv == 1) 
        {
            header("location: /php/master.php");
        }
    }
    else
    {
        header("location: /php/login.php?error=Nao Registrado");
    }

