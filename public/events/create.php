<?php

require_once "../../Classes/Event.php";
$event = new Event();
$jsAlert = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $message = $event->create(
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
            Create Event
        </h1>
        <nav>
            <a href="index.php">Lists</a>
        </nav>
    </header>
    <div class="form-container">
        <form action="" method="post">
            <label for="evCode">Enter event  code</label>
            <input type="text" name="evCode" placeholder="Enter event code" required>

            <label for="evName">Event Name</label>
            <input type="text" name ="evName"placeholder="Enter event name" required>

            <label for="evDate"> event DATE</label>
            <input type="date" name="evDate" placeholder=" event date" required>

            <label for="evVenue">event venue</label>
            <input type="text" name="evVenue" placeholder="event Venue" required>

            <label for="evRFee">event fee</label>
            <input type="number" name="evRFee" placeholder="event fee " required>

            <button type="submit">Submit</button>
        </form>

    </div>
</body>

</html>