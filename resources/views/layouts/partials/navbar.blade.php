<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            @auth
                {{auth()->user()->name}}
                <div class="text-end">
                    <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Выйти</a>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Войти</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-warning">Регистрация</a>
                </div>
            @endguest
        </div>
    </div>
</header>
