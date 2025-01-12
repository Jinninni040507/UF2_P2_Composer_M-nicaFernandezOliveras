<?php

namespace App\View;

require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Roles;
use App\Model\Reparation;
use App\Controller\ControllerReparation;
use DateTime;

// ---- Class ViewReparation -------------------------\\
class ViewReparation
{
    public function render(Reparation $reparation): void
    {

?>
        <div class="d-flex flex-column m-3">
            <div>Id: <?= $reparation->getId() ?></div>
            <div>Uuid: <?= $reparation->getUuid() ?></div>
            <div>Workshop id: <?= $reparation->getWorkshopId() > 0 ? $reparation->getWorkshopId() : '*' ?></div>
            <div>Workshop name: <?= $reparation->getWorkshopName() ?></div>
            <div>Register date: <?= $reparation->getRegisterDate() ? $reparation->getRegisterDate()->format(DateTime::COOKIE) : '******, **-***-**** **:**:** ***' ?></div>
            <div>License plate: <?= $reparation->getLicensePlate() ?></div>
            <div>
                <div>Photo</div>
                <div>
                    <img src="data:image/png;base64,<?php echo base64_encode($reparation->getPhoto()) ?>" alt="">
                </div>
            </div>

        </div>
<?php
    }
}


// ---- Forms Logic ----------------------------------\\
if (isset($_REQUEST['formOpt'])) {
    switch ($_REQUEST['formOpt']) {
        case 'chooseRole':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();

                if (isset($_GET["optionRole"]) && ($roleCase = Roles::tryFrom($_GET['optionRole']))) {
                    $_SESSION['optionRole'] = serialize($roleCase); // utilizar serialize porque el session siempre guarda strings
                } else {
                    unset($_SESSION['optionRole']);
                }
                session_write_close();
            }
            break;
        case 'view':
            $reparation = (new ControllerReparation)->getReparation();
            break;
        case 'insert':
            $newReparationId = (new ControllerReparation)->createReparation();
            break;
    }
}


// ---- Exit if Session not set -----------------------\\
if (!isset($_SESSION['optionRole'])) {
    header('Location: ../../public/index.php');
    exit;
}


// ---- Render Header --------------------------------\\
$title = "View Reparation";
include '../View/layouts/header.php';

?>
<div class="container d-flex flex-column m-3 gap-4 ">
    <h1>Car Workshop Reparation Menu</h1>
    <div class="d-flex flex-row gap-5 ">
        <br>
        <div class="d-flex flex-column">
            <form method="POST" action="viewReparation.php">
                <h2>Search car reparation</h2>
                <label for="id">id reparation number:</label>
                <input
                    type="number"
                    id="id"
                    name="id"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    required min="0"
                    max="2147483647" required>
                <br>
                <input type="hidden" name="formOpt" value="view">
                <input type="submit" name="search" id="getReparation">
            </form>

            <?php
            // ---- Render Insert Form ---------------------------\\
            if (unserialize($_SESSION['optionRole']) === Roles::ROLES_EMPLOYEE) {
            ?>
                <br>
                <form method="POST" action="viewReparation.php" enctype="multipart/form-data">
                    <h2>Insert car reparation</h2>

                    <label for="workshopId">Workshop id:</label>
                    <input
                        type="number"
                        id="workshopId"
                        name="workshopId"
                        required min="0"
                        max="500"
                        required>
                    <br>
                    <br>

                    <label for="workshopName">Workshop name:</label>
                    <input
                        type="text"
                        id="workshopName"
                        name="workshopName"
                        pattern="^.{0,12}$"
                        required>
                    <br>
                    <br>

                    <label for="date">Date:</label>
                    <input
                        type="datetime-local"
                        id="date"
                        name="date"
                        required>
                    <br>
                    <br>

                    <label for="licensePlate">License plate:</label>
                    <br>
                    <input
                        type="text"
                        id="licensePlate"
                        name="licensePlate"
                        pattern="^\d{4}\s?[A-Za-z]{3}$"
                        required>
                    <br>
                    <small>Format: 1234 ABC (4 digits followed by 3 capital letters)</small>
                    <br>
                    <br>

                    <label for="photo">Photo of the wrecked car:</label>
                    <br>
                    <input
                        type="file"
                        id="photo"
                        name="photo"
                        accept="image/*"
                        required>
                    <br>
                    <br>

                    <input type="hidden" name="formOpt" value="insert">
                    <input type="submit" name="search" id="getReparation">
                </form>
        </div>

    <?php
            }
            if (isset($reparation)) {
                (new ViewReparation)->render($reparation);
            }
    ?>
    </div>

</div>
<?php
// ---- Render Footer --------------------------------\\
include '../View/layouts/footer.php';
?>