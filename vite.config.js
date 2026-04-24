import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    server: {
        // host: '0.0.0.0',
        // port: 5173,
        // hmr: {
        //     host: '192.168.1.8',
        // },
        watch: {
            ignored: [
                resolve(__dirname, 'storage/framework/views/**'),
            ],
        }
    },

    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
            ],
        }),
    ],

    // KONFIGURASI SERVER SEHARUSNYA DI SINI (LEVEL ATAS)
    // server: {
    //     watch: {
    //         ignored: [
    //             resolve(__dirname, 'storage/framework/views/**'),
    //         ],
    //     }
    // }
});