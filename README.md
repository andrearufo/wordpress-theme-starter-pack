# Wordpress Theme Starter Pack

Questo pacchetto è un tema di **Wordpress** pronto per lo sviluppo.

Già installandolo è possibile usarlo ma la vera forza i questo tema è il sistema di compilazione e gestione dei file.

È possibile svilupparlo come un normale tema ma sotto il cofano con **Bootstrap**, **Gulp**, **SASS** è tutto più facile!

![](https://raw.githubusercontent.com/andrearufo/wordpress-theme-starter-pack/master/screenshot.png)

## Configurazione locale

Per lo sviluppo locale è possibile sfruttare le potenzialità di **Docker** o manualmente nella cartella dei temi della tua installazione di Wordpress.

>  È altamente consigliato uno sviluppo in locale e l'upload dei soli file compilati tramite Gulp alla fine dello sviluppo.

### Sviluppo via Docker

Il pacchetto contiene un `dockerfile` che permette di creare un container senza il bisogno di installare tutto l'ambiente e quindi avere a disposizione solo la cartella del tema.

Puoi lanciare e usare il container tramite il comando `docker composer up -d` (fai riferimento alla guida di Docker per altri dettagli).

### Sviluppo in locale

Installalo nella directory dei temi del tuo Wordpress in `/wp-content/themes/` e attivalo dal backend del tuo Wordpress.

## Inizializzazione

Nel pacchetto è presente un file `.env.example`: duplicalo e rinominalo in `.env`. Nel file sono riportate una serie di variabili di sistema utili a Docker, a Gulp e a Browsersync:

- `SERVER_NAME` è l'indirizzo locale della tua installazione (`localhost` per Docker)
- `SERVER_PORT` e la porta di ascolto della tua installazione locale (`8000` per Docker)
- `THEME_NAME` è il nome del tuo tema e cartella a cui si farà riferimento per i file (`wordpress-theme-starter-pack` di standard come da nome pacchetto)
- `THEME_VERSION` è il numero di versione del tema

### Compilazione tramite Gulp

Tutti i pacchetti necessari ad avviare lo sviluppo del tema si installano via **yarn**.

Apri il terminale e naviga fino a raggiungere la cartella del tema del sito e quindi installa i pacchetti necessari:

```
$ cd /code/wordpress-theme-starter-pack/
$ yarn install
```

È quindi possibile ora avviare i task utili all'esecuzione e alla compilazione.

Se hai installato un server locale e vedi il tuo Wordpress su un indirizzo di prova tipo `wordpress.test` ricordati di aggiornare il file `.env` con questo parametro (che verrà poi usato da **Browsersync**).

I file sorgenti di styles e scripts sono presenti nella cartella `dev` e tramite i task di Gulp vengono compilati e portati nella cartella `dist`.

### Comandi di gestione

Tutti i comandi sono lanciati tramite gli script presenti nel file `package.json` ma possono ovviamente essere lanciati anche indipendentemente

#### start

Usa `yarn start` per avviare il container di Docker e raggiungere il tuo sito su http://localhost:8000 (o come da configurazione in file `.env`)

#### stop

Usa invece `yarn stop` per fermare il container di Docker

#### serve

Lanciando `yarn serve` attiverai il container di Docker e lancerai Browsersync tramite Gulp: il tuo sito verrà compilato e aggiornato automaticamente quando modificherai un file

#### watch

Con `yarn watch` attiverai Gulp che compilerà automaticamente i file di styles e scripts quando verranno modificati

#### build

Il comando `yarn build` compilerà styles e scripts.

![La pagina degli articoli](https://i.ibb.co/hytL9XC/screencapture-wordpress-test-articoli-2020-10-18-00-08-10.png)
