@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Master Rincian Jasa</span>
                <a href="." class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
            </div>
            <table class="table table-borderless border-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">jasa</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rincianJasas as $rincian)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $rincian->nama }}</td>
                            <td>{{ $rincian->jasa->nama }}</td>
                            <td class="d-flex gap-2">
                                <button class="button-edit" data-modal-toggle="update-modal-{{ $rincian->id }}"
                                    data-modal-target="update-modal-{{ $rincian->id }}"><i
                                        class="fas fa-pencil-alt"></i></button>
                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $rincian->id }}"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- @foreach ($rincianJasas as $rincian)
        <!-- update -->
        <div class="modal fade" id="updateRincian-{{ $rincian->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                            <span class="title-welancer ms-3">Welancer </span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="card mb-4 mx-4 mt-4 shadow-lg border-0">
                                    <div class="card-body py-5 px-5">
                                        <div class="text-center">
                                            <h1><strong>Update Data Rincian</strong></h1>
                                        </div>
                                        <form action="{{ route('update-rincian', $rincian->id) }}" method="POST"
                                            class="row sign-up-form form g-3" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col">
                                                <label for="Name" class="form-label">Nama</label>
                                                <input value="{{ $rincian->nama }}" type="text" class="form-control"
                                                    placeholder="Name" name="nama" id="name" required>
                                            </div>
                                            <label for="jasa">Jasa</label>
                                            <select class="form-select" name="jasa" aria-label="Default select example"
                                                required>
                                                <option>Pilih Jasa</option>
                                                @foreach ($jasas as $jasa)
                                                    <option {{ $rincian->jasa == $jasa ? 'selected' : '' }}
                                                        value="{{ $jasa->id }}">{{ $jasa->nama }}</option>
                                                @endforeach
                                            </select>
                                            <div class="col d-grid gap-2 purple button-submit">
                                                <button type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

    @foreach ($rincianJasas as $rincian)
        <div id="update-modal-{{ $rincian->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[100%] md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow w-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 class="text-lg font-semibold text-gray-900 ">
                            Update Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="update-modal-{{ $rincian->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('update-rincian', $rincian->id) }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5">
                            <div class="mb-3">
                                <label for="jasa_id" class="block mb-2 text-sm font-medium text-gray-900 ">From
                                    Service</label>
                                <select id="jasa_id" name="jasa_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option>Pilih Jasa</option>
                                    @foreach ($jasas as $jasa)
                                        <option {{ $rincian->jasa == $jasa ? 'selected' : '' }}
                                            value="{{ $jasa->id }}">{{ $jasa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 mb-2">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="name" value="{{ $rincian->nama }}" required="">
                            </div>
                            <div class="mb-3">
                                <label for="unit_type" class="block mb-2 text-sm font-medium text-gray-900 ">Choose Unit
                                    Type</label>
                                <select id="unit_type" name="unit_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option>Unit Type</option>
                                    <option {{ $rincian->tipe_unit == 'minute' ? 'selected' : '' }} value="minute">minute
                                    </option>
                                    <option {{ $rincian->tipe_unit == 'unit' ? 'selected' : '' }} value="unit">Unit
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-2 mb-2">
                                <label for="unit" class="block mb-2 text-sm font-medium text-gray-900">Unit</label>
                                <input type="number" name="unit" id="unit" oninput="validity.valid||(value='');"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="unit" value="{{ $rincian->unit }}" required="">
                            </div>
                            <div class="col-span-2 mb-2">
                                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Price per
                                    Unit</label>
                                <input type="number" name="harga" id="harga" oninput="validity.valid||(value='');"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="price per unit" value="{{ $rincian->harga }}" required="">
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

    @foreach ($rincianJasas as $rincian)
        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal-{{ $rincian->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="{{ asset('images/LOGO.png') }}" alt="Welancer" height="40" />
                        <h2>Welancer</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this data?
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-secondary">
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <form action="{{ route('delete-rincian', $rincian->id) }}" method="POST">
                            @csrf
                            <div class="btn-logout">
                                <button type="submit" class=" border-0">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
