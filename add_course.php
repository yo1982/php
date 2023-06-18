<?php

use Predis\Client;

// Redis configuration
$redisConfig = [
    'scheme' => 'tcp',
    'host' => '127.0.0.1',
    'port' => 6379,
];

// Create a new Redis client
$redis = new Client($redisConfig);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];

    // Insert the course name into Redis
    $redis->sadd('courses', $course_name);

$servername = "php.crxp2kml8djl.eu-north-1.rds.amazonaws.com";
$username = "admin";
$password = "chess#82";
$dbname = "ph1";

$course_name = $_POST['course_name'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert course name into the database
$sql = "INSERT INTO courses (course_name) VALUES ('$course_name')";

if ($conn->query($sql) === TRUE) {
    echo "Course added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
