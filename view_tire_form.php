<?php 
session_start();

if (!isset($_SESSION['empID'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$tireID = filter_input(INPUT_POST, 'tireID');
$vehicleID = filter_input(INPUT_POST, 'vehicleID');

$tireSQL = 'SELECT * FROM Tire WHERE tireID=:tireID';
$statement = $db->prepare($tireSQL);
$statement->bindValue(':tireID', $tireID);
$statement->execute();
$tirestatement = $statement->fetchAll();
$statement->closeCursor();
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

<h2>View Tire <?php echo $tirestatement['tireID']; ?></h2>
<?php foreach ($tirestatement as $tire) : ?>
<div> 
    <label>
    Tire ID:
    </label>
    <input type="int" name="tireID" value="<?php echo $tire['tireID']; ?>" readonly/><br>
</div>
<br>
<div>
    <label>
    Tire Code:
    </label>
    <input type="text" name="tire_code" value="<?php echo $tire['tire_code']; ?>" readonly/><br>
</div>
<br>      
<div>
    <label>
    Tire Position:   
    </label>
    <input type="text" name="tire_position" value="<?php echo $tire['tire_position']; ?>" readonly/><br> 
</div>
<br>    
<div>
    <label>
    Tire Name:   
    </label>
    <input type="text" name="tire_name" value="<?php echo $tire['tire_name']; ?>" readonly/><br>
</div>
<br>    
<div>
    <label>
    Installed Date:   
    </label>
    <input type="date" name="installed_date" value="<?php echo $tire['installed_date']; ?>"  readonly/><br>
</div>
<br>   
 <div>
    <label>
    Number Replaced:   
    </label>
    <input type="int" name="number_replaced" value="<?php echo $tire['number_replaced']?>" readonly/><br>
</div>
<br/>

 <div>
    <label>
    Vehicle ID:   
    </label>
    <input type="int" name="vehicleID" value="<?php echo $tire['vehicleID']?>" readonly/><br>
</div>
<br/>

<br/>
<br>

<?php endforeach; ?>
<hr>
<footer>
    <p2 class="copyright">
        &copy; <?php echo date("Y"); ?> RMRT.
    </p2>
</footer>
</body>
</html>
