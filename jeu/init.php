<?php
$connexion = mysqli_connect('localhost', 'L2IF26', 'YHP5PNF', 'L2IF26_BD');
if (mysqli_connect_errno()) {
    echo '<div id="announcements-container-wrapper"><div id="announcements-container-inner"><span id="announcements-container-message">';
    printf('Echec de la connexion : \%s', mysqli_connect_error());
    echo '</span><div clear:both></div><div id="announcements-container-button"><button class="cross" onclick="getElementById(\'announcements-container\').remove();"></div></div></div></div>';
}








?>