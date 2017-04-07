<?php
	require_once(init.php);
	if(isset($connexion)) {
		mysqli_close($connexion);
	}
?>