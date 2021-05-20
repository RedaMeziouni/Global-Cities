<!DOCTYPE html>
<html>
<head>
	<title>Simple Form</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<main>
		<header>
			<h1>Simple Form using PDO</h1>
		</header>
		<!-- First Section -->
		<section>
			<h2>Select DATA / Read DATA</h2>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
				<label for="city">City Name: </label>
				<input type="text" name="city" id="city" required>
				<button>SUBMIT</button>
			</form>
		</section>
		<!-- Second Section -->
		<section>
			<h2>Insert DATA / Create DATA</h2>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<!-- City Name -->
				<label for="newcity">City Name: </label>
				<input type="text" name="newcity" id="newcity" required>
			<!-- Country Code -->
				<label for="countrycode">Country code: </label>
				<input type="text" name="countrycode" id="countrycode" required maxlength="3">
			<!-- District -->
				<label for="district">District: </label>
				<input type="text" name="district" id="district" required>
			<!-- Population -->
				<label for="population">Population: </label>
				<input type="text" name="population" id="population" required>
			<!-- BUTTON -->
					<button>SUBMIT</button>					
				</form>
		</section>
	</main>
</body>
</html>