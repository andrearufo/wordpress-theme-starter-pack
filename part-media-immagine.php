<?php

$immagine = get_sub_field('file');
$visualizzazione = get_sub_field('visualizzazione');

$container = 'container';
if ($visualizzazione == 'full') $container = 'fullscreen';
elseif ($visualizzazione == 'fluid') $container = 'container-fluid';

?>
<section>
    <div class="lavori-media-immagine">

        <div class="<?php echo $container ?>">
            <?php echo wp_get_attachment_image($immagine, '1920') ?>
        </div>

    </div>
</section>
