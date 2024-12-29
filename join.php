<?php
session_start();
$lang = $_SESSION['lang'] ?? 'es';

function __($key) {
    global $lang;
    $translations = [
        'es' => [
            'title' => 'Quiero unirme',
            'description' => 'Si eres un artista o banda y quieres unirte a Gonorrhea Records, completa el siguiente formulario.',
            'band_name' => 'Nombre de la banda',
            'musical_genre' => 'Género musical',
            'subgenre' => 'Subgénero',
            'email' => 'Correo electrónico',
            'about_band' => 'Acerca de mi banda',
            'music_links' => 'Enlaces a mi música',
            'services_required' => '¿Qué servicios requieres?',
            'cd_production' => 'Producción y distribución de CD',
            'digital_distribution' => 'Distribución digital',
            'both_services' => 'Ambos servicios',
            'submit' => 'Enviar solicitud',
            'success_message' => '¡Gracias por solicitar ser miembro de nuestro sello! Un miembro del equipo te contactará pronto.',
            'error_message' => 'Hubo un error al enviar tu solicitud. Por favor, inténtalo de nuevo.',
        ],
        'en' => [
            'title' => 'Join Us',
            'description' => 'If you\'re an artist or band and want to join Gonorrhea Records, fill out the form below.',
            'band_name' => 'Band name',
            'musical_genre' => 'Musical Genre',
            'subgenre' => 'Subgenre',
            'email' => 'Email',
            'about_band' => 'About my band',
            'music_links' => 'Links to my music',
            'services_required' => 'What services do you require?',
            'cd_production' => 'CD production & distribution',
            'digital_distribution' => 'Digital distribution',
            'both_services' => 'Both services',
            'submit' => 'Submit application',
            'success_message' => 'Thank you for applying to become a member of our label! A member of the team will contact you soon!',
            'error_message' => 'There was an error sending your application. Please try again.',
        ]
    ];
    return $translations[$lang][$key] ?? $key;
}

$genres = ['Goregrind', 'Grindcore', 'Death Metal', 'Noisegrind', 'Deathcore', 'Heavy Metal', 'Otro'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'emilianocisnero733@gmail.com';
    $subject = 'NEW BAND APPLICATION';
    
    $message = "Band Name: " . $_POST['band_name'] . "\n\n";
    $message .= "Musical Genre: " . implode(', ', $_POST['musical_genre']) . "\n\n";
    $message .= "Subgenre: " . $_POST['subgenre'] . "\n\n";
    $message .= "Email: " . $_POST['email'] . "\n\n";
    $message .= "About the band: " . $_POST['about_band'] . "\n\n";
    $message .= "Music links: " . $_POST['music_links'] . "\n\n";
    $message .= "Services required: " . $_POST['services_required'] . "\n\n";

    $headers = 'From: ' . $_POST['email'] . "\r\n" .
        'Reply-To: ' . $_POST['email'] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $success = mail($to, $subject, $message, $headers);
}
?>

<h1><?php echo __('title'); ?></h1>
<p><?php echo __('description'); ?></p>

<?php if (isset($success)): ?>
    <div class="alert alert-success text-center">
        <h4><?php echo __('success_message'); ?></h4>
    </div>
<?php else: ?>
    <form method="POST" action="" id="joinForm">
        <div class="mb-3">
            <label for="band_name" class="form-label"><?php echo __('band_name'); ?></label>
            <input type="text" class="form-control" id="band_name" name="band_name" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><?php echo __('musical_genre'); ?></label>
            <?php foreach ($genres as $genre): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="musical_genre[]" value="<?php echo $genre; ?>" id="genre_<?php echo $genre; ?>">
                    <label class="form-check-label" for="genre_<?php echo $genre; ?>"><?php echo $genre; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mb-3">
            <label for="subgenre" class="form-label"><?php echo __('subgenre'); ?></label>
            <input type="text" class="form-control" id="subgenre" name="subgenre" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label"><?php echo __('email'); ?></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
            <label for="about_band" class="form-label"><?php echo __('about_band'); ?></label>
            <textarea class="form-control" id="about_band" name="about_band" rows="3" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="music_links" class="form-label"><?php echo __('music_links'); ?></label>
            <input type="text" class="form-control" id="music_links" name="music_links" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><?php echo __('services_required'); ?></label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="services_required" id="cd_production" value="CD production & distribution" required>
                <label class="form-check-label" for="cd_production">
                    <?php echo __('cd_production'); ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="services_required" id="digital_distribution" value="Digital distribution">
                <label class="form-check-label" for="digital_distribution">
                    <?php echo __('digital_distribution'); ?>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="services_required" id="both_services" value="Both services">
                <label class="form-check-label" for="both_services">
                    <?php echo __('both_services'); ?>
                </label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary"><?php echo __('submit'); ?></button>
    </form>
<?php endif; ?>

<script>
$(document).ready(function() {
    $('input[name="musical_genre[]"]').on('change', function(e) {
        var checkedBoxes = $('input[name="musical_genre[]"]:checked');
        if (checkedBoxes.length > 3) {
            $(this).prop('checked', false);
        }
    });

    $('#joinForm').on('submit', function(e) {
        var checkedGenres = $('input[name="musical_genre[]"]:checked');
        if (checkedGenres.length === 0) {
            e.preventDefault();
            alert('Please select at least one musical genre.');
        }
    });
});
</script>

