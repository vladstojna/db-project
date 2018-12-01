<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">

	<style>
	.scrollable {
		height: 50%;
		width: 100%;
		overflow-y: auto;
		padding-right: 10pt;
	}

	input, select {
		width: 100%;
		margin: 8px 0;
		border-radius: 4px;
	}

	input[type=text], select {
		padding: 12px 20px;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
	}

	input[type=submit] {
		width: 100%;
		padding: 14px 20px;
		border: none;
		cursor: pointer;
	}

	.formdiv {
		padding: 20px;
		margin-bottom: 40px;
		width: 400px;
		background-color: #404040;
		border-radius: 5px
	}
	</style>

</head>

<body>

	<a href="javascript:history.back()"> ~ Back </a> 

	<p> <?=$status?> </p>

	<div class="formdiv">
	<form id="form" action="" method="POST">

		<label for="phoneInput"> Phone Number </label>
		<input id="phoneInput" type="text" name="phone_number" placeholder="e.g. 912345678" required>

		<label for="timeInput"> Call Time </label>
		<input id="timeInput" type="text" name="call_time" placeholder="YYYY/MM/DD HH:MM:SS" required>

		<label for="nameInput"> Caller </label>
		<input id="nameInput" type="text" name="person_name" placeholder="Name..." required>

		<label for="placeInput"> Place </label>
		<select id="placeInput" name="place_address" form="form">
<?php foreach($select as $value): ?>
			<option value="<?=$value?>"> <?=$value?> </option>
<?php endforeach ?>
		</select>

		<input type="submit" value="Insert">
	</form>
	</div>

	<div class="scrollable">
<?php include __DIR__ . '/../table/table.view.php' ?>
	</div>

</body>
</html>

