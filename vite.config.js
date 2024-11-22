import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import dotenv from 'dotenv';

// Carica il file .env
dotenv.config();

export default defineConfig({
  root: './',
  base: `/`,
  server: {
    host: true,
    port: parseInt(process.env.VITE_PORT, 10) || 5173,
    proxy: {
      '/': {
        target: `http://localhost:${process.env.SERVER_PORT}`,
        changeOrigin: true,
        secure: false,
      },
    },
  },
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
