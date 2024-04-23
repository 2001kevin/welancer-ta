@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Transaction</span>
              @auth('pegawai')
                @else
                <a href="{{ route('create-transaksi') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Make Project</a>
              @endauth
          </div>
          @if ($transaksis->count() > 0)
            <table class="table " id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Approval Employee</th>
                <th scope="col">Cattegory</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $transaksi->nama }}</td>
                        @isset($transaksi->pegawai)
                            <td>{{ $transaksi->pegawai->name }}</td>
                        @else
                            <td>Transaction Not Approve Yet</td>
                        @endisset
                        <td>{{ $transaksi->kategori->nama }}</td>
                        <td>{{ $transaksi->jumlah_harga }}</td>
                        <td><p class="badge bg-primary">{{ $transaksi->status }}</p></td>
                        <td class="d-flex gap-2">
                            <button class="button-edit" data-bs-toggle="modal" data-bs-target=""><i class="fas fa-pencil-alt"></i></button>
                            <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target=""></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          @else
                <p>No transactions found.</p>
            @endif
        </div>
      </div>
@endsection
