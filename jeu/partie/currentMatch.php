<?php
/* Déroulement partie */
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        if(!$_SESSION['partie']->isWaiting()) {
            $_SESSION['partie']->setEnnemyGrid();
            $_SESSION['partie']->setState(LAYVESSEL);
        }
        break;
    case LAYVESSEL:
        $_SESSION['partie']->getAllyGrid()->displayForm();
        break;
    case PLAYING:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    default:
        break;
}

/* Moi */
echo '<div id="me"><span id="player">' . $_SESSION['partie']->getAllyGrid()->getIDJoueur() . '</span><table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
for ($i = 'A'; $i < 'K'; $i++) {
    echo '<td class="cell coord">' . $i . '</td>';
}
echo '</tr>';
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        $_SESSION['partie']->getAllyGrid()->display();
        break;
    case LAYVESSEL:
        $_SESSION['partie']->getAllyGrid()->displayForm();
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
echo '<div id="ennemy"><span id="player">' . $_SESSION['partie']->getEnnemyGrid()->getIDJoueur() . '</span><table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
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
echo '<div class="bottom">';
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
echo '</div>';
?>