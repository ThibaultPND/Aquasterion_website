<h2>Modifier</h2>
<form action="<?=BASE_URL?>/alerts/modify" method="post">
<table border="2">
        <thead>
            <tr>
                <th>Donnée du seuil</th>
                <th>Type dopération</th>
                <th>Valeur</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['alertsLimits'])): ?>
                <?php foreach ($data['alertsLimits'] as $limit): ?>
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
                            <select name="limits[<?= $limit['Limite_ID'] ?>][data_name]" required>
                                <option value="TEMP" <?= $limit['Data_Name'] == 'TEMP' ? 'selected' : ''; ?>>Température (°C)</option>
                                <option value="ORP" <?= $limit['Data_Name'] == 'ORP' ? 'selected' : ''; ?>>ORP (mV)</option>
                                <option value="TURB" <?= $limit['Data_Name'] == 'TURB' ? 'selected' : ''; ?>>Turbidité (NTU)</option>
                                <option value="PH" <?= $limit['Data_Name'] == 'PH' ? 'selected' : ''; ?>>pH</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" name="limits[<?= $limit['Limite_ID'] ?>][action]" value="delete">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun seuil d'alerte.</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="4">
                    <button type="submit" name="add_limit">Ajouter une nouveau seuil</button>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <button type="submit">Enregistrer les modifications</button>
</form>