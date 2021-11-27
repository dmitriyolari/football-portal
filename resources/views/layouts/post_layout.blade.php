@inject('userHelper', 'App\Helpers\Blade\UserHelper')
@inject('categoryHelper', 'App\Helpers\Blade\CategoryHelper')
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>@yield('home-page_name')</title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
</head>
<body>

<header class="p-2">
    <div class="container">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/front/images/logo.png') }}" alt=""></a>
        <ul class="authorization">
            @guest
                <li class="d-flex authorization_enter"><a href="{{ route('login.create') }}">Войти / </a><a href="{{ route('register.create') }}">Зарегистрироваться</a></li>
            @endguest

            @auth
                <li><a href="@if($userHelper->isAdmin()) {{ route('admin.index') }} @else {{ route('user.area') }} @endif">{{ $userHelper->userName() }}</a></li>
                <li class="authorization_exit"><a href="{{ route('logout') }}">Выйти</a></li>
            @endauth
        </ul>
    </div>
</header>
<div class="wrapper container px-4">
    <div class="d-flex justify-content-around align-items-center p-3">
        <form class="subscribe" action="" method="POST">
            <input type="email" name="subscribe" placeholder="E-mail">
            <button type="submit">Подписаться</button>
        </form>

        @if(session('success-registration'))
            <div class="registration alert alert-success">
                {{ session('success-registration') }}
            </div>
        @endif

        <div class="social-nets">
            <a href="https://vk.com/">
                <img src="{{ asset('assets/front/images/social-nets/vk.jpg') }}" alt="">
            </a>
            <a href="https://twitter.com/">
                <img src="{{ asset('assets/front/images/social-nets/twitter.jpg') }}" alt="">
            </a>
            <a href="https://www.facebook.com">
                <img src="{{ asset('assets/front/images/social-nets/facebook.jpg') }}" alt="">
            </a>
            <a href="https://t.me/">
                <img src="{{ asset('assets/front/images/social-nets/telegram.jpg') }}" alt="">
            </a>
            <a href="https://zen.yandex.ru">
                <img src="{{ asset('assets/front/images/social-nets/zen.png') }}" alt="">
            </a>
            <a href="#">
                <img src="{{ asset('assets/front/images/social-nets/rss_button.jpg') }}" alt="">
            </a>
        </div>
    </div>
    <div class="border">
        <!-- Main -->
        <main class="row">
            <nav class="side-nav col-2 pt-3">
                <section>
                    <h5>Соревнования:</h5>
                    <ul>
                        @foreach($categoryHelper->getCategories() as $category)
                            <li class="link">
                                <a href="#">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section>
                    <h5>Чемпионаты:</h5>
                    <ul>
                        <li class="link">
                            <a href="#">Англия</a>
                        </li>
                        <li class="link">
                            <a href="#">Германия</a>
                        </li>
                        <li class="link">
                            <a href="#">Испания</a>
                        </li>
                        <li class="link">
                            <a href="#">Италия</a>
                        </li>
                    </ul>
                </section>
                <section>
                    <h5>Архивы:</h5>
                    <ul>
                        <li class="link">
                            <a href="#">ЧМ 2018</a>
                        </li>
                        <li class="link">
                            <a href="#">ЕВРО 2020</a>
                        </li>
                        <li class="link">
                            <a href="#">Кубок Америки 2021</a>
                        </li>
                        <li class="link">
                            <a href="#">Олимпиада 2020</a>
                        </li>
                    </ul>
                </section>
            </nav>
            <div class="content col-9 ms-4 pt-5 ps-5">
                @yield('content_main-articles')
                @yield('personal-area-header')
                @yield('personal_area-body')
            </div>
        </main>
        <!-- End Main -->

        <!-- Footer -->
        <footer class="d-flex flex-column text-center p-3">
            <div>Футбол - новости футбола, портал, аналитика.</div>
            <div>Copyright (c) 2020-{{ date('Y') }}. <a href="https://www.linkedin.com/in/dumitru-olari-b91a07170/">Дмитрий</a></div>
        </footer>
        <!-- End Footer -->
    </div>
</div>
</body>
</html>
