<?php 
session_start();

if (!isset($_SESSION['empID'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$vehicleID = filter_input(INPUT_POST, 'vehicleID');

$vehicleSQL = 'SELECT * FROM Vehicle WHERE vehicleID=:vehicleID';
$statement = $db->prepare($vehicleSQL);
$statement->bindValue(':vehicleID', $vehicleID);
$statement->execute();
$vehiclestatement = $statement->fetch();
$statement->closeCursor();

$tireSQL = 'SELECT * FROM Tire WHERE vehicleID=:vehicleID';
$statement2 = $db->prepare($tireSQL);
$statement2->bindValue(':vehicleID', $vehicleID);
$statement2->execute();
$tirestatement = $statement2->fetchAll();
$statement2->closeCursor();
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

        <form action="view_customer_form.php" method="post">
            <input type="hidden" name="vehicleID"
                value="<?php echo $vehicleID; ?>">
            <input type="submit" value="Home">
        </form>
</div2>

<hr>

<h2>View Vehicle <?php echo $vehiclestatement['vehicleID']; ?></h2>
<div> 
    <label>
    VIN Number:
    </label>
    <input type="text" name="VIN_number" value="<?php echo $vehiclestatement['VIN_number']; ?>" readonly/><br>
</div>
<br>
<div>
    <label>
    Mileage:
    </label>
    <input type="text" name="mileage" value="<?php echo $vehiclestatement['mileage']; ?> miles a year" readonly/><br>
</div>
<br>      
<div>
    <label>
    Year:   
    </label>
    <input type="text" name="year" value="<?php echo $vehiclestatement['year']; ?>" readonly/><br> <!-- changed the input type to text -->
</div>
<br>    
<div>
    <label>
    Model:   
    </label>
    <input type="text" name="model" value="<?php echo $vehiclestatement['model']; ?>" readonly/><br>
</div>
<br>    
<div>
    <label>
    Make:   
    </label>
    <input type="text" name="make" value="<?php echo $vehiclestatement['make']; ?>" readonly /><br>
</div>
<br>   
 <div>
    <label>
    Manufacture Date:   
    </label>
    <input type="date" name="manufacture_date" value="<?php echo $vehiclestatement['manufacture_date']?>" readonly>
</div>
<br/>
<br>

<h2>Current Tires for Vehicle <?php echo $vehiclestatement['vehicleID']; ?></h2>

<br>
<table>
    <tr>
        <th>Tire Code</th>
        <th>Position</th>
        <th>Name</th>
        <th>Installation Date</th>
        <th>Times Replaced</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
<?php foreach ($tirestatement as $tire) : ?>
    <tr>
        <td><?php echo $tire['tire_code']; ?></td>
        <td><?php echo $tire['tire_position']; ?></td>
        <td><?php echo $tire['tire_name']; ?></td>
        <td><?php echo $tire['installed_date']; ?></td>
        <td><?php echo $tire['number_replaced']; ?></td>
        <td><form action="view_tire_form.php" method="post">
            <input type="hidden" name="tireID"
                value="<?php echo $tire['tireID']; ?>">
            <input type="submit" value="View">
        </form></td>   
        <td><form action="edit_tire_form.php" method="post">
            <input type="hidden" name="tireID"
                value="<?php echo $tire['tireID']; ?>">
            <input type="submit" value="Edit">
        </form></td>   
        <td><form action="delete_tire.php" method="post">
            <input type="hidden" name="tireID"
                value="<?php echo $tire['tireID']; ?>">
            <input type="hidden" name="vehicleID"
                value="<?php echo $tire['vehicleID']; ?>">
            <input type="submit" value="Delete">
        </form></td>  
    </tr>
<?php endforeach; ?>
</Table>

<br>
        <form action="add_tire_form.php" method="post">
            <input type="hidden" name="vehicleID"
                value="<?php echo $vehiclestatement['vehicleID']; ?>">
            <input type="submit" value="Add Tire">
        </form>

<hr>
<footer>
    <p2 class="copyright">
        &copy; <?php echo date("Y"); ?> RMRT.
    </p2>
</footer>
</body>
</html>
