
self.addEventListener('install', (event) => {
    console.log('Service Worker: Installing...');
    // Skip waiting to activate the service worker immediately
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    console.log('Service Worker: Activated');
    // Typically, cleanup logic for old caches would go here
});




self.addEventListener('fetch', (event) => {
    const url = new URL(event.request.url);

    // If the app is opened fresh, always redirect to the start_url
    if (!event.clientId && url.pathname === '/') {
        event.respondWith(Response.redirect('/ka/register'));
    } else {
        event.respondWith(fetch(event.request));
    }
});

// Save the current URL before the user leaves the app
window.addEventListener('beforeunload', () => {
    localStorage.setItem('lastVisitedPage', window.location.href);
});

// On app load, check the last page and logged-in status
document.addEventListener('DOMContentLoaded', () => {
    const isLoggedIn = Boolean(localStorage.getItem('authToken')); // Replace with your auth check
    const lastVisitedPage = localStorage.getItem('lastVisitedPage');

    if (isLoggedIn && lastVisitedPage && window.location.href !== lastVisitedPage) {
        window.location.href = lastVisitedPage;
    } else if (!isLoggedIn) {
        // Redirect to the login page or start_url
        window.location.href = '/login';
    }
});


