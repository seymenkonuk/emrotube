<!-- Video Detay Kartı -->
<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 hover:border-blue-400 transition duration-300 p-6 space-y-4 max-w-2xl mx-auto">

    <!-- Video Başlık -->
    <h1 class="text-2xl font-extrabold text-gray-900">
        Video Başlığı Buraya Gelecek
    </h1>

    <!-- Kanal Bilgisi -->
    <div class="flex items-center justify-between">
        <!-- Kanal Linki -->
        <a href="/kanal/kanal-adi" class="flex items-center space-x-3 group">
            <img src="https://i.ytimg.com/vi/abc123/hqdefault.jpg" alt="Kanal Resmi"
                class="w-12 h-12 rounded-full border border-gray-300 group-hover:scale-105 transition" />
            <div>
                <p class="font-semibold text-gray-800 group-hover:text-blue-600 transition">Kanal Adı</p>
                <p class="text-sm text-gray-500">1.2M Abone</p>
            </div>
        </a>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition-colors">
            Abone Ol
        </button>
    </div>

    <!-- İstatistikler -->
    <div class="flex items-center space-x-6 text-gray-600 text-sm">
        <p><i class="bi bi-eye"></i> 25.3K görüntülenme</p>
        <p><i class="bi bi-clock"></i> 2 gün önce</p>
    </div>

    <!-- Aksiyon Butonları -->
    <div class="flex items-center space-x-4">
        <button
            class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-3 py-2 rounded-lg transition">
            <i class="bi bi-hand-thumbs-up"></i>
            <span>1.2K</span>
        </button>
        <button
            class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-3 py-2 rounded-lg transition">
            <i class="bi bi-hand-thumbs-down"></i>
        </button>
        <button
            class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-3 py-2 rounded-lg transition">
            <i class="bi bi-share"></i>
            <span>Paylaş</span>
        </button>
        <button
            class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-3 py-2 rounded-lg transition">
            <i class="bi bi-save"></i>
            <span>Kaydet</span>
        </button>
    </div>
</div>

<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 hover:border-blue-400 transition duration-300 p-6 space-y-4 max-w-2xl mx-auto">

    <h1>Açıklama</h1>

    <!-- Video Açıklama (Açılır Kapanır) -->
    <p id="videoDescription" class="text-gray-700 text-sm line-clamp-3 transition-all duration-300 overflow-hidden">
        Bu videoda React ile video kart tasarımı yapıyoruz. Ayrıca Tailwind CSS ile
        modern ve duyarlı bir görünüm elde ediyoruz. Kanalda web geliştirme, tasarım
        ve frontend teknolojileriyle ilgili birçok eğitim videosu bulabilirsiniz.
        Daha fazla içerik için abone olmayı unutmayın!
    </p>

    <button id="toggleButton"
        class="mt-2 text-blue-600 hover:text-blue-800 font-semibold text-sm focus:outline-none transition">
        Daha fazla göster
    </button>
</div>

<!-- Aç/Kapat JS -->
<script>
    const toggleBtn = document.getElementById('toggleButton');
    const desc = document.getElementById('videoDescription');
    let expanded = false;

    toggleBtn.addEventListener('click', () => {
        expanded = !expanded;
        if (expanded) {
            desc.classList.remove('line-clamp-3');
            desc.classList.add('max-h-[1000px]');
            toggleBtn.textContent = 'Daha az göster';
        } else {
            desc.classList.add('line-clamp-3');
            desc.classList.remove('max-h-[1000px]');
            toggleBtn.textContent = 'Daha fazla göster';
        }
    });
</script>