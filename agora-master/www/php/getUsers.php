<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
$servername = '127.0.0.1';
$username = 'root';
$password = 'alumne';
$dbname = 'daw1704';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!mysqli_set_charset($conn, "utf8")) {
        } else {
        }
$sql = 'select nickname,userscore from users order by userscore desc';
$result = $conn->query($sql);
$arr = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }
}
echo $json_response = json_encode($arr);
mysqli_close($conn);
?>
