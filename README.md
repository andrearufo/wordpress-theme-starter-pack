# Wordpress Theme Starter Pack

Questo pacchetto è un tema di **Wordpress** pronto per lo sviluppo.

Già installandolo sarebbe possibile usarlo così come è, ma la vera forza di questo tema è il sistema di compilazione e gestione dei file.

È possibile svilupparlo come un normale tema ma sotto il cofano con **Bootstrap**, **Gulp**, **SASS** e **Docker** è tutto più facile!

## Configurazione locale

Per lo sviluppo locale è possibile sfruttare le potenzialità di **Docker** o, manualmente, nella cartella dei temi della tua installazione di Wordpress.

>  È altamente consigliato uno sviluppo in locale e l'upload dei soli file compilati alla fine dello sviluppo.

### Sviluppo via Docker

Il pacchetto contiene un `dockerfile` che permette di creare un container senza il bisogno di installare tutto l'ambiente e, quindi, avere a disposizione solo la cartella del tema.

Puoi lanciare e usare il container tramite il comando `docker compose up -d` (fai riferimento alla guida di Docker per altri dettagli).

### Sviluppo in locale

Installalo nella directory dei temi del tuo Wordpress in `/wp-content/themes/` e attivalo dal backend del tuo Wordpress.

## Inizializzazione

Nel pacchetto è presente un file `.env.example`: duplicalo e rinominalo in `.env`. Nel file sono riportate una serie di variabili di sistema utili a Docker e a Vite:

- `THEME_NAME` è il nome del tuo tema e cartella a cui si farà riferimento per i file (`wordpress-theme-starter-pack` di standard come da nome pacchetto)
- `SERVER_PORT` è la porta di ascolto della tua installazione locale (`8000` per Docker)
- `VITE_PORT` è la porta di gestione del server live di Vite (`5173` di standard)

### Compilazione tramite Vite

Tutti i pacchetti necessari ad avviare lo sviluppo del tema si installano via **yarn** (oppure **npm** se preferite).

Apri il terminale e naviga fino a raggiungere la cartella del tema del sito e quindi installa i pacchetti necessari:

```shell
$ cd /code/wordpress-theme-starter-pack/
$ yarn install
```

È quindi possibile ora avviare i task utili all'esecuzione e alla compilazione.