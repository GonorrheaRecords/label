<?php
session_start();
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'es';
$_SESSION['lang'] = $lang;

// Función simple de traducción
function __($key) {
    global $lang;
    $translations = [
        'es' => [
            'title' => 'Gonorrhea Records',
            'nav_bulk' => 'Comprar CDs en cantidad',
            'nav_single' => 'Comprar CD individual',
            'nav_join' => 'Quiero unirme',
            'nav_about' => 'Sobre Nosotros',
            'slide1_caption' => 'Bienvenido a Gonorrhea Records',
            'slide2_caption' => 'Descubre nuestra música',
            'slide3_caption' => 'Únete a nuestra comunidad',
        ],
        'en' => [
            'title' => 'Gonorrhea Records',
            'nav_bulk' => 'Buy CDs in Bulk',
            'nav_single' => 'Buy Single CD',
            'nav_join' => 'Join Us',
            'nav_about' => 'About Us',
            'slide1_caption' => 'Welcome to Gonorrhea Records',
            'slide2_caption' => 'Discover our music',
            'slide3_caption' => 'Join our community',
        ]
    ];
    return $translations[$lang][$key] ?? $key;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><?php echo __('title'); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="bulk-cds"><?php echo __('nav_bulk'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="single-cd"><?php echo __('nav_single'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="join"><?php echo __('nav_join'); ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="about"><?php echo __('nav_about'); ?></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?lang=es">ES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?lang=en">EN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image1.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo __('slide1_caption'); ?></h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo __('slide2_caption'); ?></h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image3.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo __('slide3_caption'); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div id="content">
            <!-- El contenido se cargará aquí dinámicamente -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Configurar el carrusel
            $('#imageCarousel').carousel({
                interval: 3000
            });

            // Cargar la página inicial
            loadPage('bulk-cds');

            // Manejar clics en los enlaces de navegación
            $('a[data-page]').click(function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                loadPage(page);
            });

            function loadPage(page) {
                $.ajax({
                    url: page + '.php',
                    type: 'GET',
                    success: function(data) {
                        $('#content').html(data);
                    },
                    error: function() {
                        $('#content').html('<p>Error al cargar la página.</p>');
                    }
                });
            }
        });
    </script>
</body>
</html>

