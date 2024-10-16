@extends('layouts.sidebar')
@section('main')
    <div class="mb-3">
        <div class="flex items-center justify-between block w-fit p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
                <div>
                    <h1 class="mb-3 font-bold text-2xl pb-2 border-b-4">Freelancer Profile</h1>

                    <div class="grid space-y-3">
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 ">
                                Freelancer:
                            </dt>
                            <dd class="text-gray-800 block font-semibold">
                                {{ $pegawai->name }}
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500">
                                Email:
                            </dt>
                            <dd class="font-medium text-gray-800">
                                <span class="block font-semibold">{{ $pegawai->email }}</span>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500">
                                No. HP:
                            </dt>
                            <dd class="font-medium text-gray-800">
                                <span class="block font-semibold">{{ $pegawai->hp }}</span>
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500">
                                Address:
                            </dt>
                            <dd class="font-medium text-gray-800">
                                <span class="block font-semibold">{{ $pegawai->alamat }}</span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex max-w-full justify-between gap-3">
        <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l  tracking-tight text-gray-900">Total Fee</p>
                <p class="font-bold text-black ">{{ formatCurrency($revenue, $currency[0]) }} </p>
            </div>
            <div class="p-3 bg-green-200 rounded-full">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
        </div>

         <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l tracking-tight text-gray-900">Total Project</p>
                <p class="font-bold text-black ">{{ $jumlahProject }}</p>
            </div>
            <div class="p-3 bg-gray-200 rounded-full ">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>

        {{-- <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l  tracking-tight text-gray-900">Projects</p>
                <p class="font-bold text-black ">{{ $jumlahProject }}</p>
            </div>
            <div class="p-3 bg-indigo-300 rounded-full ">
                <i class="fa-solid fill-white fa-list-check"></i>
            </div>
        </div>

        <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l  tracking-tight text-gray-900">Freelancers</p>
                <p class="font-bold text-black ">{{ $jumlahFreelancer }}</p>
            </div>
            <div class="p-3 bg-violet-200 rounded-full ">
                <i class="fa-solid fa-users"></i>
            </div>
        </div> --}}
    </div>
     <div class="">
        <div class="p-6 bg-white border border-gray-200 rounded-lg mt-3">
            <div class="mb-3 border-b-4 border-slate-300 rounded">
                <h1 class="font-bold text-2xl my-3">Expected Fee per Month ({{ $currency[0] }})</h1>
            </div>
            <div id="revenueChart"></div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg mt-3 mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                  <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                  <span class="title-welancer ms-3">Services Performed</span>
              </div>
                <table class="table table-borderless border-0" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Fee Percentage</th>
                    <th scope="col">Expected Fee</th>
                    <th scope="col">From Sub Grup</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($subProjects as $subProject)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $subProject->rincianJasa->nama }}</td>
                            <td>{{ $subProject->presentasi_gaji  }}%</td>
                            <td>{{ formatCurrency($subProject->gaji, $currency[0]) }}</td>
                            <td>{{ $subProject->subGrup->nama }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg mt-3 mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                    <span class="title-welancer ms-3">Revenue Distribution</span>
                </div>
                <table class="table table-borderless border-0" id="dataTable2">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Project</th>
                            <th scope="col">Company</th>
                            <th scope="col">Freelancer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subGrups as $subGrup)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $subGrup->transaksi->nama }}</td>
                                <td>{{ $subGrup->transaksi->keuntungan_bersih == null ? formatCurrency(0, $currency[0]) : formatCurrency($subGrup->transaksi->keuntungan_bersih, $currency[0])}}</td>
                                <td>{{ $subGrup->keuntungan_bersih == null ? formatCurrency(0, $currency[0]) : formatCurrency($subGrup->keuntungan_bersih, $currency[0])}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('scripts')
     <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Revenue',
                data: @json($revenuesData) // Tetap menggunakan data angka asli
            }],
            xaxis: {
                categories: @json($months) // Label bulan
            },
            title: {
                text: 'Revenue per Month (' + '{{ $currency[0] }}' + ')',
                align: 'center'
            },
            colors: ['#1A56DB'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 12
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        // Memformat nilai dalam tooltip dengan simbol mata uang
                        return '{{ $currency[0] }}' + ' ' + value.toLocaleString();
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    </script>
    @endsection
@endsection
