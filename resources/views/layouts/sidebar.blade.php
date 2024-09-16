<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/styles/index.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/styles/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <title>Dashboard</title>
</head>

<body>
    @include('sweetalert::alert')
    <div class="screen-cover d-none d-xl-none"></div>
    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
            <aside class="sidebar">
                <a href="/" class="sidebar-logo">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('images/LOGO.png') }}" alt="">
                        <span>Welancer</span>
                    </div>
                    <button id="toggle-navbar" onclick="toggleNavbar()">
                        <img src="./assets/img/global/navbar-times.svg" alt="">
                    </button>
                </a>
                @auth('pegawai')
                    @if (auth()->guard('pegawai')->user()->role == 'freelancer')
                        <h5 class="sidebar-title ">Client</h5>
                        <a href="{{ route('index-diskusi') }}" class="sidebar-item " onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Discussion</span>
                        </a>
                        <a href="" class="sidebar-item " onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Projects</span>
                        </a>
                    @else
                        <h5 class="sidebar-title ">Data Master</h5>

                        <a href="{{ route('skill') }}"
                            class="sidebar-item {{ Request::is('dashboard/skill', 'skill/create') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 1V23" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M17 5H9.5C8.57174 5 7.6815 5.36875 7.02513 6.02513C6.36875 6.6815 6 7.57174 6 8.5C6 9.42826 6.36875 10.3185 7.02513 10.9749C7.6815 11.6313 8.57174 12 9.5 12H14.5C15.4283 12 16.3185 12.3687 16.9749 13.0251C17.6313 13.6815 18 14.5717 18 15.5C18 16.4283 17.6313 17.3185 16.9749 17.9749C16.3185 18.6313 15.4283 19 14.5 19H6"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Skill</span>
                        </a>
                        <a href="{{ route('kategori') }}"
                            class="sidebar-item {{ Request::is('dashboard/kategori') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Category</span>
                        </a>
                        <a href="{{ route('rincian-jasa') }}"
                            class="sidebar-item  {{ Request::is('dashboard/rincianJasa', 'rincian/create') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Service Details</span>
                        </a>
                        <a href="{{ route('paketJasa') }}"
                            class="sidebar-item  {{ Request::is('dashboard/paketJasa', 'paketJasa/create') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Service Package</span>
                        </a>
                        <h5 class="sidebar-title ">Transaction</h5>
                        <a href="{{ route('index-transaksi-admin') }}"
                            class="sidebar-item {{ Request::is('transaksi/indexAdmin') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Transaction</span>
                        </a>
                        <a href="{{ route('index-termin') }}"
                            class="sidebar-item {{ Request::is('payment/index') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Payment</span>
                        </a>
                        <a href="{{ route('index-service-admin') }}"
                            class="sidebar-item {{ Request::is('service/index') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Services</span>
                        </a>
                        <a href="{{ route('index-diskusi') }}" class="sidebar-item " onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Discussion</span>
                        </a>
                        <a href="{{ route('project-index') }}" class="sidebar-item " onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                    stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>Projects</span>
                        </a>
                        <h5 class="sidebar-title ">Setting</h5>

                        <a href="{{ route('setting-termin') }}"
                            class="sidebar-item {{ Request::is('dashboard/skill', 'skill/create') ? 'active' : '' }}"
                            onclick="toggleActive(this)">
                            <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                            </svg>
                            <span>Termin</span>
                        </a>
                    @endif
                @else
                    <h5 class="sidebar-title ">Transaction</h5>
                    <a href="{{ route('index-transaksi') }}"
                        class="sidebar-item {{ Request::is('transaksi/index', 'transaksi/create') ? 'active' : '' }}"
                        onclick="toggleActive(this)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Transaction</span>
                    </a>
                    <a href="{{ route('index-service') }}"
                        class="sidebar-item {{ Request::is('service/index') ? 'active' : '' }}"
                        onclick="toggleActive(this)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>History</span>
                    </a>
                    {{-- <h5 class="sidebar-title ">Group</h5>
                    <a href="{{ route('index-grup') }}" class="sidebar-item " onclick="toggleActive(this)">
                        <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Group</span>
                    </a> --}}
                    <a href="{{ route('index-diskusi') }}" class="sidebar-item " onclick="toggleActive(this)">
                        <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Discussion</span>
                    </a>
                    <a href="{{ route('user-termin') }}"
                        class="sidebar-item {{ Request::is('user/payment') ? 'active' : '' }}"
                        onclick="toggleActive(this)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Payment</span>
                    </a>
                    <a href="{{ route('project-index') }}" class="sidebar-item " onclick="toggleActive(this)">
                        <!-- <img src="./assets/img/global/dollar-sign.svg" alt=""> -->
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Projects</span>
                    </a>
                @endauth

                <!-- <a href="./employees.html" class="sidebar-item"> -->
                <!-- <img src="./assets/img/global/users.svg" alt=""> -->

                <a href="{{ route('logout') }}" class="sidebar-item" onclick="toggleActive(this)">
                    <!-- <img src="./assets/img/global/log-out.svg" alt=""> -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 17L21 12L16 7" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21 12H9" stroke="#ABB3C4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                            stroke="#ABB3C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Logout</span>
                </a>
            </aside>
        </div>
        <div class="col-12 col-xl-9">
            <div class="nav">
                <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
                    <div class="d-flex justify-content-start align-items-center">
                        <button id="toggle-navbar" onclick="toggleNavbar()">
                            <img src="{{ asset('assets/img/global/burger.svg') }}" class="mb-2" alt="">
                        </button>
                        @auth('pegawai')
                            <h2 class="nav-title">Welcome, {{ auth('pegawai')->user()->name }}</h2>
                        @else
                            <h2 class="nav-title">Welcome, {{ auth('web')->user()->name }}</h2>
                        @endauth
                    </div>
                    <button class="btn-notif d-block d-md-none"><img src="{{ asset('assets/img/global/bell.svg') }}"
                            alt=""></button>
                </div>
                <div class="d-flex justify-content-between align-items-center nav-input-container">
                    <div class="nav-input-group">
                        <input type="text" class="nav-input" placeholder="Search people, team, project">
                        <button class="btn-nav-input"><img src="{{ asset('assets/img/global/search.svg') }}"
                                alt=""></button>
                    </div>
                    {{-- <button class="btn-notif d-none d-md-block"><img src="{{ asset('assets/img/global/bell.svg') }}" alt=""></button> --}}
                </div>
            </div>
            <div class="content">
                <div class="row">
                    @yield('main')
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>

            <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable();
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#dataTable2').DataTable();
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#dataTable3').DataTable();
                });
            </script>
            @yield('scripts')
</body>
