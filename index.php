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
<html lang="en">
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple Form</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<!-- Main -->
	<main>
		<header>
			<h1>Simple Form using PDO</h1>
		</header>

		<!-- Checking the deleted var -->
		<?php 
			if(isset($deleted)) {
				echo "Record Deleted.<br><br>";
			} elseif (isset($updated)) {
				echo "Record Updated.<br><br>";
			}
		?>
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
				// Insert to cityT
				if ($newcity) {
					$query = 'INSERT INTO city 
					(Name, CountryCode, District, Population) 
					VALUES (:newcity, :countrycode, :district, :newpopulation';

					$statement = $db->prepare($query);
					$statement->bindValue(':newcity', $newcity);
					$statement->bindValue(':countrycode', $countrycode);
					$statement->bindValue(':district', $district);
					$statement->bindValue(':newpopulation', $newpopulation);

					$statement->execute();
					$statement->closeCursor();
				}

				// Read the cityT
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

			<!-- Working with the results -->
			<?php if (!empty($results)) { ?>
				<section>
					<h2>Update DATA / Delete DATA</h2>
					<?php 
						foreach($results as $result) {
							$id = $result['ID'];
							$city = $result['Name'];
							$countrycode = $result['CountryCode'];
							$district = $result['District'];
							$population = $result['Population'];
						}
					?>
					<!-- Update Form -->
					<form action="update_record.php" method="POST" class="update">
						<input type="hidden" name="id" value="<?php echo $id; ?>">

						<!-- City Name -->
						<label for="city-<?php echo $id; ?>">City Name: </label>
						<input type="text" id="city-<?php echo $id; ?>" name="city" value="<?php echo $city; ?>" required>

						<!-- Country Code -->
						<label for="countrycode-<?php echo $id; ?>">Country Code: </label>
						<input type="text" id="countrycode-<?php echo $id; ?>" name="countrycode" value="<?php echo $countrycode; ?>" required>

						<!-- District -->
						<label for="district-<?php echo $id; ?>">District: </label>
						<input type="text" id="district-<?php echo $id; ?>" name="district" value="<?php echo $district; ?>" required>

						<!-- Population -->
						<label for="population-<?php echo $id; ?>">Population: </label>
						<input type="text" id="population-<?php echo $id; ?>" name="population" value="<?php echo $population; ?>" required>
						<button>UPDATE</button>
					</form>
					<!-- Delete Form -->
					<form action="delete_record.php" method="POST" class="delete">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<button class="red">DELETE</button>
					</form>
				</section>
			<?php } else { ?>
				<p>Sorry, no results !</p>
			<?php } ?>
			<!-- Back to the Home Pgae -->
				<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Go to the Request Form</a>
		<?php } ?>
	</main>
</body>
</html>