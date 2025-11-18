<?php

require_once "../../Classes/Participants.php";
require_once "../../Classes/Event.php";

$participant = new Participants();
$event = new Event();
$events = $event->getAll();
$jsAlert = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $message = $participant->create(
        $_POST['partId'],
        $_POST['evCode'],
        $_POST['partFName'],
        $_POST['partLName'],
        $_POST['partDRate']
    );
    $jsAlert = "
        <script>
        alert('" . addslashes($message) . "');
        window.location.href = 'index.php';
        </script>
        ";
    echo $jsAlert;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">

    <title>Participants</title>
</head>

<body>
    <header>
        <h1>
            Participants Management
        </h1>
        <nav>
            <a href="index.php">View Participants Lists</a>
        </nav>
    </header>
    <div class="form-container">
        <form action="" method="post">
            <label for="partId">Enter participant code</label>
            <input type="text" name="partId" placeholder="Enter participants code" required>

            <label for="evCode">participant event code</label>
            <select name="evCode" id="evCode">
                <option value="">--Select Event</option>
                <?php while ($row = $events->fetch_assoc()): ?>
                    <option value="
              <?= $row['evCode'] ?>"> <?= $row['evName'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="partFName">First name</label>
            <input type="text" name="partFName" placeholder=" Participants firstname" required>

            <label for="partLName">Last name</label>
            <input type="text" name="partLName" placeholder="Participants lastname" required>

            <label for="partDRate">Participants Discount Rate</label>
            <input type="number" name="partDRate" placeholder="participants discount rate " required>

            <button class="submit-button" type="submit">Submit</button>
        </form>

    </div>
</body>

</html>