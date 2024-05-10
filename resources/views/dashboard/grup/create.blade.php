@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5">
                        <div class="text-center mb-2">
                            <h1><strong>Add Group for <span class="capitalize">{{ $transaksi->nama }}</span> Transaction</strong></h1>
                        </div>
                        <form action="{{ route('grup-store') }}" method="POST" class="row sign-up-form form g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="small-input"
                                    class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500" placeholder="name">
                            </div>
                            <label>Project Manager</label>
                            <div class="mt-2">
                                <select class="js-example-basic-single w-full py-4">
                                    <option>Choose Employee</option>
                                    @foreach ($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </select>
                            {{-- <label for="">Transaction</label>
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="small-input"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" placeholder="name">
                            </div> --}}
                            <div class="col d-grid gap-2 purple button-submit">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
