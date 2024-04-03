<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $team_names = [
        mysqli_real_escape_string($conn, $_POST['team_1_name']),
        mysqli_real_escape_string($conn, $_POST['team_2_name']),
        mysqli_real_escape_string($conn, $_POST['team_3_name'])
    ];

    // Start by setting status to 'off' for all rows
    mysqli_query($conn, "UPDATE tb_score SET status = 'off'");

    // Construct the VALUES part of the INSERT statement with placeholders
    $placeholders = implode(',', array_fill(0, count($team_names), '(?, ?, ?)'));

    // Prepare the statement
    $stmt = mysqli_prepare($conn, "INSERT INTO tb_score (score, status, team_name) VALUES (0, 'on', ?)");

    // Bind parameters and execute the statement for each team name
    foreach ($team_names as $team_name) {
        mysqli_stmt_bind_param($stmt, 's', $team_name);
        mysqli_stmt_execute($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    header("Location: admin.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <br>
        Team 1
        <input type="text" name="team_1_name" value=""><br><br>
        Team 2
        <input type="text" name="team_2_name" value=""><br><br>
        Team 3
        <input type="text" name="team_3_name" value=""><br><br>
        <button name="submit" type="submit">Submit</button>
    </form>
</body>

</html>