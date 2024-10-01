@extends('layouts.sidebar')
@section('main')


<!-- Breadcrumb -->
<nav class="flex px-5 w-fit py-3 text-gray-700 border border-gray-200 rounded-lg bg-white mb-3" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
        Dashboard
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Skills</a>
      </div>
    </li>
  </ol>
</nav>

 <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Master Skill</span>
              <a href="{{ route('create-skill') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($skills as $skill)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $skill->nama }}</td>
                        <td>{{ $skill->deskripsi }}</td>
                        <td class="d-flex gap-2">
                            <button class="button-edit" data-modal-toggle="update-modal-{{ $skill->id }}" data-modal-target="update-modal-{{ $skill->id }}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $skill->id }}"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @foreach ($skills as $skill)
          <!-- update -->
        <div id="update-modal-{{ $skill->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Update Skill Data
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="update-modal-{{ $skill->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="{{ route('update-skill', $skill->id) }}" method="POST">
                            @csrf
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $skill->nama) }}" old class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="skill name" required />
                            </div>
                            <div>
                                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" placeholder="skill description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required >{{ old('deskripsi', $skill->deskripsi) }}</textarea>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @foreach ($skills as $skill)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $skill->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('delete-skill', $skill->id) }}" method="POST">
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
        @section('scripts')
        @if (session('error_list'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Errors',
                        html: `{!! session('error_list') !!}`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                    });
                });
            </script>
        @endif
    @endsection
@endsection
