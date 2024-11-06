const CACHE_NAME = 'site-cache-v2'; // You can keep this for future use or remove it if not needed

self.addEventListener('install', (event) => {
    console.log('Service Worker: Installing...');
    // Skip waiting to activate the service worker immediately
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    console.log('Service Worker: Activated');
    // You can include logic to clean up old caches here, but we'll skip it for now
});

// Fetch event handler
self.addEventListener('fetch', (event) => {
    // console.log('Service Worker: Fetching', event.request.url);
    event.respondWith(
        // Just fetch from the network
        fetch(event.request).catch((error) => {
            console.error('Fetch failed; returning offline page instead.', error);
            // You can return a fallback page here if desired
            // return caches.match('/offline.html');
        })
    );
});
