const CACHE_NAME = 'site-cache-v2'; // Increment this version whenever you want to clear old caches

self.addEventListener('install', (event) => {
    console.log('Service Worker: Installing...');
});

self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME]; // Keep only the current version
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Cache strategy for serving assets
self.addEventListener('fetch', (event) => {
    const url = new URL(event.request.url);
    // Check if the request is for a CSS or JS file
    if ((event.request.destination === 'style' || event.request.destination === 'script')
        && event.request.url.startsWith(self.location.origin)) {

        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                if (cachedResponse) {
                    console.log('Serving from cache:', event.request.url);
                    return cachedResponse;
                }

                return fetch(event.request).then((networkResponse) => {
                    return caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, networkResponse.clone());
                        console.log('Caching new resource:', event.request.url);
                        return networkResponse;
                    });
                });
            })
        );
    } else {
        // For other types of requests or unsupported schemes, bypass caching
        event.respondWith(fetch(event.request).catch(() => {
            return caches.match(event.request);
        }));
    }
});
