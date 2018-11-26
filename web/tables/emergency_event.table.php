<?php

$result = prepare("SELECT * FROM emergency_event;");
$result->execute();

$columns = ["phone_number", "call_time", "person_name", "place_address", "rescue_process_number"];
$title   = "Emergency Events";

