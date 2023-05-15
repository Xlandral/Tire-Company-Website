<?php 
session_start();

if (!isset($_SESSION['empID'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$vehicleID = filter_input(INPUT_POST, 'vehicleID');

// Generate a random 6-digit tire ID
do {
    $tireID = rand(100000, 999999);
    $query = "SELECT COUNT(*) FROM tires WHERE tireID = :tireID";
    $statement = $db->prepare($query);
    $statement->bindValue(':tireID', $tireID);
    $statement->execute();
    $count = $statement->fetchColumn();
} while ($count > 0);

?>

<html lang="en">
<head>
    <title>Rubber Meets the Road Tire Company</title>
    <link rel="stylesheet" type="text/css" href="finalstyle.css">
</head>

<body>
    
<h1><b>Rubber Meets the Road Tire Company</b></h1>
<div2>
        <form action="index.php" method="post">
            <input type="submit" value="Logout">
        </form>

        <form action="view_vehicle_form.php" method="post">
            <input type="hidden" name="vehicleID"
                value="<?php echo $vehicleID; ?>">
            <input type="submit" value="Home">
        </form>
</div2>
<hr>
<form action="add_tire.php" method="post" id="add_tire_form">

<h2>Add Tire</h2>
<div> 
    <label>
    Tire ID:
    </label>
    <input type="text" name="tireID" value="<?php echo $tireID;?>" readonly /><br>
</div>
<br>
<div>
    <label>
    Tire Code:
    </label>
    <input type="text" name="tire_code" /><br>
</div>
<br>      
<div>
    <label>
    Tire Position:   
    </label>
    <input type="text" name="tire_position" /><br> 
</div>
<br>    
<div>
    <label>
    Tire Name:   
    </label>
    <input type="text" name="tire_name" /><br>
</div>
<br>    
<div>
    <label>
    Installed Date:   
    </label>
    <input type="date" name="installed_date" /><br>
</div>
<br>   
 <div>
    <label>
    Times Replaced:   
    </label>
    <input type="text" name="number_replaced" /><br>
</div>
<br/>
 <div>
    <label>
    Vehicle ID:   
    </label>
    <input type="text" name="vehicleID" value="<?php echo $vehicleID?>" readonly/> <br>
</div>
<br/>

<input type="submit" value="Add Tire" name="add_tire"/>
</form>

<hr>
<footer>
    <p2 class="copyright">
        &copy; <?php echo date("Y"); ?> RMRT.
    </p2>
</footer>
</body>
</html>
