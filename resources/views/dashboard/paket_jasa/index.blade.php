@extends('layouts.sidebar')
@section('main')

 <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Master Paket Jasa</span>
              <a href="{{ route('create-paketJasa') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($paketJasas as $paketJasa)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $paketJasa->nama }}</td>
                        <td>{{ $paketJasa->deskripsi }}</td>
                        <td>
                            <button class="button-edit" data-bs-toggle="modal" data-bs-target="#updatePJ-{{ $paketJasa->id }}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $paketJasa->id }}"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @foreach ($paketJasas as $paketJasa)
          <!-- update -->
            <div class="modal fade" id="updatePJ-{{ $paketJasa->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <h1><strong>Update Data Paket Jasa</strong></h1>
                                        </div>
                                        <form action="{{ route('update-paketJasa', $paketJasa->id) }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                            @csrf
                                                <div class="col-md-6">
                                                <label for="Name" class="form-label">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" name="nama" id="name" value="{{ $paketJasa->nama }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Description" class="form-label">Description</label>
                                                <input type="text" placeholder="Description" name="deskripsi" class="form-control" id="name" value="{{ $paketJasa->deskripsi }}"  required>
                                            </div>
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

        @foreach ($paketJasas as $paketJasa)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $paketJasa->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('delete-paketJasa', $paketJasa->id) }}" method="POST">
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
