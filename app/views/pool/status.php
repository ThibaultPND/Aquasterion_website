<div class="tab-content">
    <h2>Statut de la Piscine</h2>
    <div class="pool-status">
        <div class="data-item">
            <div class="data-label"><b>Heure de mesure</b></div>
            <div class="data-value"><?= $data['DATE'] ?></div>
        </div>
        <br>
        <div class="data-item">
            <div class="data-label"><b>Acidité</b></div>
            <div class="data-value"><?= $data['PH'] ?> pH</div>
        </div>
        <div class="data-item">
            <div class="data-label"><b>Température</b></div>
            <div class="data-value"><?= $data['TEMP'] ?>°C</div>
        </div>
        <div class="data-item">
            <div class="data-label"><b>Turbidité</b></div>
            <div class="data-value"><?= $data['TURB'] ?> NTU</div>
        </div>
        <div class="data-item">
            <div class="data-label"><b>Oxydoréduction</b></div>
            <div class="data-value"><?= $data['ORP'] ?> mV</div>
        </div>
        <form action="status">
            <button id="updateButton">Update</button>
        </form>

    </div>
    <script>
        // Créer une connexion WebSocket
        const ws = new WebSocket("ws://192.168.0.71:8080");

        // Gérer l'ouverture de la connexion WebSocket
        ws.addEventListener("open", function (event) {
            console.log("WebSocket connection established.");
        });

        // Gérer les erreurs de connexion WebSocket
        ws.addEventListener("error", function (event) {
            console.error("WebSocket connection error:", event);
        });

        // Gérer les clics sur le bouton "Update"
        document.getElementById("updateButton").addEventListener("click", function () {
            // Vérifier si la connexion WebSocket est ouverte
            if (ws.readyState === WebSocket.OPEN) {
                // Envoyer le message "updateValues" au serveur WebSocket
                ws.send("updateValues");
                console.log("Message 'updateValues' sent to server.");
            } else {
                console.error("WebSocket connection is not open." + WebSocket);
            }
        });
    </script>
</div>