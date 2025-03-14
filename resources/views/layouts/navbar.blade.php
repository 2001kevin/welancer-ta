<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/LOGO.png') }}">
    <title>Welancer</title>
</head>

<body>
    @include('sweetalert::alert')
    @yield('content')
    <section class="header">
        <div class="content flex flex-col justify-between">
            <nav class="sticky w-full z-20 top-0 start-0 flex justify-between py-7 px-32 text-white items-center"
                id="nav">
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
                            <span class="mr-1 text-white">Welcome, {{ auth('pegawai')->user()->name }}</span>
                            <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                            <li class=""><a
                                    class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="">
                                <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="{{ route('logout') }}">logout</a>
                            </li>
                        </ul>
                    </div>
                @else
                    @auth('web')
                        <div class="dropdown inline-block relative">
                            <button class="bg-violet-700 font-semibold py-2 px-6 rounded-xl inline-flex items-center">
                                <span class="mr-1 text-white">Welcome, {{ auth('web')->user()->name }}</span>
                                <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                <li class=""><a
                                        class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="">
                                    <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('logout') }}">logout</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div>
                            <a class="font-medium text-white py-2 px-6 bg-violet-700 rounded-xl"
                                href="{{ route('login-user') }}">Login</a>
                        </div>
                    @endauth
                @endauth
            </nav>
            <div class="flex flex-col px-32 text-white ">
                <div class="text-7xl font-bold mb-3">
                    <H1>Are you looking for <br>making your project?</H1>
                </div>
                <div class="text-xs text-slate-400 mb-3">
                    <p>Come and make your project with us <br> we make the best quality for making project</p>
                </div>
                @auth('pegawai')
                    @else
                        <div class="mt-6 ">
                            <a class="rounded-xl bg-violet-700 p-3 bg-red-400 font-semibold"
                                href="{{ route('create-transaksi') }}">Make Project</a>
                        </div>
                @endauth

            </div>
            <div></div>
        </div>
        @yield('main')
    </section>
    <script>
        const navbar = document.querySelector('#nav')

        window.addEventListener('scroll', function(e) {
            const lastPosition = window.scrollY
            if (lastPosition > 50) {
                navbar.classList.add('active')
                navbar.classList.add('text-black')
                navbar.classList.add('transition')
                navbar.classList.remove('text-white')
            } else if (navbar.classList.contains('active')) {
                navbar.classList.remove('active')
                navbar.classList.add('text-white')
                navbar.classList.remove('text-black')
                navbar.classList.remove('transition')
            } else {
                navbar.classList.remove('active')
            }
        })
    </script>
</body>

</html>
