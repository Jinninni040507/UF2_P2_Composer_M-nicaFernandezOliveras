<?php
    require '../../Vendor/autoload';

    use App\Config\Roles;

    // save role
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION['optionRole'] = $_POST['optionRole'];
    }

    class ViewReparation{
        public function render($model):void {
            
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reparation</title>
</head>
<body>
    <form action="POST" action="../Controller/ControllerReparation.php" >
        <br>
        <h1>Car Workshop Reparation Menu</h1>
        <h2>Search car reparation</h2>
        <label for="uuid">id reparation number:</label>
        <input type="text" id="uuid" name="uuid"><br>
        <input type="submit" name="search" id="getReparation">
        <?php
            // if (isset($_POST["optionRole"]) && $_POST['optionRole'] == Roles::ROLE_EMPLOYEE) {
                
            // }
        ?>
    </form>
    