<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Page</title>
</head>
<body>
    @yield('content')
    <section class="header">
        <div class="content flex flex-col justify-between">
            <nav class="flex justify-between py-7 px-32 text-white items-center">
                <div class="flex justify-center py-0">
                    <img src="images/LOGO.png" alt="logo">
                    <a class="text-2xl font-bold" href="">Welancer</a>
                </div>
                <div class="font-semibold">
                     <a class="text-center mx-3" href="">Home</a>
                     <a class="mx-3" href="">Service</a>
                     <a class="mx-3" href="">About Us</a>
                     <a class="mx-3" href="">Pricing</a>
                </div>
                @auth('pegawai')
                        <div class="dropdown inline-block relative">
                            <button class="bg-violet-700 font-semibold py-2 px-6 rounded-xl inline-flex items-center">
                            <span class="mr-1">Welcome, {{ auth('pegawai')->user()->name }}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                            </button>
                                <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                    <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="">
                                        <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('logout') }}">logout</a>
                                    </li>
                                </ul>
                        </div>
                @else
                    @auth('web')
                            <div class="dropdown inline-block relative">
                                <button class="bg-violet-700 font-semibold py-2 px-6 rounded-xl inline-flex items-center">
                                <span class="mr-1">Welcome, {{ auth('web')->user()->name }}</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                                </button>
                                    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                        <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Dashboard</a></li>
                                        <li class="">
                                            <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('logout') }}">logout</a>
                                        </li>
                                    </ul>
                            </div>
                                @else
                                    <div>
                                        <a class="font-medium py-2 px-6 bg-violet-700 rounded-xl" href="{{ route('login-user') }}">Login</a>
                                    </div>
                    @endauth
                @endauth
            </nav>
            <div class="flex flex-col px-32 text-white ">
                <div class="text-7xl font-bold mb-3">
                    <H1>Amet sed cursus <br>eu tellus eget.</H1>
                </div>
                <div class="text-xs text-slate-400 mb-3">
                    <p>Vitae augue elementum ullamcorper porta adipiscing dui, consequat enim <br> quam. Nisi rhoncus vitae orci duis diam eget faucibus. Nulla enim sit nibh sed.</p>
                </div>
                <div class="mt-6 ">
                    <a class="rounded-xl bg-violet-700 p-3 bg-red-400 font-semibold" href="">Make Project</a>
                </div>
            </div>
            <div></div>
        </div>
    </section>
    @yield('main')
</body>
</html>
