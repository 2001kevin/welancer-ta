@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5 ">
                        <div class="text-center mb-2">
                            <h1 class="text-3xl"><strong>Add Group for <span class="capitalize">{{ $transaksi->nama }}</span>
                                    Transaction</strong></h1>
                        </div>
                        <form action="{{ route('grup-store') }}" method="POST" class="row sign-up-form form g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="{{ $transaksi->id }}" name="transaksi_id" class="hidden" >
                            <div>
                                <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="small-input"
                                    class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="name" name="name">
                            </div>
                            <label>Project Manager</label>
                            <div class="mt-2">
                                <select class="js-example-basic-single w-full py-4" name="pm">
                                    <option>Choose Employee</option>
                                    @foreach ($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="font-semibold">Sub Group : </p>
                            @foreach ($detailTransaksis as $detailTransaksi)
                                <div class="card mb-2 shadow-md">
                                    <div
                                        class="card-body py-5 px-5 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')]">
                                        <div class="text-center mb-2">
                                            <h1 class=""><strong><span
                                                        class="capitalize">{{ $detailTransaksi->jasa->nama }}</span>
                                                    Service</strong></h1>
                                        </div>
                                        <input type="text" value="{{ $detailTransaksi->id }}" class="hidden" name="detail_transaksi_id">
                                        <div class="mb-2">
                                            <label for="small-input"
                                                class="block mb-2 text-sm font-medium text-gray-900">Sub Group Name</label>
                                            <input type="text" id="small-input"
                                                class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="name" name="sub_name[]">
                                        </div>
                                        <label>Assigned To</label>
                                        <div class="mt-2">
                                            <select class="js-example-basic-single w-full py-4" name="pegawai[]">
                                                <option>Choose Employee</option>
                                                @foreach ($pegawais as $pegawai)
                                                    <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
