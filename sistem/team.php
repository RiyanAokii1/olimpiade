<?php
require 'connection.php';

$team_name = [];

$result = mysqli_query($conn, "SELECT team_name FROM tb_score WHERE status = 'on' ORDER BY id ASC LIMIT 3");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $team_name[] = $row['team_name'];
    }
}

echo json_encode($team_name);
?>
