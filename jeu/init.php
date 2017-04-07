<?php
		$bd = 'L2IF26_BD';
		$user = 'L2IF26';
		$passwd = 'YHP5PNF';
		$machine = 'localhost';
	$connexion = mysqli_connect($machine, $user, $passwd, $bd);
	if(mysqli_connect_errno()) {
		printf("Echec de la connexion : \%s", mysqli_connect_error());
	}
?>