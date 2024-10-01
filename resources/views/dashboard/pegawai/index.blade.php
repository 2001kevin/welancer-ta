@extends('layouts.sidebar')
@section('main')

 <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Freelancer</span>
              <a href="{{ route('create-pegawai') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">No Handphone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pegawais as $pegawai)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $pegawai->name }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->hp }}</td>
                        {{-- @foreach ($pegawai->skills as $skill)
                            <td>{{ $skill->nama }}</td>
                            <td>{{ $skill->pivot->level }}</td>
                        @endforeach --}}
                        <td>
                            <div class="flex gap-2">
                                <button class="button-group"><a class="text-white" href="{{ route('freelancer-skill', $pegawai->id) }}"><i class="fa-regular fa-folder-open"></i></a></button>
                                <button class="button-edit" data-modal-toggle="update-modal-{{ $pegawai->id }}" data-modal-target="update-modal-{{ $pegawai->id }}"><i class="fas fa-pencil-alt"></i></button>
                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $pegawai->id }}"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @foreach ($pegawais as $pegawai)
          <!-- update -->
        <div id="update-modal-{{ $pegawai->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Update Category Data
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="update-modal-{{ $pegawai->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="{{ route('update-kategori', $pegawai->id) }}" method="POST">
                            @csrf
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $pegawai->name) }}" old class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="skill name" required />
                            </div>
                            <div>
                                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" placeholder="skill description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required >{{ old('deskripsi', $pegawai->alamat) }}</textarea>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach ($pegawais as $pegawai)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $pegawai->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="" method="POST">
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
