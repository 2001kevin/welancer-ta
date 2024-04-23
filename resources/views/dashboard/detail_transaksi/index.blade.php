@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Services</span>
          </div>
            <table class="table" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No </th>
                <th scope="col">Service</th>
                <th scope="col">Transaction</th>
                <th scope="col">Range Price</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    @foreach ($service->detail_transaksi as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->jasa->nama}}</td>
                                <td>{{ $item->transaksi->nama }}</td>
                                <td>Rp {{ number_format($item->Minharga_total, 2, ',', '.')  }} - Rp {{number_format($item->Maxharga_total, 2, ',', '.')  }}</td>
                                <td><p class="badge bg-primary">{{ $item->status }}</p></td>
                                <td class="d-flex gap-2">
                                    <button class="button-edit" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-pencil-alt"></i></button>
                                    <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target=""></i></button>
                                </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
@endsection
