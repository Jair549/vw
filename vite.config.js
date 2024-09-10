import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/sass/app.scss',
                'resources/scss/panel.scss',
                'resources/js/app.js',
                'resources/js/panel/functions.js'
            ],
            refresh: true,
        }),
    ],
});
