<?php

$immagini = get_sub_field('immagini');
$visualizzazione = get_sub_field('visualizzazione');

?>
<section>
    <div class="lavori-media-galleria">

        <?php if ($visualizzazione == 'center'): ?>

            <div class="lavori-media-galleria-list lavori-media-galleria-list-center">
                <?php foreach ($immagini as $immagine): ?>

                    <div class="lavori-media-galleria-list-item">
                        <?php echo wp_get_attachment_image($immagine, '1200'); ?>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php elseif ($visualizzazione == 'left'): ?>

            <div class="lavori-media-galleria-list lavori-media-galleria-list-left">
                <?php foreach ($immagini as $immagine): ?>

                    <div class="lavori-media-galleria-list-item">
                        <?php echo wp_get_attachment_image($immagine, '1200'); ?>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php elseif ($visualizzazione == 'full'): ?>

            <div class="lavori-media-galleria-list lavori-media-galleria-list-full">
                <?php foreach ($immagini as $immagine): ?>

                    <div class="lavori-media-galleria-list-item">
                        <?php echo wp_get_attachment_image($immagine, '1200'); ?>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php elseif ($visualizzazione == 'list'): ?>

            <div class="container">
                <div class="lavori-media-galleria-list lavori-media-galleria-list-list">
                    <?php foreach ($immagini as $immagine): ?>

                        <div class="lavori-media-galleria-list-item my-3">
                            <?php echo wp_get_attachment_image($immagine, '1200'); ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ( in_array($visualizzazione, ['grid2', 'grid3', 'grid4', 'grid6', 'grid']) ): ?>

            <div class="container">
                <div class="lavori-media-galleria-list lavori-media-galleria-list-grid lavori-media-galleria-list-grid-<?php echo $visualizzazione ?>">

                    <?php foreach ($immagini as $immagine): ?>
                        <div class="lavori-media-galleria-list-item">
                            <?php echo wp_get_attachment_image($immagine, '1200x1200'); ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php endif; ?>

    </div>
</section>
