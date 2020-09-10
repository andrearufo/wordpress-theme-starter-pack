<?php

$video = get_sub_field('youtube');
$start = get_sub_field('start');
$visualizzazione = get_sub_field('visualizzazione');
$dimensione = 'w-'.get_sub_field('dimensione');

$container = 'container';
if ($visualizzazione == 'full') $container = null;
elseif ($visualizzazione == 'fluid') $container = 'container-fluid';

?>
<section>
    <div class="lavori-media-video">

        <div class="<?php echo $container ?>">
            <div class="<?php echo $dimensione ?> m-auto">

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video ?>?start=<?php echo $start ?>&rel=0" allowfullscreen></iframe>
                </div>

            </div>
        </div>

    </div>
</section>
