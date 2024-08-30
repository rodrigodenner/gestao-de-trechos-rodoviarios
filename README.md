
# INSTALAÇÃO INERTIA JS
Configuração básica do Laravel com Inertia.js para uma experiência de desenvolvimento dinâmica e eficiente. Direto ao Ponto

## INSTALAR O INERTIA DENTRO DO SEU PROJETO LARAVEL

```php
composer require inertiajs/inertia-laravel
```

## ATUALIZAAR O WELCOME.BLADE.PHP para APP.BLADE.PHP E SUBSTITUIR O CONTEÚDO

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @routes
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
```

## CRIAR E APONTAR O MIDDLEWARE DO INERTIA

```php
php artisan inertia:middleware
```

- No arquivo kernel.php em App\Http\Kernel; registrar o middleware

```php
'web' => [
    // ...
    \App\Http\Middleware\HandleInertiaRequests::class,
],
```

## Arquivo app.js (Arquivo JS principal da aplicação)

<aside>
👉🏼 A configuração especial do pacote Ziggy jé está feita no arquivo

</aside>

- Ziggy é para conseguirmos gerenciar as rotas por names

```jsx
import {createApp, h } from 'vue';
import { createInertiaApp,Link } from '@inertiajs/vue3';
import NProgress from 'nprogress';
import { router } from '@inertiajs/vue3';
import route from 'ziggy-js';

router.on('start', () => NProgress.start());
router.on('finish', () => NProgress.done());

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {

        const VueApp = createApp({ render: () => h(App, props) });
        VueApp.config.globalProperties.$route = route;
        VueApp.component('Link',Link)
            .use(plugin)
            .mount(el);
    },
});
```

## CRIANDO DIRETÓRIO Pages

<aside>
👉🏼 resources/js/Pages ⇒ Caminho para esse novo diretório

</aside>

Essa pasta é criado, porque no passo anterior definimos que a Aplicação buscará os componentes nesse diretório

## INSTALANDO O PROGRASS INERTIA

- Comando de download

```php
npm install nprogress
```

- Inserindo estilização do progress

```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
```

- Inserir no JS o seguinte código (já inserimos no passo anterior)

```jsx
import NProgress from 'nprogress';
import { router } from '@inertiajs/vue3';

router.on('start', () => NProgress.start());
router.on('finish', () => NProgress.done());
```

## CONFIGURAR A PRIMEIRA ROTA TESTE

```php
use \Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home',[
        "lhpires" => ["name" => "Lucas Pires", "email" => "lucas@pires.dev.br"]
    ]);
})->name('homeSweetHome');
```

- Criar componente VUE Home.vue ⇒ resources/js/Pages

## MAPEAMENTO COM VITE CONFIG

<aside>
👉🏼 Destaque para o vue() e também o alias do Ziggy

</aside>

```php
import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'ziggy-js': path.resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
});
```

## ADICIONAL PARA USAR ROTAS NOMEADAS DENTRO DO SEU AMBIENTE DE DESENVOLVIMENTO

<aside>
👇🏼 Abaixo, link para o gitHub Ziggy

</aside>

[https://github.com/tighten/ziggy](https://github.com/tighten/ziggy)

```php
composer require tightenco/ziggy
```