# Wordpress Theme Starter Pack

Questo pacchetto è un tema di **Wordpress** pronto per essere sviluppato.

Già installandolo è possibile usarlo ma la vera forza i questo tema è il sistema di compilazione e gestione dei file.

È possibile svilupparlo come un normale tema ma sotto il cofano con **Bootstrap**, **Gulp**, **SASS** e **fontface** è tutto più facile.

Installalo nella directory dei temi del tuo Wordpress in `/wp-content/themes/` e attivalo dal backend del tuo Wordpress.

_È altamente consigliato uno sviluppo in locale e l'upload dei soli file compilati tramite Gulp alla fine dello sviluppo._

## Inizializzazione

Tutti i pacchetti necessari ad avviare lo sviluppo del tema si installano via **yarn**.

Apri il terminale e naviga fino a raggiungere la cartella del tema del sito e quindi installa i pacchetti necessari:


```
$ cd /code/wordpress/wp-content/themes/wordpress-theme-starter-pack/
$ yarn install
```

È quindi possibile ora avviare i task di Gulp utili alla compilazione.

Se hai installato un server locale e vedi il tuo Wordpress su un indirizzo di prova tipo `wordpress.test` puoi aprire il file `gulpfile.js` e modificare la configurazione col tuo url per usare **Browsersync**:

```
$ gulp serve
```

Se invece vuoi solo compilare i tuoi sorgenti mentre stai sviluppando puoi attivare il **watch**:

```
$ gulp watch
```

Per compilare gli stily invece usiamo la potenza di SASS e Bootstrap: i file sono in `/dev/styles` e ho aggiunto qualche utily alle classi standard di Boottrap. Per compilarli lancia il task:

```
$ gulp styles
```

e per gli scripts che sono in `/dev/scripts`

```
$ gulp scripts
```

Ma ricorda di aggiungerli al `functions.php` del tema con le giuste dipendenze.

È possibile anche creare un fontface partendo dalle icone SVG presenti nella cartella `/assets/icons` e quindi lanciare il task:

```
$ gulp icons
```

Tutte le opzioni di configurazione sono in testa al file `gulpfile.js`.