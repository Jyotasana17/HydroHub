<?php
$conn = new mysqli("localhost", "root", "", "hydrohub");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$dam_name = $_POST['dam-name'];
$river_basin = $_POST['river-basin'];
$location = $_POST['location'];
$altitude = $_POST['altitude'];
$width = $_POST['width'];
$length = $_POST['length'];
$num_gates = $_POST['num-gates'];
$reservoir_capacity = $_POST['reservoir-capacity'];
$electricity_generation = $_POST['electricity-generation'];
$year_construction = $_POST['year-construction'];
$dam_type = $_POST['dam-type'];
$purpose = $_POST['purpose'];
$operator = $_POST['operator'];

$hashed = password_hash($password, PASSWORD_DEFAULT);

$conn->query("INSERT INTO users (email, username, password_hash)
VALUES ('$email', '$username', '$hashed')");

$user_id = $conn->insert_id;

$conn->query("INSERT INTO dam_details 
(user_id, dam_name, river_basin, location, altitude, width, length,
number_of_gates, reservoir_capacity, electricity_generation,
year_construction, dam_type, purpose, operator)
VALUES
('$user_id', '$dam_name', '$river_basin', '$location', '$altitude',
'$width', '$length', '$num_gates', '$reservoir_capacity',
'$electricity_generation', '$year_construction', '$dam_type',
'$purpose', '$operator')");

echo "Signup Successful!";
header("Location: login.html");
?>
