<?php

$immagine = get_sub_field('immagine');
$immagine_posizione = get_sub_field('immagine_posizione');
$testo = get_sub_field('testo');

?>
<section>
    <div class="lavori-media-testoimmagine">

        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-<?php echo $immagine_posizione ?>">

                    <?php echo wp_get_attachment_image($immagine, '1920') ?>

                </div>
                <div class="col-lg-6">

                    <?php echo $testo ?>

                </div>
            </div>
        </div>

    </div>
</section>
