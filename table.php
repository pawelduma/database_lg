<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['nazwa'])){
    $nazwa = get_post($conn, 'nazwa');
    $query = "DESCRIBE $nazwa";
    $result = $conn->query($query);
}
if (!$result) die ("Brak dostępu do bazy: " . $conn->error);

echo "<table class='table table-hover'><thead><tr>";
$col = $result->num_rows;
for ($k = 0 ; $k < $col ; ++$k){
    $result->data_seek($k);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo "<th>$row[0]</th>";
}
echo "</tr></thead><tbody>";
$query = "SELECT * FROM $nazwa"; 
$result = $conn->query($query); 
$rows = $result->num_rows;
for ($i = 0 ; $i < $rows ; ++$i){
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo "<tr>";
    for ($k = 0 ; $k < $col ; ++$k){
        echo "<td>$row[$k]</row></td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";
$result->close();
$conn->close();

function get_post($conn, $var){
    return $conn->real_escape_string($_POST[$var]);
}
?>