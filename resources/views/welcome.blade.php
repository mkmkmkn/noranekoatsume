<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>のらねこあつめ</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0&display=auto"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Kaisei+Opti:wght@400;500;700&family=Kiwi+Maru:wght@300;400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Styles -->
    {{-- <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
        </style> --}}
    <link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">

</head>

<body class="welcome">
    <header class="header bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow">
        <a href="{{ url('/') }}" class="">
            <h1 class="header_logo f28 fm kaisei">
                のらねこあつめ
            </h1>
        </a>
        @if (Route::has('login'))
            <nav class="header_nav">
                @auth
                    <a href="{{ url('/dashboard') }}" class="opa">アプリを開く</a>
                @else
                    <a href="{{ route('login') }}" class="opa">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="opa">アカウント作成</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <main>
        <style>
            .material-symbols-outlined {
                font-variation-settings:
                    'FILL' 0,
                    'wght' 400,
                    'GRAD' 0,
                    'opsz' 24
            }
        </style>

        <section class="top_mv">
            <ul class="slider js-slider" id="">
                <li class="slider__inner js-slider__inner"></li>

                <li class="slide js-slide">
                    <div class="container slide__content">
                        <div class="js-slider__text js-slider__text_1">
                            <div class="js-slider__text-line">
                                <div class="text f64 lh1.25 fm fwhite">全国のねこさんと</div>
                            </div>
                            <div class="js-slider__text-line">
                                <div class="text f64 lh1.25 fm fwhite">出会えるアプリ</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="slide js-slide">
                    <div class="container slide__content">
                        <div class="js-slider__text js-slider__text_2">
                            <div class="js-slider__text-line">
                                <div class="text f64 fm lh1 fwhite kaisei">のらねこあつめ</div>
                            </div>
                            <div class="js-slider__text-line">
                                <div class="text f28 fm fwhite">noranekoatsume</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="slide js-slide">
                    <div class="container container_3 slide__content">
                        <div class="js-slider__text js-slider__text_3">
                            <div class="js-slider__text-line">
                                <div class="text f64 fm fwhite">🐾🐾🐾🐾🐾🐾</div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="slider__nav js-slider__nav">
                    <div class="container">
                        <div class="slider__nav-inner">
                            <div class="slider-bullet js-slider-bullet">
                                <span
                                    class="slider-bullet__text js-slider-bullet__text material-symbols-outlined f20">pets</span>
                                <span class="slider-bullet__line js-slider-bullet__line"></span>
                            </div>
                            <div class="slider-bullet js-slider-bullet">
                                <span
                                    class="slider-bullet__text js-slider-bullet__text material-symbols-outlined f20">pets</span>
                                <span class="slider-bullet__line js-slider-bullet__line"></span>
                            </div>
                            <div class="slider-bullet js-slider-bullet">
                                <span
                                    class="slider-bullet__text js-slider-bullet__text material-symbols-outlined f20">pets</span>
                                <span class="slider-bullet__line js-slider-bullet__line"></span>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- <li class="scroll js-scroll">Scroll</li> --}}
            </ul>
        </section>
        <section class="underMv_section bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
            <div class="underMv_wave">
                <svg class="editorial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 28 " preserveAspectRatio="none">
                    <defs>
                        <path id="gentle-wave" d="M-160 44c30 0
                        58-18 88-18s
                        58 18 88 18
                        58-18 88-18
                        58 18 88 18
                        v44h-352z" />
                    </defs>
                    <g class="parallax1">
                        <use xlink:href="#gentle-wave" x="50" y="3" fill="#1f2937" />
                    </g>
                    <g class="parallax2">
                        <use xlink:href="#gentle-wave" x="50" y="0" fill="#1f2937" />
                    </g>
                    <g class="parallax3">
                        <use xlink:href="#gentle-wave" x="50" y="9" fill="#1f2937" />
                    </g>
                    <g class="parallax4">
                        <use xlink:href="#gentle-wave" x="50" y="6" fill="#1f2937" />
                    </g>
                </svg>
            </div>
            <div id="parallax" class="underMv_bg_1">
                <img src="{{ asset('img/cat_bg.png') }} " alt="回転する背景イメージ">
            </div>
            <div class="container">
                <div class="underMv_text">
                    <p class="f20 lh1.75 text-gray-800 dark:text-gray-200">
                        市街地から山奥にあるのどかな集落、漁港、離島・・・<br>
                        日本にはありとあらゆる場所で、今もたくさんのねこさん達が住んでいます。<br>
                        いつでも、どこでも、気軽に全国のねこさん達を眺められる掲示板が誕生しました。<br>
                        日本中で気ままに暮らすかわいいねこさん達を眺めながら、一緒に癒されてみませんか。
                    </p>
                </div>
            </div>
        </section>
        <section
            class="characteristic_section sectionMargin bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
            <div class="container">
                <div class="sectionTitle">
                    <p class="sectionTitle_nikukyu material-symbols-outlined f40 forange">pets</p>
                    <h3 class="sectionTitle_text f28">特徴</h3>
                </div>
                <div class="characteristic_content">
                    <div class="characteristic_content_2column">
                        <div class="left">
                            <p class="f18 lh1.75">
                                日本全国の地域ねこさんたちの写真と撮影地を表示。休日や仕事終わりに撮影地へと赴けば、実際に会うことができるかも？<br>
                                もちろん、ねこさんの写真を見るだけでも楽しめます。
                            </p>
                            <small class="f14 lh1.75">※投稿の際は、撮影地を個人が特定できないような場所（道路、公園、ショッピングモール等）への設定をお願いします。</small>
                        </div>
                        <div class="right">
                            <img src="{{ asset('img/characteristic_1.png') }}" alt="特徴イメージ1">
                        </div>
                    </div>
                    <div class="characteristic_content_2column">
                        <div class="left">
                            <p class="f18 lh1.75">
                                かわいい地域ねこさんの写真が撮れたら、投稿してみんなに自慢しよう！
                            </p>
                        </div>
                        <div class="right">
                            <img src="{{ asset('img/characteristic_3.png') }}" alt="特徴イメージ2">
                        </div>
                    </div>
                    <div class="characteristic_content_2column">
                        <div class="left">
                            <p class="f18 lh1.75">
                                ねこさんが小さく写っている・・・という場合でも、余分な箇所をカットすることができます。
                            </p>
                        </div>
                        <div class="right">
                            <img src="{{ asset('img/characteristic_4.png') }}" alt="特徴イメージ3">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="start_section sectionMargin bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
            <div class="container">
                <div class="start_content bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <p class="start_content_topText f28">今すぐはじめよう！</p>
                    <div class="start_content_buttonWrapper">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="submit_button">アプリを開く</a>
                            @else
                                <a href="{{ route('login') }}" class="submit_button">ログイン</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="submit_button">アカウント作成</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <p class="footer_credit f14">©2024 mk All rights reserved.</p>
    </footer>
    <script>
        // underMvセクション　回転する背景
        $(window).scroll(function() {
            var height = $(this).scrollTop();
            /*高さを調節*/
            var yLine = height - 600;
            console.log(yLine);
            /*parseInt( yLine / 2 )の整数部分(今回なら2)を調節することで、スクロール時の動きを調節。値を小さくすると、大きく動く*/
            $('#parallax').css('transform', 'rotate(' + parseInt(yLine / 20) + 'deg)');
        });
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/109/three.min.js'></script>
    <script>
        // mvセクション　スライダー
        class Slider {
            constructor() {
                this.bindAll()

                this.vert = `
varying vec2 vUv;
void main() {
  vUv = uv;
  gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
}
`

                this.frag = `
varying vec2 vUv;

uniform sampler2D texture1;
uniform sampler2D texture2;
uniform sampler2D disp;

uniform float dispPower;
uniform float intensity;

uniform vec2 size;
uniform vec2 res;

vec2 backgroundCoverUv( vec2 screenSize, vec2 imageSize, vec2 uv ) {
  float screenRatio = screenSize.x / screenSize.y;
  float imageRatio = imageSize.x / imageSize.y;
  vec2 newSize = screenRatio < imageRatio
      ? vec2(imageSize.x * (screenSize.y / imageSize.y), screenSize.y)
      : vec2(screenSize.x, imageSize.y * (screenSize.x / imageSize.x));
  vec2 newOffset = (screenRatio < imageRatio
      ? vec2((newSize.x - screenSize.x) / 2.0, 0.0)
      : vec2(0.0, (newSize.y - screenSize.y) / 2.0)) / newSize;
  return uv * screenSize / newSize + newOffset;
}

void main() {
  vec2 uv = vUv;

  vec4 disp = texture2D(disp, uv);
  vec2 dispVec = vec2(disp.x, disp.y);

  vec2 distPos1 = uv + (dispVec * intensity * dispPower);
  vec2 distPos2 = uv + (dispVec * -(intensity * (1.0 - dispPower)));

  vec4 _texture1 = texture2D(texture1, distPos1);
  vec4 _texture2 = texture2D(texture2, distPos2);

  gl_FragColor = mix(_texture1, _texture2, dispPower);
}
`

                this.el = document.querySelector('.js-slider')
                this.inner = this.el.querySelector('.js-slider__inner')
                this.slides = [...this.el.querySelectorAll('.js-slide')]
                this.bullets = [...this.el.querySelectorAll('.js-slider-bullet')]

                this.renderer = null
                this.scene = null
                this.clock = null
                this.camera = null

                this.images = [
                    'img/mv_1.jpg',
                    'img/mv_2.jpg',
                    'img/mv_3.jpg'
                ]

                this.data = {
                    current: 0,
                    next: 1,
                    total: this.images.length - 1,
                    delta: 0
                }

                this.state = {
                    animating: false,
                    text: false,
                    initial: true
                }

                this.textures = null

                this.init()
            }

            bindAll() {
                ['render', 'nextSlide']
                .forEach(fn => this[fn] = this[fn].bind(this))
            }

            setStyles() {
                this.slides.forEach((slide, index) => {
                    if (index === 0) return

                    TweenMax.set(slide, {
                        autoAlpha: 0
                    })
                })

                this.bullets.forEach((bullet, index) => {
                    if (index === 0) return

                    const txt = bullet.querySelector('.js-slider-bullet__text')
                    const line = bullet.querySelector('.js-slider-bullet__line')

                    TweenMax.set(txt, {
                        alpha: 0.25
                    })
                    TweenMax.set(line, {
                        scaleX: 0,
                        transformOrigin: 'left'
                    })
                })
            }

            cameraSetup() {
                this.camera = new THREE.OrthographicCamera(
                    this.el.offsetWidth / -2,
                    this.el.offsetWidth / 2,
                    this.el.offsetHeight / 2,
                    this.el.offsetHeight / -2,
                    1,
                    1000
                )

                this.camera.lookAt(this.scene.position)
                this.camera.position.z = 1
            }

            setup() {
                this.scene = new THREE.Scene()
                this.clock = new THREE.Clock(true)

                this.renderer = new THREE.WebGLRenderer({
                    alpha: true
                })
                this.renderer.setPixelRatio(window.devicePixelRatio)
                this.renderer.setSize(this.el.offsetWidth, this.el.offsetHeight)

                this.inner.appendChild(this.renderer.domElement)
            }

            loadTextures() {
                const loader = new THREE.TextureLoader()
                loader.crossOrigin = ''

                this.textures = []
                this.images.forEach((image, index) => {
                    const texture = loader.load(image + '?v=' + Date.now(), this.render)

                    texture.minFilter = THREE.LinearFilter
                    texture.generateMipmaps = false

                    if (index === 0 && this.mat) {
                        this.mat.uniforms.size.value = [
                            texture.image.naturalWidth,
                            texture.image.naturalHeight
                        ]
                    }

                    this.textures.push(texture)
                })

                this.disp = loader.load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/58281/rock-_disp.png', this
                    .render)
                this.disp.magFilter = this.disp.minFilter = THREE.LinearFilter
                this.disp.wrapS = this.disp.wrapT = THREE.RepeatWrapping
            }

            createMesh() {
                this.mat = new THREE.ShaderMaterial({
                    uniforms: {
                        dispPower: {
                            type: 'f',
                            value: 0.0
                        },
                        intensity: {
                            type: 'f',
                            value: 0.5
                        },
                        res: {
                            value: new THREE.Vector2(window.innerWidth, window.innerHeight)
                        },
                        size: {
                            value: new THREE.Vector2(1, 1)
                        },
                        texture1: {
                            type: 't',
                            value: this.textures[0]
                        },
                        texture2: {
                            type: 't',
                            value: this.textures[1]
                        },
                        disp: {
                            type: 't',
                            value: this.disp
                        }
                    },
                    transparent: true,
                    vertexShader: this.vert,
                    fragmentShader: this.frag
                })

                const geometry = new THREE.PlaneBufferGeometry(
                    this.el.offsetWidth,
                    this.el.offsetHeight,
                    1
                )

                const mesh = new THREE.Mesh(geometry, this.mat)

                this.scene.add(mesh)
            }

            transitionNext() {
                TweenMax.to(this.mat.uniforms.dispPower, 2.5, {
                    value: 1,
                    ease: Expo.easeInOut,
                    onUpdate: this.render,
                    onComplete: () => {
                        this.mat.uniforms.dispPower.value = 0.0
                        this.changeTexture()
                        this.render.bind(this)
                        this.state.animating = false
                    }
                })

                const current = this.slides[this.data.current]
                const next = this.slides[this.data.next]

                const currentImages = current.querySelectorAll('.js-slide__img')
                const nextImages = next.querySelectorAll('.js-slide__img')

                const currentText = current.querySelectorAll('.js-slider__text-line div')
                const nextText = next.querySelectorAll('.js-slider__text-line div')

                const currentBullet = this.bullets[this.data.current]
                const nextBullet = this.bullets[this.data.next]

                const currentBulletTxt = currentBullet.querySelectorAll('.js-slider-bullet__text')
                const nextBulletTxt = nextBullet.querySelectorAll('.js-slider-bullet__text')

                const currentBulletLine = currentBullet.querySelectorAll('.js-slider-bullet__line')
                const nextBulletLine = nextBullet.querySelectorAll('.js-slider-bullet__line')

                const tl = new TimelineMax({
                    paused: true
                })

                if (this.state.initial) {
                    TweenMax.to('.js-scroll', 1.5, {
                        yPercent: 10,
                        alpha: 0,
                        ease: Power4.easeInOut
                    })

                    this.state.initial = false
                }

                tl
                    .staggerFromTo(currentImages, 1.5, {
                        yPercent: 0,
                        scale: 1
                    }, {
                        yPercent: -185,
                        scaleY: 1.5,
                        ease: Expo.easeInOut
                    }, 0.075)
                    .to(currentBulletTxt, 1.5, {
                        alpha: 0.25,
                        color: '#888',
                        backgroundColor: '#fff',
                        ease: Linear.easeNone
                    }, 0)
                    .set(currentBulletLine, {
                        transformOrigin: 'right'
                    }, 0)
                    .to(currentBulletLine, 1.5, {
                        scaleX: 0,
                        ease: Expo.easeInOut
                    }, 0)

                if (currentText) {
                    tl
                        .fromTo(currentText, 2, {
                            yPercent: 0
                        }, {
                            yPercent: -100,
                            ease: Power4.easeInOut
                        }, 0)
                }

                tl
                    .set(current, {
                        autoAlpha: 0
                    })
                    .set(next, {
                        autoAlpha: 1
                    }, 1)

                if (nextText) {
                    tl
                        .fromTo(nextText, 2, {
                            yPercent: 100
                        }, {
                            yPercent: 0,
                            ease: Power4.easeOut
                        }, 1.5)
                }

                tl
                    .staggerFromTo(nextImages, 1.5, {
                        yPercent: 150,
                        scaleY: 1.5
                    }, {
                        yPercent: 0,
                        scaleY: 1,
                        ease: Expo.easeInOut
                    }, 0.075, 1)
                    .to(nextBulletTxt, 1.5, {
                        alpha: 1,
                        color: '#f90',
                        backgroundColor: '#fff',
                        ease: Linear.easeNone
                    }, 1)
                    .set(nextBulletLine, {
                        transformOrigin: 'left'
                    }, 1)
                    .to(nextBulletLine, 1.5, {
                        scaleX: 1,
                        ease: Expo.easeInOut
                    }, 1)

                tl.play()
            }

            prevSlide() {

            }

            nextSlide() {
                if (this.state.animating) return

                this.state.animating = true

                this.transitionNext()

                this.data.current = this.data.current === this.data.total ? 0 : this.data.current + 1
                this.data.next = this.data.current === this.data.total ? 0 : this.data.current + 1
            }

            changeTexture() {
                this.mat.uniforms.texture1.value = this.textures[this.data.current]
                this.mat.uniforms.texture2.value = this.textures[this.data.next]
            }

            listeners() {
                //window.addEventListener('wheel', this.nextSlide, { passive: true })
                //wheelでスライドではなく、5秒ごとにスライドに変更
                setInterval(this.nextSlide, 6000, {
                    passive: true
                });
            }

            render() {
                this.renderer.render(this.scene, this.camera)
            }

            init() {
                this.setup()
                this.cameraSetup()
                this.loadTextures()
                this.createMesh()
                this.setStyles()
                this.render()
                this.listeners()
            }
        }

        // Toggle active link
        const links = document.querySelectorAll('.js-nav a')

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault()
                links.forEach(other => other.classList.remove('is-active'))
                link.classList.add('is-active')
            })
        })

        // Init classes
        const slider = new Slider()
    </script>
</body>

</html>
