@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                <span class="title-welancer ms-3">Freelancer</span>
                <button class="button-create ms-auto py-2 px-3 bd-highlight" data-modal-target="crud-modal"
                    data-modal-toggle="crud-modal">Create</button>
            </div>
            <table class="table table-borderless border-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Required Skill</th>
                        <th scope="col">Freelancer</th>
                        <th scope="col">Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailJasas as $detailJasa)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $detailJasa->skill->nama }}</td>
                            <td>{{ $detailJasa->pegawai->name }}</td>
                            <td>{{ $detailJasa->level }}</td>
                            {{-- @foreach ($pegawai->skills as $skill)
                            <td>{{ $skill->nama }}</td>
                            <td>{{ $skill->pivot->level }}</td>
                        @endforeach --}}
                            <td>
                                <div class="flex gap-2">
                                    <button class="button-edit" data-modal-toggle="update-modal-{{ $detailJasa->id }}"
                                        data-modal-target="update-modal-{{ $detailJasa->id }}"><i
                                            class="fas fa-pencil-alt"></i></button>
                                    <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-{{ $detailJasa->id }}"></i></button>
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
                        Add New Freelancer
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
                <form class="p-4 md:p-5" action="{{ route('add-detail-jasa', $rincianJasa->id) }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <input type="text" value="{{ $rincianJasa->id }}" name="rincian_jasa_id" hidden>
                        <div>
                            <label for="skill" class="block mb-2 text-sm font-medium text-gray-900">Required
                                Skill</label>
                            <select id="skill" name="skill"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose skill</option>
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pegawai" class="block mb-2 text-sm font-medium text-gray-900">Assigned to</label>
                            <select id="pegawai" name="pegawai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose a freelancer</option>
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
                        Add new freelancer
                    </button>
                </form>
            </div>
        </div>
    </div>
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
        <script>
            document.getElementById('skill').addEventListener('change', function() {
                var skillId = this.value;

                // Jika skill belum dipilih, kosongkan pegawai
                if (skillId === "Choose skill") {
                    document.getElementById('pegawai').innerHTML = '<option selected>Choose a freelancer</option>';
                    return;
                }

                // Lakukan AJAX request ke server
                fetch(`/get-pegawais-by-skill/${skillId}`)
                    .then(response => response.json())
                    .then(data => {
                        var pegawaiSelect = document.getElementById('pegawai');
                        pegawaiSelect.innerHTML = '<option selected>Choose a freelancer</option>';

                        // Isi dropdown pegawai dengan data yang diterima
                        data.forEach(function(pegawai) {
                            var option = document.createElement('option');
                            option.value = pegawai.id;
                            option.text = pegawai.name;
                            pegawaiSelect.appendChild(option);
                        });
                    });
            });
        </script>
    @endsection
@endsection
