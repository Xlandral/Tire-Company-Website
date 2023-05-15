<?php
require_once 'database.php';
?>

<!-- HTML code for login page -->
<html lang="en">
<header>
    <title>Rubber Meets the Road Tire Company</title>
    <link rel="stylesheet" type="text/css" href="finalstyle.css">
</header>

<body>
    <h1><b>Rubber Meets the Road Tire Company</b></h1>

    <hr>
    <h1><b>Employee Login</b></h1>
    <p>You must login before accessing information!</p>

    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <br />
    <hr>

    <footer>
        <p2 class="copyright">
            &copy; <?php echo date("Y"); ?> RMRT.
        </p2>
    </footer>

</body>
</html>