<?php

/* Moi */
echo '<div id="me"><table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
for ($i = 'A'; $i < 'K'; $i++) {
    echo '<td class="cell coord">' . $i . '</td>';
}
echo '</tr>';
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        $_SESSION['partie']->getAllyGrid()->displayForm();
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
echo '<div id="ennemy"><table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
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
?>