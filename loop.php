<?php

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die("Geen ID");
	}
	include 'search.php';
	require_once 'db.php';
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$sql = 'SELECT * FROM `albumlist` WHERE `id` = '. $id;

	$q = $pdo->query($sql);
	$q->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<?php while ($r = $q->fetch()): ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="https://code.jquery.com/jquery-3.1.0.slim.min.js" integrity="sha256-cRpWjoSOw5KcyIOaZNo4i6fZ9tKPhYYb6i5T9RSVJG8=" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				$.ajax({
					url: "search.php"
				})
			});
		</script>
	</head>
	<body>
		<h1><?php echo htmlspecialchars($r['title']); ?> / <?php echo htmlspecialchars($r['artist']); ?></h1>
		<div id="search"></div>
	</body>
</html>
<?php endwhile; ?>
