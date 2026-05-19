const CACHE_NAME = "my-cache-v1";

const OFFLINE_URL = "/offline";

const PRECACHE_URLS = [
    OFFLINE_URL,
    "/favicon.ico",
    "/manifest.json",
    "/static/icons/icon-192.png",
    "/static/icons/icon-512.png",
    "/static/css/hideScrollbar.css",
    "/static/css/tailwind.css",
    "/static/css/bootstrap-icons/bootstrap-icons.css",
    "/static/css/bootstrap-icons/fonts/bootstrap-icons.woff",
    "/static/css/bootstrap-icons/fonts/bootstrap-icons.woff2",
    "/static/js/addCsrfToken.js",
    "/static/js/hamburgerMenu.js",
    "/static/js/replaceWithFetch.js",
    "/static/js/sanitizeForm.js",
    "/static/js/swRegister.js",
    "/static/js/textareaAutoResize.js",
    "/static/js/togglePassword.js",
    "/static/defaults/categories/default.png",
    "/static/defaults/channels/default-avatar.png",
    "/static/defaults/channels/default-banner.png",
    "/static/defaults/playlists/default.png",
    "/static/defaults/videos/default.png",
    "/static/defaults/shorts/default.png",
    "/static/defaults/musics/default.png",
];

// Önbellekleme Yap
self.addEventListener("install", event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(PRECACHE_URLS))
    );
    self.skipWaiting();
});

// Önbelleklenmiş Eski Şeyleri Sil
self.addEventListener("activate", event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(
                keys.map(key => {
                    if (key !== CACHE_NAME) return caches.delete(key);
                })
            )
        )
    );
    self.clients.claim();
});

// Önbellekte varsa Getir, Yoksa Networkten Al, İnternet Yoksa Offline Sayfasını Getir
self.addEventListener("fetch", event => {
    // Get Harici Kabul Edilmez
    if (event.request.method !== "GET") {
        return;
    }
    // Cevap
    event.respondWith(
        caches.match(event.request).then(cachedResponse => {
            // Cache’de varsa onu döndür
            if (cachedResponse) {
                return cachedResponse;
            }
            // Yoksa network’e git
            return fetch(event.request).catch(() => {
                // İnternet Yoksa
                if (event.request.mode === "navigate") {
                    return caches.match(OFFLINE_URL);
                }
            });
        })
    );
});

// Bildirimleri Göster
self.addEventListener("push", event => {
    const data = event.data ? event.data.json() : {};
    const title = data.title || "Yeni Bildirim";
    const options = {
        body: data.body || "İçerik yok",
        icon: "/icons/icon-192.png",
        badge: "/icons/icon-192.png",
        data: {
            url: data.url || "/",
        }
    };
    event.waitUntil(self.registration.showNotification(title, options));
});

// Bildirimlere Tıklandığında
self.addEventListener("notificationclick", event => {
    // bildirimi kapat
    event.notification.close();
    // gerekli url'yi aç
    event.waitUntil(
        clients.matchAll({ type: "window", includeUncontrolled: true })
            .then(clientList => {
                // zaten açıksa ona odaklan (focus)
                for (const client of clientList) {
                    if (client.url === event.notification.data.url && 'focus' in client) {
                        return client.focus();
                    }
                }
                // Yoksa yeni pencere aç
                if (clients.openWindow) {
                    return clients.openWindow(event.notification.data.url);
                }
            })
    );
});