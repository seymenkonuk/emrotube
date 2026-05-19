<!-- Yorum Yap Kartı -->
<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 hover:border-blue-400 transition-shadow duration-300 flex flex-col p-4 space-y-3">

    <!-- Üst Kısım: Profil + Yazma Alanı -->
    <div class="flex items-start space-x-3">
        <!-- Kullanıcı Fotoğrafı -->
        <a href="/channel/1" class="flex-shrink-0">
            <img src="https://i.ytimg.com/vi/abc123/hqdefault.jpg" alt="Kullanıcı"
                class="w-10 h-10 rounded-full object-cover">
        </a>

        <!-- Yazma Alanı -->
        <textarea id="commentInput" rows="1" placeholder="Yorum ekleyin..."
            class="flex-1 resize-none overflow-hidden bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
    </div>

    <!-- Alt Kısım: Butonlar -->
    <div class="flex justify-end space-x-2">
        <button class="px-4 py-1 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium">
            İptal
        </button>
        <button
            class="px-4 py-1 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium flex items-center space-x-1">
            <i class="bi bi-send-fill"></i>
            <span>Paylaş</span>
        </button>
    </div>
</div>

<!-- JS: Yazdıkça textarea büyüsün -->
<script>
    const textarea = document.getElementById("commentInput");
    textarea.addEventListener("input", function() {
        this.style.height = "auto"; // Önce sıfırla
        this.style.height = this.scrollHeight + "px"; // İçeriğe göre yükseklik ver
    });
</script>