import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import autoprefixer from "autoprefixer"; // Direct ES module import
import tailwindcss from "tailwindcss";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss(),
                autoprefixer(), // No need for CommonJS require, using ES module import
            ],
        },
    },
});
