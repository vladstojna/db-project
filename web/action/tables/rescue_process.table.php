<?php

$result = prepare("SELECT * FROM rescue_process;");
$result->execute();

$columns = ["rescue_process_number"];
$title   = "Rescue Processes";

