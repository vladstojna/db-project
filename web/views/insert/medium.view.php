<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)) { ?>
	<p> <?=$status?> </p>
<?php } ?>

<form action="" method="GET">
	<label for="numInput"> Medium Number </label>
	<input id="numInput" type="text" name="medium_number" placeholder="Number..." required>

	<label for="nameInput"> Medium Name </label>
	<input id="nameInput" type="text" name="medium_name" placeholder="Name..." required>

	<label for="entityInput"> Entity </label>
	<input id="entityInput" type="text" name="entity_name" placeholder="Name..." required>

	<input type="submit" value="Insert">
</form>

<?php table($table) ?>

</body>
</html>

