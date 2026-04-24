import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/stylesheets/portal/styles.scss', 'resources/js/portal/app.js',
                'resources/stylesheets/auth-portal/styles.scss', 'resources/js/auth-portal/app.js',
                'resources/stylesheets/customer-portal/style.scss', 'resources/js/customer-portal/app.js',
            ],
            refresh: true,
        }),
    ],
});
