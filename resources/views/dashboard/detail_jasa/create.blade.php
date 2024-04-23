@extends('layouts.sidebar')
@section('main')

    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card mb-4 mx-4 mt-4 border-0 shadow">
                        <div class="card-body py-5 px-5">
                            <div class="text-center mb-2">
                                    <h1><strong>Add Data Detail Jasa</strong></h1>
                                </div>
                                <form action="{{ route('store-detail-jasa') }}" method="POST" class="row sign-up-form form g-3" enctype="multipart/form-data">
                                  @csrf
                                  <label for="">Skill</label>
                                  <select class="form-select" name="skill" aria-label="Default select example" required>
                                    <option>Pilih Skill</option>
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->nama }}</option>
                                        @endforeach
                                  </select>
                                  <label for="">Rincian Jasa</label>
                                  <select class="form-select" name="rincianJasa" aria-label="Default select example" required>
                                    <option>Pilih Rincian Jasa</option>
                                        @foreach ($rincians as $rincian)
                                            <option value="{{ $rincian->id }}">{{ $rincian->nama }}</option>
                                        @endforeach
                                  </select>
                                  <label for="">Pegawai</label>
                                  <select class="form-select" name="pegawai" aria-label="Default select example" required>
                                    <option>Pilih Pegawai</option>
                                        @foreach ($pegawais as $pegawai)
                                            <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
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
