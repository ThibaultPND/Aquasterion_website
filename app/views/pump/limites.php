<h2>Modifier les limites de seuil de la pompe</h2>
<form action="<?=BASE_URL?>/pump/limites" method="post">
    <table border="2">
        <thead>
            <tr>
                <th>Nom de la limite</th>
                <th>Type de donnée</th>
                <th>Valeur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['pumpLimits'])): ?>
                <?php foreach ($data['pumpLimits'] as $limit): ?>
                    <tr>
                        <td>
                            <select name="limits[<?= $limit['Limite_ID'] ?>][data_name]" required>
                                <option value="TEMP" <?= $limit['Data_Name'] == 'TEMP' ? 'selected' : ''; ?>>Température (°C)</option>
                                <option value="ORP" <?= $limit['Data_Name'] == 'ORP' ? 'selected' : ''; ?>>ORP (mV)</option>
                                <option value="TURB" <?= $limit['Data_Name'] == 'TURB' ? 'selected' : ''; ?>>Turbidité (NTU)</option>
                                <option value="PH" <?= $limit['Data_Name'] == 'PH' ? 'selected' : ''; ?>>pH</option>
                            </select>
                        </td>
                        <td>
                            <select name="limits[<?= $limit['Limite_ID'] ?>][limite_name]" required>
                                <option value="min" <?= $limit['limite_name'] == 'min' ? 'selected' : '' ?>>Inférieur à</option>
                                <option value="max" <?= $limit['limite_name'] == 'max' ? 'selected' : '' ?>>Suppérieur à</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="limits[<?= $limit['Limite_ID'] ?>][data_type]" value="<?= $limit['Data_Type'] ?>" required>
                        </td>
                        <td>
                            <button type="submit" name="limits[<?= $limit['Limite_ID'] ?>][action]" value="delete">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucune limite de seuil trouvée pour cette pompe.</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="4">
                    <button type="submit" name="add_limit">Ajouter une nouvelle limite</button>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>
