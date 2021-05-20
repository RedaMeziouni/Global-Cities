<?php 
	// POST METHODE
	$newcity = filter_input(INPUT_POST, $newcity, FILTER_SANITIZE_STRING);
	$countrycode = filter_input(INPUT_POST, $countrycode, FILTER_SANITIZE_STRING);
	$district = filter_input(INPUT_POST, $district, FILTER_SANITIZE_STRING);
	$population = filter_input(INPUT_POST, $population, FILTER_SANITIZE_STRING);

	// GET METHODE
	$city = filter_input(INPUT_GET, $city, FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Simple Form</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<!-- Main -->
	<main>
		<header>
			<h1>Simple Form using PDO</h1>
		</header>
		<?php if(!$city && !$newcity) { ?>
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
		<?php } else { ?>
			<!-- require the DB file -->
			<?php require('database.php'); ?>

			<?php 
				if ($city || $newcity) {
					$query = 'SELECT * FROM city 
					WHERE Name = :city 
					ORDER BY Population DESC';
					
					$statement = $db->prepare($query);
					if ($city) {
						$statement->bindValue(':city', $city);
					} else {
						$statement->bindValue(':city', $newcity);
					}
					$statement->execute();
					$results = $statement->fetchAll();
					$statement->closeCursor();
				}
			?>
		<?php } ?>
	</main>
</body>
</html>