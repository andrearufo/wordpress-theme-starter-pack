import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
  root: './', // Radice del tema
  base: '/wp-content/themes/your-theme/', // URL base del tema
  build: {
    outDir: 'dist', // Output nella cartella dist
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: 'src/scripts/main.js', // Ingresso principale per JS
        styles: 'src/styles/main.scss', // Ingresso principale per CSS
      },
      output: {
        assetFileNames: ({ name }) => {
          // Cambia i nomi degli asset in base al file di input
          if (name === 'styles.css') {
            return 'styles/main.css'; // Output CSS come main.css
          }
          return '[name].[ext]'; // Lascia invariati altri asset
        },
        chunkFileNames: 'scripts/[name].js', // Chunk JS in dist/scripts/
        entryFileNames: 'scripts/[name].js', // Ingressi JS in dist/scripts/
      },
    },
  },
  css: {
    postcss: {
      plugins: [tailwindcss, autoprefixer],
    },
  },
});
