@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5">
                        <div class="text-center mb-2">
                            <h1><strong>Add Freelancer</strong></h1>
                        </div>
                        <form action="{{ route('store-pegawai') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="nama" name="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="freelancer name" required />
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="freelancer email" required />
                            </div>
                            <div class="mb-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="*******" required />
                            </div>
                            <div class="mb-6">
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Password Confirmation</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="*******" required />
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="hp" class="block mb-2 text-sm font-medium text-gray-900">
                                        Handphone Number</label>
                                    <input type="number" id="hp" name="hp" min="0" oninput="validity.valid||(value='');"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="handphone number" required />
                                </div>
                                <div>
                                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                                    <input type="text" id="alamat" name="alamat"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="freelancer address" required />
                                </div>
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
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-[50vh] sm:w-auto px-5 py-2.5 text-center">Submit</button>
                        </form>
                    </div>
                </div>
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
    @endsection
@endsection
