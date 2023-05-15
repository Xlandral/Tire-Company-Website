<?php
session_start();

if (!isset($_SESSION['empID'])) {
    header('Location: index.php');
    exit();
}

require_once 'database.php';

$phone = filter_input(INPUT_POST, 'phone');

$requestStatement = 'SELECT * FROM Customer WHERE phone=:phone';
$statement = $db->prepare($requestStatement);
$statement->bindValue(':phone', $phone);
$statement->execute();
$request = $statement->fetchAll();
$statement->closeCursor();

$vehicleID = $request[0]['vehicleID'];

$requestStatement2 = 'SELECT * FROM Vehicle WHERE vehicleID=:vehicleID';
$statement2 = $db->prepare($requestStatement2);
$statement2->bindValue(':vehicleID', $vehicleID);
$statement2->execute();
$request2 = $statement2->fetchAll();
$statement2->closeCursor();
?>
<html lang="en">
    
<header>
    <title>Rubber Meets the Road Tire Company</title>
    <link rel="stylesheet" type="text/css" href="finalstyle.css">
</header>
    
<body>
   
<h1><b>Rubber Meets the Road Tire Company</b></h1>

<div2>
        <form action="index.php" method="post">
            <input type="submit" value="Logout">
        </form>

        <form action="view_customer_form.php" method="post">
            <input type="submit" value="Home">
        </form>
</div2>
<hr>      
<h3><label for="">Phone Number</label></h3>

<form action="" method="post">
<input type="text" name="phone" value="<?php echo $phone ?>">
<input type="submit" value="Submit">

</form>

<h2>Customer List</h2>
<table>
    <tr>
        <th>Account Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Vehicle ID</th>
    </tr>
<?php foreach ($request as $customer) : ?>
    <tr>
        <td><?php echo $customer['account_num']; ?></td>
        <td><?php echo $customer['first_name']; ?></td>
        <td><?php echo $customer['last_name']; ?></td>
        <td><?php echo $customer['phone']; ?></td>
        <td><?php echo $customer['email']; ?></td>
        <td><?php echo $customer['vehicleID']; ?></td>
    </tr>
<?php endforeach; ?>

</table>

<h2>Vehicle List</h2>
<table>
    <tr>
        <th>Vehicle ID</th>
        <th>Model</th>
        <th>Make</th>
        <th>Year</th>
        <th></th>
    </tr>
<?php foreach ($request2 as $vehicle) : ?>
    <tr>
        <td><?php echo $vehicle['vehicleID']; ?></td>
        <td><?php echo $vehicle['model']; ?></td>
        <td><?php echo $vehicle['make']; ?></td>
        <td><?php echo $vehicle['year']; ?></td>
        <td><form action="view_vehicle_form.php" method="post">
            <input type="hidden" name="vehicleID"
                value="<?php echo $vehicle['vehicleID']; ?>">
            <input type="submit" value="View">
        </form></td>  
    </tr>
<?php endforeach; ?>

</table>
        <hr>
    <footer>
            <p2 class="copyright">
                &copy; <?php echo date("Y"); ?> RMRT.
            </p2>
    </footer>
        
    </div>
</body>
</html>