<h1>Ajouter</h1>
<h1>Supprimer</h1>

Seuil de température    : de <?php  
        echo $seuilTemp['minimum'];
        echo " à ";
        echo $seuilTemp['maximum'];
        echo " °C";
        ?></br>
        Seuil de turbilité      : <?php  
        echo $seuilTurb['minimum'];
        echo " à ";
        echo $seuilTurb['maximum'];
        echo " NTU";
        ?></br>
        Seuil de chlore         : <?php  
        echo $seuilORP['minimum'];
        echo " à ";
        echo $seuilORP['maximum'];
        echo " mg/L";
        ?></br>
    </p>

    <button class='blue_button' onclick="window.location.href='index.php?page=change_alerts'">Modifier</button>

</div>