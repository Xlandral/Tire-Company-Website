<?php
    session_start();
    require_once('database.php');

$tireID = filter_input(INPUT_POST, 'tireID');
$vehicleID = filter_input(INPUT_POST, 'vehicleID');

// Delete the email from the database
if ($tireID != FALSE) {
    $query = 'DELETE FROM Tire
              WHERE tireID = :tireID';
    $statement = $db->prepare($query);
    $statement->bindValue(':tireID', $tireID);
    $success = $statement->execute();
    $statement->closeCursor();  
    
    
    include('view_vehicle_form.php');
}