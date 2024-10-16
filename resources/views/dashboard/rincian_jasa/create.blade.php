@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5">
                        <div class="text-center mb-2">
                            <h1><strong>Add Sub Service</strong></h1>
                        </div>

                        <form action="{{ route('store-rincian') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="nama" name="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="sub service name" required />
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Unit</label>
                                    <input type="number" id="first_name" name="unit" min="0" oninput="validity.valid||(value='');"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="unit" required />
                                </div>
                                <div>
                                    <label for="unit_type" class="block mb-2 text-sm font-medium text-gray-900">Tipe Unit</label>
                                    <input type="text" id="unit_type" name="unit_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="unit type" required />
                                </div>

                            </div>
                            <input type="text" name="jasa" value="{{ $jasa->id }}" hidden>
                            <div class="mb-6">
                                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                <input type="number" id="harga" name="harga" min="0" oninput="validity.valid||(value='');"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="sub service price" required />
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-[50vh] sm:w-auto px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
