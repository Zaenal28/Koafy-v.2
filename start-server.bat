@echo off
set "PATH=C:\laragon\bin\php\php-8.2.28-nts-Win32-vs16-x64;C:\laragon\bin\composer;%PATH%"
npx concurrently -c "#F51487,#fdba74" "php artisan serve --host=127.0.0.1 --port=8000" "npm run dev" --names=laravel,vite
