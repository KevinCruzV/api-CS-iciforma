<?php

include_once 'config/Database.php';
include_once 'models/Lead.php';


//$database = new Database();
//$db = $database->getConnection();
//
//$lead = new Lead($db);
//
//$stmt = $lead->read();

$key_value = $this->input->get_request_header("X-API-KEY");

var_dump($key_value);