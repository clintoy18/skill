<?php

require_once "../../Classes/Participants.php";
$participant = new Participants();

$data = $participant->getById($_GET['partId'])->fetch_assoc();
$jsAlert = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $message = $participant->update(
        $_POST['partId'],
        $_POST['evCode'],
        $_POST['partFName'],
        $_POST['partLName'],
        $_POST['partDRate'],
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

    <title>participants</title>
</head>

<body>
    <header>
        <h1>
            Edit Participant
        </h1>
        <nav>
            <a href="index.php">Lists</a>
        </nav>
    </header>
    <div class="form-container">
        <form action="" method="post">
            <label for="partId">Enter participant code</label>
            <input type="number" value="<?= $data['partId'] ?>" name="partId" placeholder="Enter part ID" required>
            
            <label for="evCode">Enter participant code</label>
            <input type="text" value="<?= $data['evCode'] ?>" name="evCode" placeholder="Enter participant code" required>

            <label for="partFName">Participant's First Name</label>
            <input type="text" value="<?= $data['partFName'] ?>" name="partFName" placeholder="Enter participant's firstname" required>

            <label for="partLName"> Participant Last Name</label>
            <input type="text" value="<?= $data['partLName'] ?>" name="partLName" placeholder="Enter participant's lastname " required>

            <label for="partDRate">Discount venue</label>
            <input type="text" value="<?= $data['partDRate'] ?>" name="partDRate" placeholder="Discount" required>

            <button type="submit">Submit</button>
        </form>

    </div>
</body>

</html>