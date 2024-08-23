self.addEventListener('install', function(event) {
  console.log("hola")
  event.waitUntil(
    caches.open('loginSalvatore')
      .then(function(cache) {  
        return cache.addAll([
          'index.php',
          'vendor/jquery/jquery-3.2.1.min.js',
          'vendor/animsition/js/animsition.min.js',    
          'vendor/bootstrap/js/popper.js',   
          'vendor/bootstrap/js/bootstrap.min.js',
          'vendor/select2/select2.min.js',
          'sw.js',
          'vendor/daterangepicker/moment.min.js', 
          'vendor/daterangepicker/daterangepicker.js', 
          'vendor/countdowntime/countdowntime.js',
          'js/main.js',
          'js/loguear.js', 
          '../localstorage/localstorage.js',
          'php/loguear.php',
          'vendor/bootstrap/css/bootstrap.min.css',
          'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
          'fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
          'vendor/animate/animate.css',
          'vendor/css-hamburgers/hamburgers.min.css',
          'vendor/select2/select2.min.css',
          'vendor/daterangepicker/daterangepicker.css',
          'css/util.css',
          'css/main.css',
          'images/bg-01.jpg',
          'vendor/animsition/css/animsition.min.css'
          // Agrega aquí los archivos que deseas almacenar en caché
        ]);
      })
  );
});


self.addEventListener('fetch', function(event) {
  // Verifica si la solicitud es para 'listarProductos.php' o 'listarIntegrantes.php'
  if (event.request.url.includes('loguear.php')) {
    event.respondWith(
      fetch(event.request)
        .then(function(response) {
          // Clona la respuesta para poder almacenarla en la caché y devolverla
          var clonedResponse = response.clone();
          caches.open('login')
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
