import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(), // Vite will take care of integrating TailwindCSS.
  ],
  css: {
    postcss: './postcss.config.cjs', // Ensure it's pointing to the correct config file.
  },
});
