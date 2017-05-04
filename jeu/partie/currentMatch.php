<?php
/* Déroulement partie */
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        $_SESSION['partie']->checkWait();
        break;
    case LAYVESSEL:
        break;
    case PLAYING:
        break;
    default:
        break;
}

/* Moi */
echo '<div id="me">' . echoID($_SESSION["partie"]->getAllyGrid()->getIDJoueur()) . '<table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
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
echo '<div id="ennemy">' . echoID($_SESSION['partie']->getEnnemyGrid()->getIDJoueur()) . '<table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
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
        if ($_SESSION['partie'])
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
        echo "Posez les bateaux";
        break;
    case PLAYING:
        echo "Partie en cours";
        break;
    default:
        break;
}
echo '</div>';
?>