<?php
// Check if quiz form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the quiz form
    $q1 = isset($_POST['r1']) ? $_POST['r1'] : null;
    $q2 = isset($_POST['r2']) ? $_POST['r2'] : null;
    $q3 = isset($_POST['r3']) ? $_POST['r3'] : null;
    $q4 = isset($_POST['r4']) ? $_POST['r4'] : null;

    // Insert the quiz data into quiztable
    $quizServername = "localhost";
    $quizUsername = "root";
    $quizPassword = "";
    $quizDbname = "quizdb";

    // Create connection
    $quizConn = new mysqli($quizServername, $quizUsername, $quizPassword, $quizDbname);

    // Check connection
    if ($quizConn->connect_error) {
        die("Connection failed: " . $quizConn->connect_error);
    }

    // Your database query (replace with your actual query)
    $quizSql = "INSERT INTO quiztable (q1, q2, q3, q4) VALUES (?, ?, ?, ?)";

    $stmt = $quizConn->prepare($quizSql);
    $stmt->bind_param("ssss", $q1, $q2, $q3, $q4);

    if ($stmt->execute()) {
        echo json_encode(array("message" => "Quiz data inserted successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $quizConn->close();
}
?>
