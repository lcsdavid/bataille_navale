<?php
$rset = mysqli_query($connexion, "SELECT id_joueur FROM Joueur");
for ($i = 0; $i < $rset->field_count; $i++) {
    $row = $rset->fetch_row();
    echo $row;
}
?>