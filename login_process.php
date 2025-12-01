<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hydrohub");

$dam_name = $_POST['dam-name'];
$password = $_POST['password'];

$query = "
SELECT users.user_id, users.password_hash
FROM users
JOIN dam_details ON users.user_id = dam_details.user_id
WHERE dam_details.dam_name = '$dam_name'
";

$res = $conn->query($query);

if ($res->num_rows === 1) {
    $row = $res->fetch_assoc();

    if (password_verify($password, $row['password_hash'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['dam_name'] = $dam_name;

        header("Location: dam-dashboard.html");
        exit;
    }
}

echo "Invalid dam name or password.";
?>
