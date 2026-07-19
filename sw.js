// Service Worker for Bohol Island Tours PWA
// Network-first: always try fresh content, fall back to cache when offline.
const CACHE_NAME = 'bohol-island-tours-pwa-v2';
const urlsToCache = [
  '/',
  '/index.php',
  '/assets/css/theme.css',
  '/assets/js/theme.js',
  '/script.js',
  '/manifest.json'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll(urlsToCache);
      })
      .catch((error) => {
        console.log('Cache install failed:', error);
      })
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            console.log('Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  return self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') {
    return;
  }

  // Always go to the network for API calls — never cache them.
  if (event.request.url.includes('/api/') || event.request.url.includes('/admin/')) {
    return;
  }

  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // Cache a copy of successful same-origin responses for offline use.
        if (response && response.status === 200 && response.type === 'basic') {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return response;
      })
      .catch(() => {
        // Network failed — serve from cache if available.
        return caches.match(event.request).then((cached) => {
          if (cached) {
            return cached;
          }
          if (event.request.destination === 'document') {
            return caches.match('/index.php');
          }
        });
      })
  );
});
