<?php

$result = prepare("SELECT * FROM medium;");
$result->execute();

$columns = ["medium_number", "medium_name", "entity_name"];
$title   = "Mediums";

