<?php
include 'connection.php';

$query = "SELECT * FROM tb_score WHERE status = 'on' ORDER BY id ASC LIMIT 3";
$result = mysqli_query($conn, $query);
$button = "EDIT";
if (mysqli_num_rows($result) <= 0) {
    $button = "ADD";
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    $data = mysqli_query($conn, "SELECT score FROM tb_score WHERE id = '$id'");
    $row = mysqli_fetch_assoc($data);

    @$score = $row['score'] + 100;
    if ($score) {
        mysqli_query($conn, "UPDATE tb_score SET score = '$score' WHERE id = '$id'");
    }
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
    <?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

            <a><?= $row['team_name'] ?></a><br>
            <form action="?<?= $row['id'] ?>" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button name="submit" type="submit">+ Score <?= $row['team_name'] ?></button><br><br>
            </form>

    <?php }
    }
    ?>
    <a href="input.php"><?= $button ?> TEAM</a>
</body>

</html>