<?php

$result = prepare("SELECT * FROM medium_entity;");
$result->execute();

$columns = ["entity_name"];
$title   = "Entities";

