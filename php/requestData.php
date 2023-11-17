<?php
require_once '../models/Requests.php';

// Assuming you have a function to retrieve data by ID and status in your Requests.php file
$id = $_GET['id'];
$status = $_GET['status'];
$data = (new RequestManager)->getSinglePost($id, $status);

// Encode the data as JSON and return it
header('Content-Type: application/json');
echo json_encode($data);
?>