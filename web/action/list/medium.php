<?php

require '../../common/init.php';

$table = table_params(query("SELECT * FROM medium;"), "Mediums",
	["medium_number", "medium_name", "entity_name"]
);

include '../../views/simple.view.php';

