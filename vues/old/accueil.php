<?php
	session_start();
    $size=$_SESSION['typoSize'];
    if(empty($_SESSION['typoSize'])){
		$size=1;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title> Accueil </title>
	<meta charset="UTF-8">
	<link href="style/style.css" rel="stylesheet" media="all" type="text/css"> 
	<script type='text/javascript' src='js/sizeTypo.js'></script>
</head>

<body>


	<?php echo "<p class='size'>$size</p>"; ?>
<script type="text/javascript">
			var elems = document.getElementsByClassName('size');
			elems[0].style.visibility = "hidden"; 
			var p = document.querySelector('.size').innerHTML;
			SizeTypo(p);
		</script>
	<div id="content">
		<a href="vues/creaPerso.php"> Nouvelle partie </a>
		<a href="vues/partie.php"> Charger partie </a>
		<a href="vues/options.php?param=<?php echo $size;?>">Options</a>
	</div>

	<script type="text/javascript">
		var size = document.querySelector('id');
		var p = document.querySelector('.size').innerHTML;
		SizeTypo(p);
	</script>

</body>

</html> 