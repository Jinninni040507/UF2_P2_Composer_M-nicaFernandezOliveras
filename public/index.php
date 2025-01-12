<?php
$title = "Car workshop";
include '../src/View/layouts/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title>Car workshop</title>
</head>

<body>
  <div class="container d-flex flex-column m-3 gap-2">
    <form action="../src/View/viewReparation.php" method="get">
      <br />
      <h1>Car workshop Main Menu</h1>
      <h3>Choose role</h3>
      <select name="optionRole" id="role">
        <option value="client">Client</option>
        <option value="employee">Employee</option>
      </select>
      <br /><br />
      <input type="hidden" name="formOpt" value="chooseRole">
      <input type="submit" value="Enter" />
    </form>
  </div>
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>