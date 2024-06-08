<h2>Modifier</h2>
<form action="<?= BASE_URL ?>/alerts/modify" method="post">
    <table border="2">
        <thead>
            <tr>
                <th>Paramètre</th>
                <th>Opération</th>
                <th>Valeur</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['alertsLimits'])): ?>
                <?php foreach ($data['alertsLimits'] as $limit): ?>
                    <tr>
                        <td>
                            <?= $limit['param_nom'] ?>
                        </td>
                        <td>
                            <?= ($limit['Limit_Type'] == 'min') ? '<' : '>' ?>
                        </td>
                        <td>
                            <input type="number" name="limits[<?= $limit['Limite_ID'] ?>][Valeur]"
                                value="<?= $limit['Valeur'] ?>" required>
                        </td>
                        <td>
                            <?= $limit['message'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun seuil d'alerte.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>