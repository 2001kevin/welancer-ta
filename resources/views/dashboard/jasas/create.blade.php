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
                                   <div class="mb-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                        <input type="text" id="name" name="nama" class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="Service Name" />
                                  </div>
                                  <div class="mb-2">
                                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                        <textarea id="message" rows="4" name="deskripsi" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Service Description" required></textarea>
                                  </div>
                                  <div class="mb-3">
                                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                        <input type="text" id="kategori" value="{{ $kategori->nama }}" readonly class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" required />
                                        <input type="text" name="kategori" value="{{ $kategori->id }}" hidden>
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
