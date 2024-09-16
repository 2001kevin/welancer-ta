@extends('layouts.sidebar')
@php
    use Carbon\Carbon;
@endphp
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Discussion Room</span>
                @auth('pegawai')
                    @if ($project_manager)
                        <button class="button-create ms-auto py-2 px-3 bd-highlight" data-modal-target="crud-modal"
                            data-modal-toggle="crud-modal">Generate Discussion</button>
                    @endif
                @endauth
            </div>
            <table class="table table-auto" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Discussion Type</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Transaction</th>
                        <th scope="col">Schedule</th>
                        <th scope="col">Status</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @auth('pegawai')
                        @foreach ($diskusis as $diskusi)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $diskusi->tipe_diskusi }}</td>
                                <td>{{ $diskusi->users->name }}</td>
                                <td>{{ $diskusi->transaksis->nama }}</td>
                                @if ($diskusi->tanggal_diskusi == null)
                                        @if ($project_manager)
                                        <td>
                                            <button type="button" data-modal-target="schedule-modal-{{ $diskusi->id }}"
                                                data-modal-toggle="schedule-modal-{{ $diskusi->id }}"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2.5 me-2 mb-2 focus:outline-none">Set
                                                Schedule</button>
                                        </td>
                                        @else
                                        <td>
                                            <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2.5 me-2 mb-2 focus:outline-none">PM not scheduled</button>
                                        </td>
                                        @endif
                                @else
                                    <td>{{ Carbon::parse($diskusi->tanggal_diskusi)->format('d F Y') }}</td>
                                @endif
                                @if ($diskusi->status == 'not fixed' || $diskusi->status == 'null')
                                    <td>
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">Waiting</button>
                                    </td>
                                @elseif ($diskusi->status == 'on discussion')
                                    <td>
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 focus:outline-none">On
                                            Discussion</button>
                                    </td>
                                @elseif ($diskusi->status == 'fixed')
                                    <td>
                                        <button type="button"
                                            class="text-white bg-[#16a34a] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 focus:outline-none"><i
                                                class="fa-solid fa-check"></i></button>
                                    </td>
                                @else
                                    <td>
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">Waiting</button>
                                    </td>
                                @endif
                                <td class="text-center"><button class="button-comment"
                                        data-modal-target="comment-modal-{{ $diskusi->id }}"
                                        data-modal-toggle="comment-modal-{{ $diskusi->id }}"><i
                                            class="fa-solid fa-comment"></i></button></td>
                                <td>
                                    <div class="flex gap-1">
                                        @if ($diskusi->status == 'not fixed' || $diskusi->status == null)
                                            <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                    class="fa-solid fa-comment-dots"></i></a>
                                        @elseif($diskusi->tanggal_diskusi < Carbon::now())
                                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                        class="fa-solid fa-comment-dots"></i></a>
                                        @elseif ($diskusi->status == 'on discussion')
                                            <a class="py-[5px] px-[9px] rounded-[12px] bg-[#16c098] hover:bg-[#12AF8A] text-white"
                                                href="{{ route('room-diskusi', $diskusi->id) }}"><i
                                                    class="fa-solid fa-comment-dots"></i></a>
                                        @elseif($diskusi->status == 'fixed')
                                            <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                    class="fa-solid fa-comment-dots"></i></a>
                                        @endif
                                        @if ($project_manager )
                                            <button class="button-edit" data-modal-toggle="update-modal-{{ $diskusi->id }}"
                                                data-modal-target="update-modal-{{ $diskusi->id }}"><i
                                                    class="fas fa-pencil-alt"></i></button>
                                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-"></i></button>
                                        @else
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endauth
                    @auth('web')
                        @foreach ($diskusis as $diskusi)
                            @if ($diskusi->tanggal_diskusi == null)
                            @else
                                <tr class="text-center">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $diskusi->tipe_diskusi }}</td>
                                    <td>{{ $diskusi->users->name }}</td>
                                    <td>{{ $diskusi->transaksis->nama }}</td>
                                    <td>{{ Carbon::parse($diskusi->tanggal_diskusi)->format('d F Y') }}</td>
                                    @if ($diskusi->status == 'not fixed' || $diskusi->status == 'null')
                                        <td>
                                            <form action="{{ route('acc-discussion', $diskusi->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">Agree</button>
                                            </form>
                                        </td>
                                    @elseif($diskusi->status == 'fixed')
                                        <td>
                                            <button type="button"
                                                class="text-white bg-[#16a34a] hover:bg-[#16a34a] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 focus:outline-none"><i
                                                    class="fa-solid fa-check"></i></button>
                                        </td>
                                    @elseif($diskusi->status == 'on discussion')
                                        <td>
                                            <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 focus:outline-none">On
                                                Discussion</button>
                                        </td>
                                    @endif
                                    <td class="text-center"><button class="button-comment"
                                            data-modal-target="comment-modal-{{ $diskusi->id }}"
                                            data-modal-toggle="comment-modal-{{ $diskusi->id }}"><i
                                                class="fa-solid fa-comment"></i></button></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if ($diskusi->status == 'not fixed')
                                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                        class="fa-solid fa-comment-dots"></i></a>
                                            @elseif($diskusi->tanggal_diskusi < Carbon::now())
                                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                        class="fa-solid fa-comment-dots"></i></a>
                                            @elseif ($diskusi->status == 'on discussion')
                                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#16c098] hover:bg-[#12AF8A] text-white"
                                                    href="{{ route('room-diskusi', $diskusi->id) }}"><i
                                                        class="fa-solid fa-comment-dots"></i></a>
                                            @elseif($diskusi->status == 'fixed')
                                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#374151] text-white"><i
                                                        class="fa-solid fa-comment-dots"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endauth
                </tbody>
            </table>
        </div>
    </div>

    {{-- comment modal --}}
    @foreach ($diskusis as $diskusi)
        <div id="comment-modal-{{ $diskusi->id }}" tabindex="-1" aria-hidden="true"
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
                            data-modal-hide="comment-modal-{{ $diskusi->id }}">
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
                        @if (!empty($diskusi->comments))
                            @auth('pegawai')
                                @foreach ($diskusi->comments as $commen)
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
                                @foreach ($diskusi->comments as $commen)
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

                        <form class="max-w-sm mx-auto" action="{{ route('comment', $diskusi->id) }}" method="POST">
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

    {{-- schedule modal --}}
    @foreach ($diskusis as $diskusi)
        <div id="schedule-modal-{{ $diskusi->id }}" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-medium text-gray-900">
                            Set Schedule
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="schedule-modal-{{ $diskusi->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('update-date', $diskusi->id) }}" method="POST">
                        @csrf
                        <div class="p-2 md:p-5 space-y-4">
                            <div class="mb-2">
                                <input type="datetime-local" id="base-input" name="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                            <button data-modal-hide="small-modal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Set</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- edit modal --}}
    @foreach ($diskusis as $diskusi)
        <div id="update-modal-{{ $diskusi->id }}" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-medium text-gray-900">
                            Update Discussion
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="update-modal-{{ $diskusi->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('update-discussion', $diskusi->id) }}" method="POST">
                        @csrf
                        <div class="p-2 md:p-5 space-y-4">
                            <div class="mb-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Select
                                    Status</label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Status</option>
                                    <option {{ $diskusi->status == 'fixed' ? 'selected' : '' }} value="fixed">Fixed
                                    </option>
                                    <option {{ $diskusi->status == 'on discussion' ? 'selected' : '' }}
                                        value="on discussion">On Discussion</option>
                                    <option {{ $diskusi->status == 'no fixed' ? 'selected' : '' }} value="no fixed">no
                                        fixed</option>
                                </select>
                                <div class="mb-2">
                                    <label for="base-input" class="block mb-2 mt-2 text-sm font-medium text-gray-900 ">Schedule</label>
                                    <input type="datetime-local" id="base-input" name="date" value="{{ $diskusi->tanggal_diskusi}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b ">
                            <button data-modal-hide="small-modal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Set</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Create modal -->
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[100%] md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow w-full">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                    <h3 class="text-lg font-semibold text-gray-900 ">
                        Create Discussion
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('store-diskusi') }}" method="POST">
                    @csrf
                    <div class="p-4 md:p-5">
                        <p class="text-gray-500 mb-4">Select Group:</p>
                        <ul class="space-y-4 mb-4">
                            @foreach ($grups as $grup)
                                <li>
                                    <input type="radio" id="grup-{{ $grup->id }}" name="grup"
                                        value="{{ $grup->id }}" class="hidden peer" required />
                                    <label for="grup-{{ $grup->id }}"
                                        class="inline-flex items-center justify-between w-full p-3 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 ">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{ $grup->nama }}</div>
                                            <div class="w-full text-gray-500 peer-checked:text-blue-600">
                                                {{ $grup->transaksis->nama }}
                                            </div>
                                        </div>
                                        <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 peer-checked:"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="col-span-2 mb-2">
                            <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900">Discussion
                                Type</label>
                            <select name="tipe" id="tipe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="">Select Discussion Type</option>
                                <option value="Price Discussion">Price Discussion</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Next step
                        </button>
                    </div>
                </form>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('[data-modal-target]');

            modals.forEach(function(modalTrigger) {
                const modalId = modalTrigger.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);

                if (modal) {
                    modalTrigger.addEventListener('click', function() {
                        modal.classList.remove('hidden');
                        modal.classList.add('block');
                    });

                    modal.querySelector('[data-modal-hide]').addEventListener('click', function() {
                        modal.classList.remove('block');
                        modal.classList.add('hidden');
                    });
                }
            });
        });
    </script>
    <script>
        document.querySelectorAll('input[name="grup"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                let id = this.value;

                // Lakukan panggilan AJAX ke API
                fetch(`/selectPayment/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Bersihkan dropdown tipe
                        let selectTipe = document.getElementById('tipe');
                        selectTipe.innerHTML = `<option selected>Select Discussion Type</option>
                                                <option value="Price Discussion">Price Discussion</option>`;


                        data.forEach((termin, index) => {
                            selectTipe.innerHTML += `<option value="Project Discussion Phase ${index + 1}">Project Discussion Phase ${index + 1}</option>`;
                        });
                        console.log(data);
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
