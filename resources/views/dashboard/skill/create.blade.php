@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                    <div class="card-body py-5 px-5">
                        <div class="text-center mb-2">
                            <h1><strong>Add Data Skill</strong></h1>
                        </div>
                        <form action="{{ route('store-skill') }}" method="POST" class="row sign-up-form form g-3"
                            enctype="multipart/form-data">
                            @csrf
                                <div class="">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text"
                                        class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Name" name="nama" id="name" value="{{ old('nama') }}">
                                </div>
                                <div class="">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea type="text" placeholder="Description" name="deskripsi"
                                        class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500"
                                        id="Description">{{ old('deskripsi') }}</textarea>
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
