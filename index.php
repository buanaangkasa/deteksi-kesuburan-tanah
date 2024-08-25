<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="5" >
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>

	<title> Kesuburan Tanah </title>

</head>

<body>

    <h1>Kesuburan Tanah</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "subur";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, sensor, value1, reading_time FROM sensordata ORDER BY id DESC"; /*select items to display from the sensordata table in the data base*/

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <th>ID</th> 
        <th>Date / Time</th> 
        <th>Kelembaban(%)</th> 
        <th>Status Kelembaban</th>   
        <th>Merah Tanah</th>
        <th>Hijau Tanah</th>   
        <th>Biru Tanah</th>
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_reading_time = $row["reading_time"];
        $row_moisture = $row["moisture"];
        $row_moisture_status = $row["moistureStatus"];
        $row_red = $row["f_red"];
        $row_green = $row["f_green"];
        $row_blue = $row["f_blue"];
        
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
       // $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_reading_time . '</td> 
                <td>' . $row_moisture . '</td> 
                <td>' . $row_moisture_status . '</td>
                <td>' . $row_red . '</td>
                <td>' . $row_green . '</td>
                <td>' . $row_blue. '</td> 
                
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>

</body>
</html>

	</body>
</html>