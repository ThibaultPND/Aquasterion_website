<div class="'tab-content">
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Donnée</th>
            <th>Valeur</th>
        </tr>
        <?php
        while ($row = $data['history']->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $row['date_mesure'] ?></td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['valeur'] ?></td>
            </tr>
            <?php
        } 
        ?>
    </table>
</div>