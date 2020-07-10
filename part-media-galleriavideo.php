<?php

$elenco = get_sub_field('elenco');
$colonne = get_sub_field('colonne');
$class = 12/$colonne;

?>
<section>
    <div class="lavori-media-video">

        <div class="container-fluid">

            <div class="row">
                <?php foreach ($elenco as $video): ?>
                    <div class="col-lg-<?php echo $class ?> my-2">

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video['youtube'] ?>?start=<?php echo $video['start'] ?>&rel=0" allowfullscreen></iframe>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>


        </div>

    </div>
</section>
