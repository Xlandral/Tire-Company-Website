<?php
    session_start();
    require_once('database.php');
    
    // Define the list of tire positions
    $valid_tire_positions = array('FL', 'FR', 'RL', 'RR', 'S', 'F', 'R');
    
$tireID = filter_input(INPUT_POST, 'tireID');
$tire_code = filter_input(INPUT_POST, 'tire_code');
$tire_position = filter_input(INPUT_POST, 'tire_position');
$tire_name = filter_input(INPUT_POST, 'tire_name');
$installed_date = filter_input(INPUT_POST, 'installed_date');
$number_replaced = filter_input(INPUT_POST, 'number_replaced');
$vehicleID = filter_input(INPUT_POST, 'vehicleID');


if ($tireID == NULL || $tire_code == NULL || $tire_position == NULL || 
        $tire_name == NULL || $installed_date == NULL || $number_replaced == NULL || $vehicleID == NULL) {
    $error = "Invalid tire information. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');
    
    // Check if the tire position is available
        $query = 'SELECT tire_position FROM Tire WHERE tire_position=:tire_position AND tireID!=:tireID LIMIT 1';
        $statement = $db->prepare($query);
        $statement->bindValue(':tire_position', $tire_position);
        $statement->bindValue(':tireID', $tireID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        if ($result) {
            // Tire position is not available
            $error = "The tire position is already taken by another tire. Please choose another position.";
            include('error_add_tire.php');
        } else if (!in_array($tire_position, $valid_tire_positions)) {
            // Tire position is not in the list of valid positions
            $error = "Invalid tire position. Please choose one of the following positions: " . implode(', ', $valid_tire_positions);
            include('error_add_tire.php');
        } else {

    $query = 'INSERT INTO Tire
                 (tireID, tire_code, tire_position, tire_name, installed_date, number_replaced, vehicleID)
              VALUES
                 (:tireID, :tire_code, :tire_position, :tire_name, :installed_date, :number_replaced, :vehicleID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':tireID', $tireID);
    $statement->bindValue(':tire_code', $tire_code);
    $statement->bindValue(':tire_position', $tire_position);
    $statement->bindValue(':tire_name', $tire_name);
    $statement->bindValue(':installed_date', $installed_date);
    $statement->bindValue(':number_replaced', $number_replaced);
    $statement->bindValue(':vehicleID', $vehicleID);
    $statement->execute();
    $statement->closeCursor();

    include('view_vehicle_form.php');
        }
}
?>

