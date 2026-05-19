const VAPID_PUBLIC_KEY = "BOiboAMs3AWXMq11QEwAGpzxWHLgMz09LQLXZ5UKQZs9pYW5VQJjRp5iODbWdDvVKXpLzMH6ScBPrGNn-OdvPE0";

// VAPID key'i Uint8Array'e çeviren fonksiyon
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    return Uint8Array.from([...rawData].map(c => c.charCodeAt(0)));
}

async function subscribeUser() {
    const reg = await navigator.serviceWorker.ready;

    // Mevcut aboneliği kontrol et
    let subscription = await reg.pushManager.getSubscription();
    if (!subscription) {
        // Yoksa Yeni abonelik oluştur
        const applicationServerKey = urlBase64ToUint8Array(VAPID_PUBLIC_KEY);
        subscription = await reg.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey
        });
    }

    // Data Oluştur
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();
    formData.append('data', JSON.stringify(subscription));
    formData.append('csrf_token', csrfToken);

    // Sunucuya gönder (cookie ile)
    await fetch("/notifications/subscribe", {
        method: "POST",
        credentials: "same-origin",
        body: formData
    });
}

if ("serviceWorker" in navigator && "PushManager" in window) {
    navigator.serviceWorker.register("/service-worker.js")
        .then(() => Notification.requestPermission())
        .then(permission => {
            if (permission === "granted") {
                subscribeUser();
            }
        });
}