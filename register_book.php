<?php
    session_start();

    $user_name = filter_input(INPUT_POST, 'user_name');    
    $password = filter_input(INPUT_POST, 'password');

    $hash = password_hash($password, PASSWORD_DEFAULT);  
    
    require_once('database.php');
    $queryRegistrations = 'SELECT * FROM registrations';
    $statement = $db->prepare($queryRegistrations);
    $statement->execute();
    $registrations = $statement->fetchAll();

    $statement->closeCursor();

    foreach ($registrations as $registration)
    {
        if ($user_name == $registration["userName"])
        {
            $_SESSION["add_error"] = "Invalid data, Duplicate Username. Try again.";

            $url = "error.php";
            header("Location: " . $url);
            die();
        }
    }

    if ($user_name === null || $password === null)
    {
        $_SESSION["add_error"] = "Invalid registration data, Check all fields and try again.";

        $url = "error.php";
        header("Location: " . $url);
        die();
    }
    else
    {        

        require_once('database.php');

        $query = 'INSERT INTO registrations
            (userName, password)
            VALUES
            (:userName, :password)';

        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $user_name);
        $statement->bindValue(':password', $hash);

        $statement->execute();
        $statement->closeCursor();

    }

    $_SESSION["isLoggedIn"] = 1;
    $_SESSION["userName"] = $user_name;

    $url = "register_confirmation.php";
    header("Location: " . $url);
    die();

?>