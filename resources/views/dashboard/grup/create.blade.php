@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5">
                        <div class="text-center mb-2">
                            <h1><strong>Add Group</strong></h1>
                        </div>
                        <form action="{{ route('grup-store') }}" method="POST" class="row sign-up-form form g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col">
                                <label for="Name" class="form-label">Name Group</label>
                                <input type="text" class="form-control" placeholder="Name" name="nama" id="name"
                                    required>
                            </div>
                            <label for="">Employee</label>
                            <select class="form-select" name="pegawai" aria-label="Default select example" required>
                                <option>Choose Employee</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Transaction</label>
                            <select class="form-select" name="transaksi" aria-label="Default select example" required>
                                <option>Choose Transaction</option>
                                @foreach ($transaksis as $transaksi)
                                    <option value="{{ $transaksi->id }}">{{ $transaksi->nama }}</option>
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
@endsection
