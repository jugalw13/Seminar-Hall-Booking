<?php
session_start();
if(!$_SESSION['loggedin'])
    {
        header("Location: login.php");
    }
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "dbproject";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM halls";

$result = $conn->query($sql);
if ($conn->query($sql) == TRUE) {
?>
<html>
<head>
<title>Halls</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<button onclick="goBack()">Go Back</button>
<p><a href="about.php">Main</a></p>
<script>
function goBack() {
    window.history.back();
}
</script>
<table border="2"> 
<?php 
    if ($result->num_rows > 0) { ?>
        
            <tr>
                <th>Hall_Id</th>
                <th>Hall_name</th>
                <th>Location</th>
                <th>Capacity</th>
            </tr>
        <?php while($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["location"] ?></td>
                <td><?php echo $row["capacity"] ?></td>
            </tr>
        <?php
            }
        } else {
            echo "0 results";
        }
?>
</table>

</body>
</html>
<?php

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
