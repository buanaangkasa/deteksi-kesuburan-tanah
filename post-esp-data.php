<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "subur";

/*$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);*/

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $moisture = $moisture_status = $red = $green = $blue = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $row_moisture = test_input($_POST["moisture"]);
        $row_moisture_status = test_input($_POST["moistureStatus"]);
        $row_red = test_input($_POST["f_red"]);
        $row_green = test_input($_POST["f_green"]);
        $row_blue = test_input($_POST["f_blue"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO sensordata (moisture, moistureStatus, f_red, f_green, f_blue)
        VALUES ('" . $moisture . "', '" . $moisture_status . "', '" . $red . "', '" . $green . "', '" . $blue . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}