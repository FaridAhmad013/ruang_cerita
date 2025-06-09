var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    // '/css/app.css',
    // '/js/app.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',

    '/assets/vendor/jquery/dist/jquery.min.js',
    '/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
    '/assets/vendor/js-cookie/js.cookie.js',
    '/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js',
    '/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js',
    '/assets/vendor/chart.js/dist/Chart.min.js',
    '/assets/vendor/chart.js/dist/Chart.extension.js',
    '/assets/vendor/datatables.net/js/jquery.dataTables.min.js',
    '/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
    '/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
    '/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
    '/js/jszip.js',
    '/js/colvis.js',
    '/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js',
    '/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js',
    '/assets/vendor/datatables.net-buttons/js/buttons.print.min.js',
    '/assets/vendor/datatables.net-select/js/dataTables.select.min.js',
    '/assets/vendor/datatable-extensions/dataTables.fixedColumns.min.js',
    '/assets/vendor/select2/dist/js/select2.min.js',
    '/assets/vendor/sweetalert2/dist/sweetalert2.min.js',
    '/assets/vendor/jquery-block-ui/jquery-block-ui.js',
    '/js/autoNumeric.js',
    '/js/numeral.js',
    '/assets/vendor/summernote/summernote-bs4.min.js',
    '/assets/vendor/flatpickr/flatpickr.js',
    '/assets/vendor/datatables-buttons-excel-styles/buttons.html5.styles.min.js',
    '/assets/vendor/datatables-buttons-excel-styles/buttons.html5.styles.templates.min.js',
    '/assets/vendor/datatables-selected-box/dataTables.checkboxes.min.js',
    '/js/datatables-language.js',
    '/js/datatables-searchbuilder.min.js',
    '/js/datatables-datetime.min.js',
    '/js/moment.min.js',
    '/js/datetime-moment.js',
    '/assets/vendor/wizard/jquery.steps.min.js',
    '/assets/vendor/wizard/bd-wizard.js',
    '/js/apexcharts/apexcharts.js',
    '/assets/vendor/noty/noty.js',
    '/assets/js/argon.js',

    '/assets/vendor/nucleo/css/nucleo.css',
    '/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css',
    '/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    '/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
    '/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css',
    '/assets/vendor/datatable-extensions/fixedColumns.bootstrap4.min.css',
    '/assets/vendor/select2/dist/css/select2.min.css',
    '/assets/vendor/sweetalert2/dist/sweetalert2.min.css',
    '/css/scrollbar.css',
    '/assets/vendor/wizard/bd-wizard.css',
    '/assets/vendor/wizard/materialdesignicons.min.css',
    '/css/apexcharts/apexcharts.css',
    '/assets/vendor/summernote/summernote-bs4.min.css',
    '/assets/css/argon.css',
    '/css/datatables-searchbuilder.min.css',
    '/css/datatables-datetime.min.css',
    '/assets/vendor/flatpickr/flatpickr.min.css',
    '/assets/vendor/flatpickr/material_blue.css',
    '/assets/vendor/noty/noty.css'
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});