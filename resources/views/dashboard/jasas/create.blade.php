@extends('layouts.sidebar')
@section('main')

    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                        <div class="card-body py-5 px-5">
                            <div class="text-center mb-2">
                                    <h1><strong>Add Data Jasa</strong></h1>
                                </div>
                                <form action="{{ route('store-jasa') }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                  @csrf
                                    <div class="col">
                                      <label for="Name" class="form-label">Nama</label>
                                      <input type="text" class="form-control" placeholder="Name" name="nama" id="name" required>
                                  </div>
                                  <div class="col">
                                      <label for="Description" class="form-label">Deskripsi</label>
                                      <input type="text" placeholder="Description" name="deskripsi" class="form-control" id="name" required>
                                  </div>
                                  <label for="min_price" class="form-label">Harga Minimal</label>
                                      <input type="number" placeholder="harga minimal" name="min_price" class="form-control" id="name" required>
                                  <label for=""></label>
                                  <label for="min_price" class="form-label">Harga Maximal</label>
                                      <input type="number" placeholder="harga maximal" name="max_price" class="form-control" id="name" required>
                                  <label for="">Paket Jasa</label>
                                  <select class="form-select" name="paket_jasa" aria-label="Default select example" required>
                                    <option value selected>Pilih Paket Jasa</option>
                                    @foreach ($paketJasas as $paketJasa)
                                        <option value="{{ $paketJasa->id }}">{{ $paketJasa->nama }}</option>
                                    @endforeach
                                  </select>
                                  <label for="">Kategori</label>
                                  <select class="form-select" name="kategori" aria-label="Default select example" required>
                                    <option value selected>Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
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
        <script>
            @if (!empty($errors->all()))
                    @foreach ($errors->all() as $error)
                        toastr.error("{{$error}}")
                    @endforeach
            @endif
        </script>
@endsection
