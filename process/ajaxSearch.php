<?php
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';
$r = ['success'=>[]];
$query = $db->select('users',1);
while ($row = mysqli_fetch_assoc($query)){
    $r['success'][] = $row['first_name'].' '.$row['last_name'];
}
echo json_encode($r);
