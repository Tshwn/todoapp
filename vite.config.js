import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],

    server: {
        // host: '192.168.11.27', // ローカルネットワークからアクセスできるように設定
        host: "192.168.10.104", //自宅のローカルネットワークipアドレス
        port: 8080, // 必要に応じてポートを変更
        strictPort: true, // ポートが使用中の場合はエラー
    },
});
