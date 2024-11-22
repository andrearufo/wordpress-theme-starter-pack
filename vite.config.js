import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import FullReload from 'vite-plugin-full-reload';
import dotenv from 'dotenv';

dotenv.config();

export default defineConfig({
  root: './',
  base: '/', // Base semplificata per evitare conflitti
  server: {
    host: process.env.VITE_HOST,
    port: parseInt(process.env.VITE_PORT, 10) || 5173,
    hmr: {
      host: 'localhost', // Host usato per i WebSocket
      port: parseInt(process.env.VITE_PORT, 10) || 5173,
    },
    headers: {
      'Access-Control-Allow-Origin': '*',
    },
    proxy: {
      '/': {
        target: `http://localhost:${process.env.SERVER_PORT}`,
        changeOrigin: true,
        secure: false,
      },
    },
  },
  plugins: [
    FullReload(['**/*.php'], { delay: 300 }), // Aggiungi un delay per stabilizzare il reload
  ],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: 'src/scripts/main.js',
        styles: 'src/styles/main.scss',
      },
      output: {
        assetFileNames: ({ name }) => {
          if (name && name.endsWith('.css')) {
            return 'styles/main.css';
          }
          return 'scripts/[name].js';
        },
        chunkFileNames: 'scripts/[name].js',
        entryFileNames: 'scripts/[name].js',
      },
    },
  },
  css: {
    postcss: {
      plugins: [tailwindcss, autoprefixer],
    },
  },
});
