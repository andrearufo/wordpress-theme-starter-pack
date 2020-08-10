<?php

    $cliente = reset(get_field('cliente'));
    wp_redirect( get_the_permalink($cliente->ID).'#lavoro-'.get_the_id() );

?>
