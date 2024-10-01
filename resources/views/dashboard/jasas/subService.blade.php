@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                        <span class="title-welancer ms-3">Sub Services</span>
                        <a href="{{ route('create-rincian', $jasa->id) }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
                    </div>
                        <table class="table table-borderless border-0" id="dataTable">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Sub Service</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Unit Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Required Skill</th>
                            <th scope="col">Assigned To</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailJasas as $detailJasa)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $detailJasa->rincianJasa->nama }}</td>
                                    <td>{{ $detailJasa->rincianJasa->unit }}</td>
                                    <td>{{ $detailJasa->rincianJasa->tipe_unit }}</td>
                                    <td>{{ formatCurrency($detailJasa->rincianJasa->harga, $currency[0]) }}</td>
                                    <td>{{ $detailJasa->skill->nama}}</td>
                                    <td>{{ $detailJasa->pegawai->name}}</td>
                                    <td class="d-flex gap-2">
                                        <button class="button-edit" data-bs-toggle="modal" data-bs-target="#updateJasa-"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
@endsection
