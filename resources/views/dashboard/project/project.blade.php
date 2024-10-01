@extends('layouts.sidebar')
@section('main')
    <section class="bg-white rounded-xl text-black">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="mx-auto max-w-lg text-center">
                <h2 class="text-3xl font-bold sm:text-4xl">Kickstart your project</h2>

                <p class="mt-4 text-black">
                    <a href="{{ $material->link }}" target="_blank">
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none ">View
                            Material</button>
                    </a>
                </p>
                <p class="mt-2 text-black">
                    <button type="button" data-modal-target="static-modal" data-modal-toggle="static-modal"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none ">View
                        Material Description</button>
                </p>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    @php
                        // Mendapatkan jumlah termin dari setiap project (misal, dari relasi atau kolom di database)
                        $jumlahTermin = count($project->subGrup->transaksi->rincian); // Sesuaikan dengan struktur datamu

                        $completedTermin = 0;

                        // Menghitung jumlah termin yang sudah terbayar berdasarkan status transaksi
                        for ($i = 1; $i <= $jumlahTermin; $i++) {
                            // Jumlah termin dinamis berdasarkan project
                            $terminStatus = 'Termin ' . $i . ' Completed';
                            if ($status_transaksi == $terminStatus) {
                                $completedTermin = $i; // Menghitung termin yang telah diselesaikan
                            }
                        }

                        // Mendapatkan fase project berdasarkan nama project
                        $projectPhase = (int) filter_var($project->nama, FILTER_SANITIZE_NUMBER_INT); // Mendapatkan angka dari nama project
                    @endphp

                    @if ($completedTermin >= $projectPhase)
                        <div class="block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-blue-500/10 hover:shadow-blue-500/10"
                            href="#">
                            <img src="{{ asset('images/LOGO.png') }}" alt="">
                                <a href="{{ route('detail-project', $project->id) }}">
                                    <h2 class="mt-4 text-xl font-bold text-black ">{{ $project->nama }}</h2>
                                </a>
                            <h2 class="mb-2 text-lg font-semibold text-gray-900">Service Requested:</h2>
                            <ul class="max-w-md space-y-1 text-gray-500 list-inside mb-3">
                                @foreach ($project->subGrup->detailTransaksi->detailTransaksiJasas as $coba)
                                    <li class="flex items-center capitalize">
                                        <svg class="w-3.5 h-3.5 me-2 text-green-500 flex-shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        {{ $coba->rincianJasa->nama }}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="flex items-center justify-between gap-4">
                                @if ($project->link == null)
                                    <button type="button"
                                        class="text-white bg-slate-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none"
                                        disabled>View Project</button>
                                @else
                                    <a href="{{ $project->link }}" target="_blank">
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">View
                                            Project</button>
                                    </a>
                                @endif
                                <button class="button-comment" data-modal-target="comment-modal-{{ $project->id }}"
                                    data-modal-toggle="comment-modal-{{ $project->id }}"><i
                                        class="fa-solid fa-comment"></i></button>
                            </div>
                        </div>
                    @elseif ($status_transaksi == 'All Payment Completed')
                        <div class="block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-blue-500/10 hover:shadow-blue-500/10"
                            href="#">
                            <img src="{{ asset('images/LOGO.png') }}" alt="">
                            <a href="{{ route('detail-project', $project->id) }}">
                                <h2 class="mt-4 text-xl font-bold text-black ">{{ $project->nama }}</h2>
                            </a>
                            <h2 class="mb-2 text-lg font-semibold text-gray-900">Service Requested:</h2>
                            <ul class="max-w-md space-y-1 text-gray-500 list-inside mb-3">
                                @foreach ($project->subGrup->detailTransaksi->detailTransaksiJasas as $coba)
                                    <li class="flex items-center capitalize">
                                        <svg class="w-3.5 h-3.5 me-2 text-green-500 flex-shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        {{ $coba->rincianJasa->nama }}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="flex items-center justify-between gap-4">
                                @if ($project->link == null)
                                    <button type="button"
                                        class="text-white bg-slate-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none"
                                        disabled>View Project</button>
                                @else
                                    <a href="{{ $project->link }}" target="_blank">
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">View
                                            Project</button>
                                    </a>
                                @endif
                                <button class="button-comment" data-modal-target="comment-modal-{{ $project->id }}"
                                    data-modal-toggle="comment-modal-{{ $project->id }}"><i
                                        class="fa-solid fa-comment"></i></button>
                            </div>
                        </div>
                    @else
                        <div class="relative bg-white border rounded-xl border-gray-400">
                            <div class="absolute top-50 left-50 w-full text-center">
                                <p><strong>Termin {{ $projectPhase }} not payed</strong></p>
                            </div>
                            <div class="blur-sm">
                                <a class="block rounded-xl border border-gray-800 p-8 shadow-xl">
                                    <img src="{{ asset('images/LOGO.png') }}" alt="">
                                    <h2 class="mt-4 text-xl font-bold text-black">{{ $project->nama }}</h2>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex ut quo possimus adipisci
                                        distinctio alias voluptatum blanditiis laudantium.
                                    </p>
                                    <button class="button-comment"><i class="fa-solid fa-comment"></i></button>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </section>

    <!-- Main modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Material Description
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500">
                        {{ $material->detail }} </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="static-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- comment modal --}}
    @foreach ($projects as $project)
        <div id="comment-modal-{{ $project->id }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-medium text-gray-900">
                            Comment
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="comment-modal-{{ $project->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        {{-- isi comment --}}
                        @if (!empty($project->comments))
                            @auth('pegawai')
                                @foreach ($project->comments as $commen)
                                    @if ($commen->senderUser_id == null)
                                        <div class="flex justify-end items-start gap-2.5">
                                            <div
                                                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-r-xl">
                                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                    <span
                                                        class="text-sm font-semibold text-gray-900">{{ $commen->pegawai == null ? '' : $commen->pegawai->name }}</span>
                                                    <span
                                                        class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::parse($commen['created_at'])->format('H:i, d M Y') }}</span>
                                                </div>
                                                <p class="text-sm font-normal py-2.5 text-gray-900">{{ $commen->comment }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-start items-end gap-2.5">
                                            <div
                                                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-l-xl">
                                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                    <span
                                                        class="text-sm font-semibold text-gray-900">{{ $commen->user == null ? '' : $commen->user->name }}</span>
                                                    <span
                                                        class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::parse($commen['created_at'])->format('H:i, d M Y') }}</span>
                                                </div>
                                                <p class="text-sm font-normal py-2.5 text-gray-900">{{ $commen->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endauth
                            @auth('web')
                                @foreach ($project->comments as $commen)
                                    @if ($commen->senderUser_id == null)
                                        <div class="flex justify-start items-start gap-2.5">
                                            <div
                                                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-r-xl">
                                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                    <span
                                                        class="text-sm font-semibold text-gray-900">{{ $commen->pegawai == null ? '' : $commen->pegawai->name }}</span>
                                                    <span
                                                        class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::parse($commen['created_at'])->format('H:i, d M Y') }}</span>
                                                </div>
                                                <p class="text-sm font-normal py-2.5 text-gray-900">{{ $commen->comment }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-end items-end gap-2.5">
                                            <div
                                                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-l-xl">
                                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                    <span
                                                        class="text-sm font-semibold text-gray-900">{{ $commen->user == null ? '' : $commen->user->name }}</span>
                                                    <span
                                                        class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::parse($commen['created_at'])->format('H:i, d M Y') }}</span>
                                                </div>
                                                <p class="text-sm font-normal py-2.5 text-gray-900">{{ $commen->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endauth
                        @else
                            <p class="text-sm text-gray-500">Belum ada komentar.</p>
                        @endif

                        <form class="max-w-sm mx-auto" action="{{ route('comment-project', $project->id) }}"
                            method="POST">
                            @csrf
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Your
                                Comment</label>
                            <textarea id="message" rows="4" name="comment"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Leave a comment..."></textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                        <button data-modal-hide="small-modal" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Send</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
