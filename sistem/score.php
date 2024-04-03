<?php
require 'connection.php';

$score = [];

$result = mysqli_query($conn, "SELECT score FROM tb_score WHERE status = 'on' ORDER BY id ASC LIMIT 3");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $score[] = $row['score'];
    }
}

echo json_encode($score);

?>
