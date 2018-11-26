<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)) ?>
	<p> <?=$status?> </p>

<form action="" method="GET">
	<label for="in"> Rescue Process </label>
	<input id="in" type="text" name="rescue_process_number" placeholder="Number..." required>
	<input type="submit" value="Insert">
</form>

<?php table($result, $title, $columns) ?>

</body>
</html>

