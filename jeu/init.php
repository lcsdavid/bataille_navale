<?php
$connexion = mysqli_connect('localhost', 'L2IF26', 'YHP5PNF', 'L2IF26_DB');
if (mysqli_connect_errno()) {
    echo '<div id="announcements-container-wrapper"><div id="announcements-container"><span id="announcements-container-message">';
    printf('Echec de la connexion : \%s', mysqli_connect_error());
    echo '</span><div id="announcements-container-button"><button class="close-txt-thik" onclick="getElementById(\'announcements-container-wrapper\').remove();"></div></div></div>';
}








?>