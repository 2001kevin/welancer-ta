@extends('layouts.sidebar')
@section('main')

 <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Master Jasa</span>
              <a href="{{ route('create-jasa') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">description</th>
                <th scope="col">Harga</th>
                <th scope="col">Paket Jasa</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jasas as $jasa)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $jasa->nama }}</td>
                        <td>{{ $jasa->deskripsi }}</td>
                        <td>Rp {{ $jasa->min_price }} - Rp {{ $jasa->max_price }}</td>
                        <td>{{ $jasa->paketJasa->nama }}</td>
                        <td>{{ $jasa->kategori->nama }}</td>
                        <td class="d-flex gap-2">
                            <button class="button-edit" data-bs-toggle="modal" data-bs-target="#updateJasa-{{ $jasa->id }}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $jasa->id }}"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @foreach ($jasas as $jasa)
          <!-- update -->
            <div class="modal fade" id="updateJasa-{{ $jasa->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <h1><strong>Update Data Jasa</strong></h1>
                                        </div>
                                        <form action="{{ route('update-jasa', $jasa->id) }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                            @csrf
                                               <div class="col">
                                                    <label for="Name" class="form-label">Nama</label>
                                                    <input value="{{ $jasa->nama }}" type="text" class="form-control" placeholder="Name" name="nama" id="name" required>
                                                </div>
                                                <div class="col">
                                                    <label for="Description" class="form-label">Deskripsi</label>
                                                    <input value="{{ $jasa->deskripsi }}" type="text" placeholder="Description" name="deskripsi" class="form-control" id="name" required>
                                                </div>
                                                <label for="min_price" class="form-label">Harga Minimal</label>
                                                    <input value="{{ $jasa->min_price }}" type="number" placeholder="harga minimal" name="min_price" class="form-control" id="name" required>
                                                <label for="min_price" class="form-label">Harga Maximal</label>
                                                    <input value="{{ $jasa->max_price }}" type="number" placeholder="harga maximal" name="max_price" class="form-control" id="name" required>
                                                <label for="">Paket Jasa</label>
                                                <select class="form-select" name="paket_jasa" aria-label="Default select example">
                                                    <option>Pilih Paket Jasa</option>
                                                    @foreach ($paketJasas as $paketJasa)
                                                        <option {{ $jasa->paketJasa == $paketJasa ? 'selected' : '' }} value="{{ $paketJasa->id }}">{{ $paketJasa->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="">Kategori</label>
                                                <select class="form-select" name="kategori" aria-label="Default select example">
                                                    <option selected>Pilih Kategori</option>
                                                    @foreach ($kategoris as $kategori)
                                                        <option {{ $jasa->kategori == $kategori ? 'selected' : '' }} value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
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
        @endforeach

        @foreach ($jasas as $jasa)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $jasa->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <img
                                src="{{ asset('images/LOGO.png') }}"
                                alt="Welancer"
                                height="40"
                            />
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
                            <form action="{{ route('delete-jasa', $jasa->id) }}" method="POST">
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
