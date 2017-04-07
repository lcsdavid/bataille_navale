<?php
$connexion = mysqli_connect('localhost', 'L2IF26', 'YHP5PNF', 'L2IF26_BD');
if (mysqli_connect_errno()) {
    printf('Echec de la connexion : \%s', mysqli_connect_error());
}
?>