@extends('layouts.sidebar')
@section('main')
    <section class="bg-white rounded-xl text-black">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="mx-auto max-w-lg text-center">
                <h2 class="text-3xl font-bold sm:text-4xl">Kickstart your project</h2>

                <p class="mt-4 text-black">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur aliquam doloribus
                    nesciunt eos fugiat. Vitae aperiam fugit consequuntur saepe laborum.
                </p>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($sub_grups as $sub_grup)
                    <a class="block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-blue-500/10 hover:shadow-blue-500/10"
                        href="{{ route('project', $sub_grup->id) }}">
                        <img src="{{ asset('images/LOGO.png') }}" alt="">
                        <h2 class="mt-4 text-lg font-bold text-black capitalize">{{ $sub_grup->nama }}</h2>
                        <h2 class="mb-2 text-lg font-semibold text-gray-900">Service Requested:</h2>
                        <ul class="max-w-md space-y-1 text-gray-500 list-inside">
                            @foreach ($sub_grup->detailTransaksi->detailTransaksiJasas as $coba)
                                <li class="flex items-center">
                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 flex-shrink-0"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                    </svg>
                                    {{ $coba->rincianJasa->nama }}
                                </li>
                            @endforeach
                        </ul>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
