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

                                <form action="{{ route('store-skill') }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                  @csrf
                                    <div class="col-md-6">
                                      <label for="Name" class="form-label">Name</label>
                                      <input type="text" class="form-control" placeholder="Name" name="nama" id="name" required>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="Description" class="form-label">Description</label>
                                      <input type="text" placeholder="Description" name="deskripsi" class="form-control" id="name" required>
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
@endsection
