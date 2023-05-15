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
        
        <a href="view_customer_form.php">Home</a>
    </main>

    <hr>
    <footer>
        <p2 class="copyright">
            &copy; <?php echo date("Y"); ?> RMRT.
        </p2>
    </footer>
</body>
</html>