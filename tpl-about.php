<?php

/**
* Template name: About
*/

get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <div id="about">

        <div id="about-heading">
            <div class="container">


                <div id="about-heading-inner">
                    <div class="row">
                        <div class="col-lg-8">

                            <h1><span><?php the_title() ?></span></h1>
                            <h2>Siamo un’agenzia di comunicazione integrata che fa fruttare il tuo business</h2>

                            <p>
                                Nata nel 2004, in piena era digitale, l’agenzia è composta da giovani professionisti
                                sempre alla ricerca dell’innovazione e specializzati nella realizzazione e nella
                                promozione di siti e applicativi web.
                            </p>
                            <p>
                                I nostri servizi principali sono basati sull’approccio “below the line”, centrato sulla
                                vendita diretta, attraverso soluzioni di web marketing come: le campagne integrate, il
                                posizionamento sui motori di ricerca, gli annunci sponsorizzati, il direct email marketing,
                                il video marketing e il social media marketing.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="about-banner">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        Agenzia di comunicazione leader in servizi per la visibilità online e offline

                    </div>
                </div>

            </div>
        </div>

        <div class="about-block">
            <div class="container">

                <div class="row">
                    <div class="col-lg-10">

                        <div class="row align-items-center">
                            <div class="col-lg-6 text-lg-right">

                                <h3>Accounting</h3>
                                <p>
                                    I nostri account sono consulenti specializzati in tutti gli ambiti della comunicazione e curano il
                                    cliente in tutto il processo. Rappresentano il tramite tra agenzia e committenza, coordinando i flussi
                                    di produzione attraverso la stretta connessione con il reparto planning e media, garantendo così il massimo
                                    della qualità nel rapporto tra budget e produzione.
                                </p>

                            </div>
                            <div class="col-lg-6">

                                <img src="https://source.unsplash.com/rRWiVQzLm7k/800x800" class="rounded shadow">

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="about-block">
            <div class="container">

                <div class="row justify-content-end">
                    <div class="col-lg-10">

                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-last">

                                <h3>Consulenza</h3>
                                <p>
                                    Offriamo consulenze e servizi anche sul branding e la costruzione dell’identità aziendale
                                    come: loghi, coordinati, siti web, app e progetti editoriali. Completano la nostra offerta
                                    integrata le soluzioni “above the line”: stampa, televisione, radio e affissioni.
                                </p>

                            </div>
                            <div class="col-lg-6">

                                <img src="https://source.unsplash.com/zoCDWPuiRuA/800x800" class="rounded shadow">

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="about-block">
            <div class="container">

                <div class="row">
                    <div class="col-lg-10">

                        <div class="row align-items-center">
                            <div class="col-lg-6 text-lg-right">

                                <h3>Soluzioni</h3>
                                <p>
                                    Le nostre Soluzioni sono costruite ad hoc sulle esigenze specifiche del committente al fine
                                    di raggiungere gli obiettivi di marketing condivisi e di rendere più fruttuosi gli
                                    investimenti in comunicazione.
                                </p>

                            </div>
                            <div class="col-lg-6">

                                <img src="https://source.unsplash.com/pKRNxEguRgM/800x800" class="rounded shadow">

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

<?php endwhile; endif; ?>

<?php get_template_part('part', 'footerpage') ?>

<?php get_footer(); ?>
