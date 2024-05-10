@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Discussion Room</span>
                <button class="button-create ms-auto py-2 px-3 bd-highlight" data-modal-target="crud-modal"
                    data-modal-toggle="crud-modal">Create</button>
            </div>
            <table class="table table-auto" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Discussion Type</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Transaction</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diskusis as $diskusi)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $diskusi->tipe_diskusi }}</td>
                            <td>{{ $diskusi->users->name }}</td>
                            <td>{{ $diskusi->transaksis->nama }}</td>
                            <td class="d-flex gap-2">
                                <a class="py-[5px] px-[9px] rounded-[12px] bg-[#16c098] hover:bg-[#12AF8A] text-white"
                                    href="{{ route('room-diskusi', $diskusi->id) }}"><i class="fa-solid fa-comment-dots"></i></a>
                                <button class="button-edit" data-bs-toggle="modal" data-bs-target="#updateSkill-"><i
                                        class="fas fa-pencil-alt"></i></button>
                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
                        <div class="col-span-2 mb-2">
                            <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900">Discussion
                                Type</label>
                            <input type="text" name="tipe" id="tipe"
                                class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="Discussion Type" required="">
                        </div>
                        <p class="text-gray-500 mb-4">Select Group:</p>
                        <ul class="space-y-4 mb-4">
                            @foreach ($grups as $grup)
                                <li>
                                    <input type="checkbox" id="grup-{{ $grup->id }}" name="grup"
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
                        <button type="submit"
                            class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Next step
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
