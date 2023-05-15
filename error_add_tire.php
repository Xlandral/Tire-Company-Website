<?php 
session_start();

if (!isset($_SESSION['empID'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$vehicleID = filter_input(INPUT_POST, 'vehicleID');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rubber Meets the Road Tire Company</title>
    <link rel="stylesheet" type="text/css" href="finalstyle.css">
</head>

<body>
    <h1><b>Rubber Meets the Road Tire Company</b></h1>
    <a href="index.php">Login</a>
    <hr>
    
    
    <main>
        <h2 class="top">ERROR</h2>
        <p><?php echo $error; ?></p>
        
        <form action="add_tire_form.php" method="post">
            <input type="hidden" name="vehicleID"
                value="<?php echo $vehicleID; ?>">
            <input type="submit" value="Go Back">
        </form>
    </main>

    <hr>
    <footer>
        <p2 class="copyright">
            &copy; <?php echo date("Y"); ?> RMRT.
        </p2>
    </footer>
</body>
</html>