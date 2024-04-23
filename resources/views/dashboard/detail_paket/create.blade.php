@extends('layouts.sidebar')
@section('main')
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                        <div class="card-body py-5 px-5">
                            <div class="text-center mb-2">
                                    <h1><strong>Add Detail Service Package</strong></h1>
                                </div>
                                <form action="{{ route('store-detail-paket') }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                  @csrf
                                  <label for="">Paket Jasa</label>
                                  <select class="form-select" name="paket_jasa" aria-label="Default select example" required>
                                        <option value selected>Pilih Paket Jasa</option>
                                        @foreach ($paketJasas as $paketJasa)
                                            <option value="{{ $paketJasa->id }}">{{ $paketJasa->nama }}</option>
                                        @endforeach
                                  </select>
                                  <label for="">Jasa</label>
                                  <select class="form-select" name="jasa" aria-label="Default select example" required>
                                        <option value selected>Pilih Jasa</option>
                                        @foreach ($jasas as $jasa)
                                            <option value="{{ $jasa->id }}">{{ $jasa->nama }}</option>
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
@endsection
