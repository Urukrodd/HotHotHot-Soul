self.addEventListener('install', e => {
   e.waitUntil(
       caches.open("static").then(cache => {
           return cache.addAll([
               "./",
               "./static/css/tailwind.css",
               "./static/js/fontAwesome.js",
               "./static/js/jquery.js",
               "./static/js/index.js",
               "./static/img/hhh_logo_512.png",
               "./manifest.json",
               "./docs/index.html",
               "./docs/installation.html",
           ])
       })
   );
});

self.addEventListener('fetch', e => {
   e.respondWith(
       caches.match(e.request).then(response => {
           return fetch(e.request) || response;
       })
   );
});
