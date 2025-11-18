<?php

require_once "../../Classes/Participants.php";
$participant = new Participants();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $participants = $participant->search($_POST['partId']);
} else {
    $participants = $participant->getAll();
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
            <a href="index.php">Home</a>
            <a href="create.php">Create </a>
            <a href="../../menu.php">Menu</a>
        </nav>
    </header>
    <div class="table-container">
        <form action="" method="post">
            <label for="partId">Search participants by id</label>
            <input type="text" name="partId" placeholder="Search participants by id" required>
            <button type="submit">Search</button>
        </form>
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>Participants ID</th>
                <th>Participants Event Code</th>
                <th>Participants First Name </th>
                <th>Participants Last Name </th>
                <th>Participants Discount Rate</th>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
                    <th >Actions</th>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($participants->num_rows > 0): ?>
                <?php while ($row = $participants->fetch_assoc()): ?>
            <tr>
                <td><?= $row['partId'] ?></td>
                <td><?= $row['evName'] ?></td>
                <td><?= $row['partFName'] ?></td>
                <td><?= $row['partLName'] ?></td>
                <td><?= $row['partDRate'] ?></td>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
                    <td>
                        <a href="delete.php?partId=<?= htmlspecialchars($row['partId']) ?>">Delete</a>
                        <a href="edit.php?partId=<?= $row['partId'] ?>">Edit</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <td colspan="6">No Participants found</td>
    <?php endif; ?>
    </tr>
        </table>
    </div>
</body>

</html>