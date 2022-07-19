<?php

include_once 'Database.php';
include_once 'models/Lead.php';



$database = new Database();
$db = $database->getConnection();

$lead = new Lead($db);

$stmt = $lead->read();

