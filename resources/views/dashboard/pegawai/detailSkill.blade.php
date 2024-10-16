@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Freelancer</span>
                <button class="button-create ms-auto py-2 px-3 bd-highlight" data-modal-target="crud-modal" data-modal-toggle="crud-modal" >Create</button>
            </div>
            <table class="table table-borderless border-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Skill</th>
                        <th scope="col">Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawaiSkills as $pegawaiSkill)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $pegawaiSkill->skills->nama }}</td>
                            <td>{{ $pegawaiSkill->level }}</td>
                            {{-- @foreach ($pegawai->skills as $skill)
                            <td>{{ $skill->nama }}</td>
                            <td>{{ $skill->pivot->level }}</td>
                        @endforeach --}}
                            <td>
                                <div class="flex gap-2">
                                    <button class="button-edit" data-modal-toggle="update-modal-{{ $pegawaiSkill->id }}"
                                        data-modal-target="update-modal-{{ $pegawaiSkill->id }}"><i
                                            class="fas fa-pencil-alt"></i></button>
                                    <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $pegawaiSkill->id }}"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Add New Skill
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('add-skill') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <input type="text" value="{{ $pegawai->id }}" name="pegawai_id" hidden>
                        <div>
                            <label for="skill" class="block mb-2 text-sm font-medium text-gray-900">Required Skill</label>
                            <select id="skill" name="skill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose skill</option>
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="level" class="block mb-2 text-sm font-medium text-gray-900">Level</label>
                            <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose level</option>
                                <option value="beginner">Beginner</option>
                                <option value="middle">Middle</option>
                                <option value="advance">Advance</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new skill
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update modal -->
    @foreach ($pegawaiSkills as $pegawaiSkill)
        <div id="update-modal-{{ $pegawaiSkill->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Update Skill
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="update-modal-{{ $pegawaiSkill->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('update-pegawai-skill', $pegawaiSkill->id) }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <input type="text" value="{{ $pegawaiSkill->pegawai_id }}" name="pegawai_id" hidden>
                            <div>
                                <label for="skill" class="block mb-2 text-sm font-medium text-gray-900">Required Skill</label>
                                <select id="skill" name="skill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>Choose skill</option>
                                    @foreach ($skills as $skill)
                                        <option {{ $skill->id == $pegawaiSkill->skill_id ? 'selected' : '' }} value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="level" class="block mb-2 text-sm font-medium text-gray-900">Level</label>
                                <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>Choose level</option>
                                    <option {{ $pegawaiSkill->level == 'beginner' ? 'selected' : '' }} value="beginner">Beginner</option>
                                    <option {{ $pegawaiSkill->level == 'middle' ? 'selected' : '' }} value="middle">Middle</option>
                                    <option {{ $pegawaiSkill->level == 'advance' ? 'selected' : '' }} value="advance">Advance</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Update skill
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($pegawaiSkills as $pegawaiSkill)
          <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal-{{ $pegawaiSkill->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('delete-pegawai-skill', $pegawaiSkill->id) }}" method="POST">
                                @csrf
                                <input type="text" value="{{ $pegawaiSkill->pegawai_id }}" name="pegawai_id" hidden>
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
