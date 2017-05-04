<?php

/* Moi */
echo '<div id="me"><span id="player">' . $_SESSION['partie']->getMyID() . '</span><table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
for ($i = 'A'; $i < 'K'; $i++) {
    echo '<td class="cell coord">' . $i . '</td>';
}
echo '</tr>';
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    case LAYVESSEL:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    case PLAYING:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    default:
        break;
}
echo '</table></div>';

/* Cartes */
echo '<div id="cards"></div>';
/* Ennemi */
echo '<div id="ennemy"><span id="player">' . $_SESSION['partie']->getOpponentID() . '</span><table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
for ($i = 'A'; $i < 'K'; $i++) {
    echo '<td class="cell coord">' . $i . '</td>';
}
echo '</tr>';
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    case LAYVESSEL:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    case PLAYING:
        if($_SESSION['partie'])
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    default:
        break;
}
echo '</table></div>';
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        echo "En attente des joueurs";
        break;
    case LAYVESSEL:

        break;
    case PLAYING:
        echo "Partie en cours";
        break;
    default:
        break;
}
?>