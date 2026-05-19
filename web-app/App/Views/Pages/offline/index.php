<!-- Layout -->
<?= $this->layout("Layouts/OfflineLayout") ?>

<!-- START CONTENT SECTION -->
<div class="flex flex-1 items-center justify-center">
    <div class="text-center">
        <div class="mt-4 flex flex-col items-center">
            <p class="text-xl font-semibold text-gray-700">İnternete bağlanın</p>
            <p class="text-gray-500 mb-6">İnternete bağlı değilsiniz. Bağlantınızı kontrol edin.</p>
        </div>

        <a href=""
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition-colors">
            Tekrar Dene
        </a>
    </div>
</div>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<script>
    async function checkInternetConnection() {
        try {
            const response = await fetch('/ping', {
                method: 'GET'
            });

            if (response.ok) {
                return true; // İnternete bağlı
            } else {
                return true; // Sunucuya bağlanılamadı
            }
        } catch (error) {
            return false; // Hata durumunda internet bağlantısı yok
        }
    }

    async function updateStatus() {
        const isConnected = await checkInternetConnection();
        if (isConnected) {
            if (new URL(window.location.href).pathname == "/offline") {
                window.location.href = "/";
            } else {
                window.location.reload();
            }
        }
    }

    window.addEventListener('online', updateStatus);
    window.addEventListener('offline', updateStatus);
    updateStatus();
</script>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->