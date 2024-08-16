@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Transaction</span>
                @auth('web')
                    <a href="{{ route('create-transaksi') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Make
                        Project</a>
                @endauth
            </div>
            @if ($transaksis->count() > 0)
                <table class="table " id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Approval Employee</th>
                            <th scope="col">Cattegory</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            @auth('pegawai')
                                <th scope="col">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                @if ($transaksi->fix_price == null)
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $transaksi->nama }}</td>
                                    @isset($transaksi->pegawai)
                                        <td>{{ $transaksi->pegawai->name }}</td>
                                    @else
                                        <td>Transaction Not Approve Yet</td>
                                    @endisset
                                    <td>{{ $transaksi->kategori->nama }}</td>
                                    <td>{{ $transaksi->jumlah_harga }}</td>
                                    <td class="text-center">
                                        <p class="badge bg-primary">{{ $transaksi->status }}</p>
                                    </td>
                                    @auth('pegawai')
                                        <td>
                                            <div class="flex gap-2">
                                                <button class="button-group"><a href="{{ route('index-grup', $transaksi->id) }}" class="text-white"><i class="fas fa-user-friends"></i></a></button>
                                                <button class="button-edit" data-modal-target="crud-modal-{{ $transaksi->id }}"
                                                    data-modal-toggle="crud-modal-{{ $transaksi->id }}"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                                        data-bs-target=""></i></button>
                                            </div>
                                        </td>
                                    @endauth
                                @else
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $transaksi->nama }}</td>
                                    @isset($transaksi->pegawai)
                                        <td>{{ $transaksi->pegawai->name }}</td>
                                    @else
                                        <td>Transaction Not Approve Yet</td>
                                    @endisset
                                    <td>{{ $transaksi->kategori->nama }}</td>
                                    <td>@currency($transaksi->fix_price)</td>
                                    <td class="text-center">
                                        <p class="badge bg-primary">{{ $transaksi->status }}</p>
                                    </td>
                                    @auth('pegawai')
                                        <td>
                                            <div class="flex gap-2">
                                                <button class="button-group"><a href="{{ route('index-grup', $transaksi->id) }}" class="text-white"><i class="fas fa-user-friends"></i></a></button>
                                                <button class="button-edit" data-modal-target="crud-modal-{{ $transaksi->id }}"
                                                    data-modal-toggle="crud-modal-{{ $transaksi->id }}"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                                        data-bs-target=""></i></button>
                                            </div>
                                        </td>
                                    @endauth
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No transactions found.</p>
            @endif
        </div>
    </div>

    {{-- edit modal --}}
    @foreach ($transaksis as $transaksi)
        <div id="crud-modal-{{ $transaksi->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[100%] md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow w-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 class="text-lg font-semibold text-gray-900 ">
                            Update Transaction
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal-{{ $transaksi->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="" method="POST">
                        @csrf
                        <div class="p-4 md:p-5">
                            <p class="mb-3">Range Price : {{ $transaksi->jumlah_harga }}</p>
                            <div class="col-span-2 mb-2">
                                <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900">Fix Price</label>
                                <input type="text" name="tipe" id="tipe"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    name="jumlah_harga" placeholder="fix price" required="">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Select
                                    Status</label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Status</option>
                                    <option {{ $transaksi->status == 'On Negotiations' ? 'selected' : '' }}
                                        value="On Negotiations">On Negotiations</option>
                                    <option {{ $transaksi->status == 'Waiting for Payment' ? 'selected' : '' }}
                                        value="Waiting for Payment">Waiting for Payment</option>
                                    <option {{ $transaksi->status == 'On Progress' ? 'selected' : '' }}
                                        value="On Progress">On Proress</option>
                                    <option {{ $transaksi->status == 'Finish' ? 'selected' : '' }} value="Finish">Finish
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                Submit
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
