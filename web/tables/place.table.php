<?php

$result = prepare("SELECT * FROM place;");
$result->execute();

$columns = ["place_address"];
$title   = "Places";

