<?php

require '../../common/init.php';

$table = table_params(query("SELECT * FROM rescue_process;"), "Rescue Processes",
	["rescue_process_number"]
);

include '../../views/simple.view.php';

