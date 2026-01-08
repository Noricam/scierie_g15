<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Scierie Gineste - Vidéo</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	</head>

	<body>
<?php include("includes/menu.php"); // Optimisation : inclusion du menu centralisé ?>

		<main>
			<div style="text-align: center; width: 100%; padding: 20px;">
				<h1>Présentation de la Scierie</h1>
				
				<div class="video-responsive-container">
					<iframe 
						class="video-iframe"
						src="https://www.youtube.com/embed/dbHXPnhCicI?autoplay=1&mute=1" 
						title="YouTube video player" 
						frameborder="0" 
						allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
						allowfullscreen>
					</iframe>
				</div>
			</div>
		</main>

<?php include("includes/footer.php"); // Optimisation : inclusion du pied de page ?>
	</body>
</html>
