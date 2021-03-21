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

self.addEventListener('fetch', function(event) {
    event.respondWith(
        // Try the network
        fetch(event.request)
            .then(function(res) {
                return caches.open('static')
                    .then(function(cache) {
                        // Put in cache if succeeds
                        cache.put(event.request.url, res.clone());
                        return res;
                    })
            })
            .catch(function(err) {
                // Fallback to cache
                return caches.match(event.request)
                    .then(function(res){
                        if (res === undefined) {
                            // get and return the offline page
                        }
                        return res;
                    })
            })
    );
});
