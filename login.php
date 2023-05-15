<?php
    session_start();
    require_once('database.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Employee WHERE username=? AND password=?";
    $statement = $db->prepare($sql);
    $statement->execute([$username, $password]);
    $query = $statement->fetchAll();   
    $statement->closeCursor();

    if (count($query) > 0) {
        $_SESSION['empID'] = $query[0]['empID'];
        header('Location: view_customer_form.php');
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
?>


