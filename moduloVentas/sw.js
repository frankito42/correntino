//ver 1
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open('aplicacionVentas')
      .then(function(cache) {  
        return cache.addAll([
          'ventas.php?v=active',
          'no-wifi.png',
          '../mdb/css/bootstrap.min.css',    
          '../mdb/css/mdb.min.css',   
          '../mdb/css/all.min.css',
          'lib/toastr.min.css',
          'sw.js',
          '../mdb/js/jquery.min.js', 
          '../mdb/js/popper.min.js', 
          '../mdb/js/bootstrap.min.js',
          '../mdb/js/mdb.min.js',
          '../mdb/js/all.min.js', 
          '../localstorage/localstorage.js',
          'lib/toastr.min.js',
          'script.js',
          'php/listarProductos.php?idEsta=1',
          'php/cargarArticulo.php',
          'php/listarClientes.php',
          'php/ultimoTicket.php',
          '../moduloTicket/imp11.php',
          'js/ventas.js'
          // Agrega aquí los archivos que deseas almacenar en caché
        ]);
      })
  );
});


self.addEventListener('fetch', function(event) {
  // Verifica si la solicitud es para 'listarProductos.php' o 'listarClientes.php'
  if (event.request.url.includes('listarProductos.php') || event.request.url.includes('listarClientes.php')) {
    event.respondWith(
      fetch(event.request)
        .then(function(response) {
          // Clona la respuesta para poder almacenarla en la caché y devolverla
          var clonedResponse = response.clone();
          caches.open('aplicacionVentas')
            .then(function(cache) {
              cache.put(event.request, clonedResponse);
            });
          return response;
        })
        .catch(function() {
          return caches.match(event.request); // Devuelve la respuesta almacenada en caché si la solicitud de red falla
        })
    );
  } else {
    // Para otras solicitudes, busca en la caché primero y luego realiza la solicitud de red si no está en la caché
    event.respondWith(
      caches.match(event.request)
        .then(function(response) {
          return response || fetch(event.request);
        })
    );
  }
});
