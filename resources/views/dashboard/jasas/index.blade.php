@extends('layouts.sidebar')
@section('main')
        <div class="card border-0 shadow mb-4" style="width: 65rem;">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                    <span class="title-welancer ms-3">Services</span>
                    <a href="{{ route('create-jasa', $kategori_id) }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
                </div>
                    <table class="table table-borderless border-0" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Service</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($jasas as $jasa)
                            <tr>
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{{ $jasa->nama }}</td>
                                <td>{{ $jasa->deskripsi }}</td>
                                <td>{{ formatCurrency( $jasa->min_price, $currency[0]) }} - {{ formatCurrency( $jasa->max_price, $currency[0]) }}</td>
                                <td>{{ $jasa->kategori->nama }}</td>
                                <td class="d-flex gap-2">
                                    <button class="button-edit" data-modal-toggle="update-modal-{{ $jasa->id }}" data-modal-target="update-modal-{{ $jasa->id }}"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $jasa->id }}"></i></button>
                                    <button class="button-group"><a class="text-white" href="{{ route('detail-subJasa', $jasa->id) }}"><i class="fa-solid fa-ellipsis"></i></a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
      </div>

      {{-- Modal Update jasa --}}
      @foreach ($jasas as $jasa)
          <!-- update -->
          <div id="update-modal-{{ $jasa->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Update Service Data
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="update-modal-{{ $jasa->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="{{ route('update-jasa', $jasa->id) }}" method="POST">
                            @csrf
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $jasa->nama) }}" old class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="skill name" required />
                            </div>
                            input
                            <div>
                                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" placeholder="skill description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required >{{ old('deskripsi', $jasa->deskripsi) }}</textarea>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Modal Delete jasa --}}
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

       {{-- <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Service Details</span>
              <a href="{{ route('detail-jasa') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable2">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Jasa</th>
                <th scope="col">Skill</th>
                <th scope="col">Rincian</th>
                <th scope="col">Employee</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rincians as $rincian)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $rincian->nama_jasa }}</td>
                        <td>{{ $rincian->nama_skill }}</td>
                        <td>{{ $rincian->nama }}</td>
                        <td>{{ $rincian->nama_pegawai }}</td>
                        <td class="d-flex gap-2">
                            <button class="button-edit" data-bs-toggle="modal" data-bs-target="#updateDetailJasa-{{ $rincian->detail_jasa_id }}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteDetailJasa-{{ $rincian->detail_jasa_id }}"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div> --}}

      {{-- Modal Update Detail Jasa --}}
      @foreach ($detailJasas as $detailJasa)
          <!-- update -->
            <div class="modal fade" id="updateDetailJasa-{{ $detailJasa->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <h1><strong>Update Service Detail</strong></h1>
                                        </div>
                                        <form action="{{ route('update-detail-jasa', $detailJasa->id) }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                        @csrf
                                        <label for="">Skill</label>
                                        <select class="form-select" name="skill" aria-label="Default select example" required>
                                            <option>Pilih Skill</option>
                                                @foreach ($skills as $skill)
                                                    <option {{ $detailJasa->skill == $skill ? 'selected' : '' }} value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                                @endforeach
                                        </select>
                                        <label for="">Rincian Jasa</label>
                                        <select class="form-select" name="rincianJasa" aria-label="Default select example" required>
                                            <option>Pilih Rincian Jasa</option>
                                                @foreach ($rincians as $rincian)
                                                    <option {{ $detailJasa->rincianJasa == $rincian ? 'selected' : '' }} value="{{ $rincian->id }}">{{ $rincian->nama }}</option>
                                                @endforeach
                                        </select>
                                        <label for="">Pegawai</label>
                                        <select class="form-select" name="pegawai" aria-label="Default select example" required>
                                            <option>Pilih Pegawai</option>
                                                @foreach ($pegawais as $pegawai)
                                                    <option {{ $detailJasa->pegawai == $pegawai ? 'selected' : '' }} value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
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

        {{-- Modal Delete Detail jasa --}}
        @foreach ($detailJasas as $detailJasa)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteDetailJasa-{{ $detailJasa->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('delete-detail-jasa', $detailJasa->id) }}" method="POST">
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
