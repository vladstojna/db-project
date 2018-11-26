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
	<label for="in"> Place </label>
	<input id="in" type="text" name="place_address" placeholder="Address..." required>
	<input type="submit" value="Insert">
</form>

<?php table($result, $title, $columns) ?>

</body>
</html>

