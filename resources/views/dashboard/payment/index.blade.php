@extends('layouts.sidebar')
@section('main')
    <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
            <div class="flex justify-between items-center">
                <div class="flex align-items-center mb-4">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                    <span class="title-welancer ms-3">Payment</span>
                    {{-- <a href="{{ route('create-transaksi') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Make
                            Project</a> --}}
                </div>
                <div>
                    <form class="max-w-sm mx-auto">
                        <select id="projectFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select Project</option>
                            @foreach ($transaksis as $transaksi)
                                <option value="{{ $transaksi->nama }}">{{ $transaksi->nama }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            @if ($termins->count() > 0)
                <table id="example"  class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">No</th>
                            <th class="text-center" scope="col">Termin</th>
                            <th class="text-center" scope="col">Project</th>
                            <th class="text-center" scope="col">Jumlah Pembayaran</th>
                            <th class="text-center" scope="col">Tanggal Termin</th>
                            <th class="text-center" scope="col">Status Pembayaran</th>
                            {{-- @can('isSuperAdmin') --}}
                            <th scope="col">Action</th>
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($termins as $index => $termin)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->index + 1 }}</th>
                                <td class="text-center">{{ $termin->nama }}</td>
                                <td class="text-center">{{ $termin->transaksi->nama }}</td>
                                <td class="text-center">{{ formatCurrency($termin->jumlah_pembayaran, $currency[0]) }}</td>
                                <td class="text-center">{{ $termin->tanggal_termin }}</td>
                                @if ($termin->status_pembayaran == 'Payment Succesfull')
                                    <td class="text-center">
                                        <p class="badge bg-success">{{ $termin->status_pembayaran }}</p>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <p class="badge bg-warning">{{ $termin->status_pembayaran }}</p>
                                    </td>
                                @endif
                                {{-- @can('isSuperAdmin') --}}

                                <td>
                                    <div class="align-items-center gap-2">
                                        <button data-modal-target="detail-modal-{{ $termin->id }}"
                                            data-modal-toggle="detail-modal-{{ $termin->id }}"
                                            class="button-detail">Detail</button>
                                    </div>
                                </td>
                                {{-- @endcan --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No transactions found.</p>
            @endif
        </div>
    </div>

    {{-- edit modal --}}
    @foreach ($termins as $termin)
        <div id="detail-modal-{{ $termin->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-bold text-gray-900">
                            Detail Payment
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                            data-modal-toggle="detail-modal-{{ $termin->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm text-gray-900 font-bold">Gross
                                    Amount</label>
                                <input type="text" name="name" id="name"
                                    class="bg-state-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="Type product name" required=""
                                    value="{{ formatCurrency($termin->jumlah_pembayaran, $currency[0]) }}" disabled>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-bold text-gray-900 ">Payment
                                    Type</label>
                                @if ($termin->payment_type == 'bank_transfer')
                                    <input type="text" name="price" id="price"
                                        class="bg-state-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                        placeholder="Not Payed" required="" value="Bank Transfer" disabled>
                                @else
                                    <input type="text" name="price" id="price"
                                        class="bg-state-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                        placeholder="Not Payed" required="" value="{{ $termin->payment_type }}"
                                        disabled>
                                @endif
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block mb-2 text-sm font-bold text-gray-900">Currency</label>
                                <input type="text" name="price" id="price"
                                    class="bg-state-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="Not Payed" required="" value="{{ $termin->currency }}" disabled>
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-bold text-gray-900">Payment
                                    Description</label>
                                <textarea id="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write product description here" disabled>This Payment is for {{ $termin->transaksi->nama }} transaction</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#example').DataTable();

            // Event listener untuk dropdown filter
            $('#projectFilter').on('change', function() {
                var selectedProject = $(this).val();

                // Filter tabel berdasarkan nilai kolom Project
                table.column(2).search(selectedProject).draw();
            });
        });
    </script>
@endsection
@endsection
