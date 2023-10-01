import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sites/css/style.css',
                'resources/sites/css/bootstrap-datepicker.css',

                'resources/sites/js/jquery.min.js',
                'resources/sites/js/popper.min.js',
                'resources/sites/js/bootstrap.min.js',
                'resources/sites/js/functions.js',
                'resources/sites/js/owl.carousel.min.js',
                'resources/sites/js/slick.js',
                'resources/sites/js/swiper.min.js',
                'resources/sites/js/main.js',
                'resources/sites/js/jquery.fancybox.min.js',
                'resources/sites/js/bootstrap-datepicker.min.js',
                'resources/sites/js/jquery-ui.min.js',
            ],
            refresh: true,
        }),
    ],
});
