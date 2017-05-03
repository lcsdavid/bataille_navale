<div id="me">
    <table id="my-grid" class="grid">
        <tr>
            <td class="cell empty"></td>
            <td class="cell coord">A</td>
            <td class="cell coord">B</td>
            <td class="cell coord">C</td>
            <td class="cell coord">D</td>
            <td class="cell coord">E</td>
            <td class="cell coord">F</td>
            <td class="cell coord">G</td>
            <td class="cell coord">H</td>
            <td class="cell coord">I</td>
            <td class="cell coord">J</td>
        </tr>
        <?php
        if(isset($_SESSION['partie']))
            echo "lol";
            $_SESSION['partie']->getAllyGrid()->display();

        ?>
    </table>
</div>
<div id="cards">

</div>
<div id="ennemy">
    <table id="ennemy-grid" class="grid">
        <tr>
            <td class="cell empty"></td>
            <td class="cell coord">A</td>
            <td class="cell coord">B</td>
            <td class="cell coord">C</td>
            <td class="cell coord">D</td>
            <td class="cell coord">E</td>
            <td class="cell coord">F</td>
            <td class="cell coord">G</td>
            <td class="cell coord">H</td>
            <td class="cell coord">I</td>
            <td class="cell coord">J</td>
        </tr>
        <?php
        if(isset($_SESSION['partie']))
            echo "lol";
            $_SESSION['partie']->getEnnemyGrid()->display();

        ?>
    </table>
</div>