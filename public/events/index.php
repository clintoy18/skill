<?php

require_once "../../Classes/Event.php";
$event = new Event();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $events = $event->search($_POST['evCode']);
} else {
    $events = $event->getAll();
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
            Events Management
        </h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="create.php">Create</a>
            <a href="../../menu.php">Menu</a>
        </nav>
    </header>
    <div class="table-container">
        <form action="" method="post">
            <label for="evCode">Search event by code</label>
            <input type="text" name="evCode" placeholder="Search event code" required>
            <button type="submit">Search</button>
        </form>
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>Event Code</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Registration Fee</th>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
                    <th >Actions</th>
                <?php endif; ?>

            </tr>
            <tr>
                <?php if ($events->num_rows > 0): ?>
                <?php while ($row = $events->fetch_assoc()): ?>
            <tr>
                <td><?= $row['evCode'] ?></td>
                <td><?= $row['evName'] ?></td>
                <td><?= $row['evDate'] ?></td>
                <td><?= $row['evVenue'] ?></td>
                <td><?= $row['evRFee'] ?></td>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
                    <td>
                        <a href="delete.php?evCode=<?= htmlspecialchars($row['evCode']) ?>">Delete</a>
                        <a href="edit.php?evCode=<?= $row['evCode'] ?>">Edit</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <td colspan="6">No events found</td>
    <?php endif; ?>
    </tr>
        </table>
    </div>
</body>

</html>