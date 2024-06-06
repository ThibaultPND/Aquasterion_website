<head>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<div>
    <h1>Changer le mode de fonctionnement de la pompe</h1>
    <form action="<?= BASE_URL ?>/pump/mode" method="POST">
        <label for="mode">Mode</label>
        <select name="mode" id="mode">
            <option value="automatique" <?= $data['current_mode'] == 'auto' ? 'selected' : '' ?>>Automatique</option>
            <option value="manuel" <?= $data['current_mode'] == 'manuel' ? 'selected' : '' ?>>Manuel</option>
        </select><br><br>

        <div id="state-container">
            <label for="state">État:</label>
            <select id="state" name="state" required>
                <option value="on" <?= ($data['current_state'] == 'on') ? 'selected' : '' ?>>Activé</option>
                <option value="off" <?= ($data['current_state'] == 'off') ? 'selected' : '' ?>>Désactivé</option>
            </select><br><br>
        </div>

        <input type="submit" value="Changer le mode">
    </form>
    <script>
        document.getElementById('mode').addEventListener('change', function () {
            const mode = this.value;
            const stateContainer = document.getElementById('state-container');

            if (mode === 'automatique') {
                stateContainer.classList.add('hidden');
            } else {
                stateContainer.classList.remove('hidden');
            }
        });

        // Initialiser l'état au chargement de la page
        window.addEventListener('load', function () {
            const mode = document.getElementById('mode').value;
            const stateContainer = document.getElementById('state-container');

            if (mode === 'automatique') {
                stateContainer.classList.add('hidden');
            }
        });
    </script>
    </form>
</div>