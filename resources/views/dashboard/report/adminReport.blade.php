@extends('layouts.sidebar')
@section('main')
    <div class="flex max-w-full justify-between gap-3">
        <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l  tracking-tight text-gray-900">Revenue</p>
                <p class="font-bold text-black ">{{ formatCurrency($revenue, $currency[0]) }} </p>
            </div>
            <div class="p-3 bg-green-200 rounded-full">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
        </div>

        <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
            <div>
                <p class="mb-2 text-l tracking-tight text-gray-900">Users</p>
                <p class="font-bold text-black ">{{ $jumlahUser }}</p>
            </div>
            <div class="p-3 bg-gray-200 rounded-full ">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>

        <div class="flex items-center justify-between block w-full p-6 bg-white border border-gray-200 rounded-lg  hover:bg-gray-100">
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
        </div>
    </div>
    <div class="">
        <div class="p-6 bg-white border border-gray-200 rounded-lg mt-3">
            <div class="mb-3 border-b-4 border-slate-300 rounded">
                <h1 class="font-bold text-2xl my-3">Revenue Per Month ({{ $currency[0] }})</h1>
            </div>
            <div id="revenueChart"></div>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg mt-3 mb-4" >
            <div class="card-body">
              <div class="d-flex align-items-center mb-4">
                  <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                  <span class="title-welancer ms-3">Freelancer Reports</span>
              </div>
                <table class="table table-borderless border-0" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">No Handphone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pegawais as $pegawai)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $pegawai->name }}</td>
                            <td>{{ $pegawai->email }}</td>
                            <td>{{ $pegawai->alamat }}</td>
                            <td>{{ $pegawai->hp }}</td>
                            {{-- @foreach ($pegawai->skills as $skill)
                                <td>{{ $skill->nama }}</td>
                                <td>{{ $skill->pivot->level }}</td>
                            @endforeach --}}
                            <td>
                                <a href="{{ route('report-freelancer', $pegawai->id) }}">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded ">View Report</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    @section('scripts')
        <script>
        var options = {
            chart: {
                type: 'bar', // Jenis chart
                height: 350
            },
            series: [{
                name: 'Revenue',
                data: @json($revenuesData) // Data revenue per bulan
            }],
            xaxis: {
                categories: @json($months) // Label bulan
            },
            // title: {
            //     text: 'Revenue per Month (' + '{{ $currency[0] }}' + ')',
            //     align: 'center'
            // },
            colors:'#1A56DB',
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 12,
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    </script>
    @endsection
@endsection
