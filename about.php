<?php
session_start();
$lang = $_SESSION['lang'] ?? 'es';

function __($key) {
    global $lang;
    $translations = [
        'es' => [
            'title' => 'Sobre Nosotros',
            'join_us' => 'Únete a nosotros',
        ],
        'en' => [
            'title' => 'About Us',
            'join_us' => 'Join us',
        ]
    ];
    return $translations[$lang][$key] ?? $key;
}
?>

<div class="container my-5">
    <h1 class="text-center mb-5"><?php echo __('title'); ?></h1>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-4">Let's explain how we work!</h2>
                    
                    <h3 class="text-primary mb-3">WE OFFER:</h3>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">Production & distribution of CD Jewel Case!</li>
                        <li class="list-group-item">Digital distribution on all platforms!</li>
                        <li class="list-group-item">You can opt for one or both forms of distribution!</li>
                    </ul>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4 class="text-primary">Distribution of CD:</h4>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We calculate the cost</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We produce it</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We sell it</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We prepare it</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We ship it</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>You receive your money</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-primary">Digital distribution:</h4>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>You pay nothing</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We rectify your album</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We distribute it</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We give you YouTube Content ID for free</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>We share the rights</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>You get the majority of what is generated</li>
                            </ul>
                        </div>
                    </div>
                    
                    <h4 class="text-primary mb-3">Main digital platforms we use through Amuse Pro for Digital distribution:</h4>
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-wrap justify-content-around align-items-center">
                            <img src="spotify-logo.png" alt="Spotify" class="m-2" style="height: 40px;">
                            <img src="facebook-logo.png" alt="Facebook" class="m-2" style="height: 40px;">
                            <img src="instagram-logo.png" alt="Instagram" class="m-2" style="height: 40px;">
                            <img src="tiktok-logo.png" alt="TikTok" class="m-2" style="height: 40px;">
                            <img src="apple-music-logo.png" alt="Apple Music" class="m-2" style="height: 40px;">
                            <img src="youtube-music-logo.png" alt="YouTube Music" class="m-2" style="height: 40px;">
                            <img src="amazon-music-logo.png" alt="Amazon Music" class="m-2" style="height: 40px;">
                            <img src="claro-musica-logo.png" alt="Claro Música" class="m-2" style="height: 40px;">
                            <img src="audiomack-logo.png" alt="Audiomack" class="m-2" style="height: 40px;">
                            <img src="pandora-logo.png" alt="Pandora" class="m-2" style="height: 40px;">
                            <img src="deezer-logo.png" alt="Deezer" class="m-2" style="height: 40px;">
                            <img src="boomplay-logo.png" alt="Boomplay" class="m-2" style="height: 40px;">
                        </div>
                    </div>
                    <p class="text-center font-italic">AND MUCH MORE!</p>
                    
                    <h3 class="text-primary mb-3">IMPORTANT:</h3>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">We don't work with contracts, signatures or exclusivity, that means you can work with as many labels as you want! And if you want to leave us, you can!</li>
                        <li class="list-group-item">If you want digitally distribute yourself an album we have already uploaded, we will send you the ISRC and UPC code of your music!</li>
                        <li class="list-group-item">If you want us to stop selling your CDs, we'll do it right away!</li>
                    </ul>
                    
                    <div class="text-center mt-5">
                        <h4 class="mb-3">Ready to join us?</h4>
                        <a href="join.php" class="btn btn-primary btn-lg"><?php echo __('join_us'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

