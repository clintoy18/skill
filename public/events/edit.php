<?php

require_once "../../Classes/Event.php";
$event = new Event();

$data = $event->getById($_GET['evCode'])->fetch_assoc();
$jsAlert = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $message = $event->update(
        $_POST['evCode'],
        $_POST['evName'],
        $_POST['evDate'],
        $_POST['evVenue'],
        $_POST['evRFee'],
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
    <title>Events</title>
</head>

<body>
    <header>
        <h1>
            Edit Events 
        </h1>
        <nav>
            <a href="index.php">View Event Lists</a>
        </nav>
    </header>
    <div class="form-container">
        <form action="" method="post">
            <label for="evCode">Enter event  code</label>
            <input type="text"  value="<?= $data['evCode']?>" name="evCode" placeholder="Enter event code" required>

            <label for="evName">Event Name</label>
            <input type="text"  value="<?= $data['evName']?>" name="evName" placeholder="Enter event name" required>

            <label for="evDate"> event DATE</label>
            <input type="date"   value="<?= $data['evDate']?>" name="evDate" placeholder=" event date" required>

            <label for="evVenue">event venue</label>
            <input type="text" value="<?= $data['evVenue']?>" name="evVenue" placeholder="event Venue" required>

            <label for="evRFee">event fee</label>
            <input type="number"  value="<?= $data['evRFee']?>" name="evRFee" placeholder="event fee " required>

            <button type="submit">Submit</button>
        </form>

    </div>
</body>

</html>