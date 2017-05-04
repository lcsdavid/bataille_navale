<?php
/* Déroulement partie, partie code */
switch ($_SESSION['partie']->getState()) {
    case WAITING:
        echo "Wait";
        echo $_SESSION['partie']->getIDPartie();
        $_SESSION['partie']->checkWait();
        break;
    case LAYVESSEL:
        if (isset($_POST['vessel']))
            $_SESSION['vessel'] = $_POST['vessel'];
        if(isset($_POST['orientation']))
            $_SESSION['orientation'] = $_POST['orientation'];
        if(isset($_POST['click'])) {
            if(isset($_SESSION['vessel']) && isset($_SESSION['orientation']))
                $_SESSION['partie']->layVessel($_SESSION['vessel'], $_POST['cell'], $_SESSION['orientation']);
        }
        break;
    case WAITENNEMYLAYVESSEL:
        $_SESSION['partie']->setState(LAYVESSEL);
        break;
    case PLAYING:
        break;
    default:
        break;
}

print_r($_POST);

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
        if ($_SESSION['partie']->myTurn())
            $_SESSION['partie']->getAllyGrid()->displayForm();
        else
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
        echo $_SESSION['partie']->formVessel();
        if (isset($_SESSION['orientation'])) {
            echo "<form class='orientation' method='POST' action='./'>";
            echo "<span>".$_SESSION['orientation']." est selectionné. Pour changer: </span>";
            if ($_SESSION['orientation'] == "horizontal")
                echo "<input type='submit' name='orientation' value='vertical'></form>";
            else
                echo "<input type='submit' name='orientation' value='horizontal'></form>";
        } else {
            echo "<form class='orientation' method='POST' action='./'>";
            echo "<span>Choissisez l'orientation du bateau: </span>";
            echo "<input type='submit' name='orientation' value='horizontal'>";
            echo "<input type='submit' name='orientation' value='vertical'></form>";
        }
        break;
    case PLAYING:
        echo "Partie en cours";
        if ($_SESSION['partie']->myTurn())
            echo "C'est votre tour !";
        else
            echo "C'est le tour de l'adversaire !";
        break;
    default:
        break;
}
echo '</div>';
?>