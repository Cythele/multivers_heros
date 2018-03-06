<?php
	session_start();
	$_SESSION['typoSize']=1;
?>
</head>
	<link href="style/style.css" rel="stylesheet" media="all" type="text/css">
	<script type='text/javascript' src='../js/sizeTypo.js'></script>
</head>
<body>
	<div id="content">

		<?php
			echo '<a href="options.php?param=1"> Petite typo </a> <br>';
			echo '<a href="options.php?param=2"> Moyenne </a> <br>';
			echo '<a href="options.php?param=3"> Grande typo </a> <br>';
			if (isset($_GET['param'])) {
	    		$_SESSION['typoSize']=$_GET['param'];
			}
			echo "la valeur dans la session :".$_SESSION['typoSize']=$_GET['param'];
		?>
		<a href="../index.php"> Retours accueil </a>

		<script type="text/javascript">
	  		var size = "<?php echo $_SESSION['typoSize'] ?>";
			SizeTypo(size);
		</script>

	</div>
</body>
