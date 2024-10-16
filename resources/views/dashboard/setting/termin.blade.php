@extends('layouts.sidebar')
@section('main')
    @if ($settingRevenue == null)
        <div class="flex justify-between mb-3">
            <div class="grow max-w-full mr-3 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <form class="space-y-6" action="{{ route('revenue-store') }}" method="POST" id="revenue-form">
                    @csrf
                    <h5 class="text-xl font-medium text-gray-900">Revenue Distribution</h5>
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Freelancer</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                            <input type="number" oninput="validity.valid||(value='');" id="freelancer" name="freelancer"
                                min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="freelancer revenue">
                        </div>
                    </div>
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                            <input type="number" oninput="validity.valid||(value='');" id="company" name="company"
                                min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="company revenue">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-between mb-3">
            <div class="grow max-w-full mr-3 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <form class="space-y-6" action="{{ route('revenue-store') }}" method="POST" id="revenue-form">
                    @csrf
                    <h5 class="text-xl font-medium text-gray-900">Update Revenue Distribution</h5>
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Freelancer</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                            <input type="number" oninput="validity.valid||(value='');" id="freelancer" name="freelancer"
                                min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="freelancer revenue">
                        </div>
                    </div>
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                            <input type="number" oninput="validity.valid||(value='');" id="company" name="company"
                                min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="company revenue">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>
            </div>
            <div class="grow max-w-full mr-3 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <h5 class="text-xl font-medium text-gray-900">Current Revenue Distribution</h5>
                <div class="mt-3">
                    <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Freelancer</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <input type="number" oninput="validity.valid||(value='');" id="freelancer"
                            value="{{ $settingRevenue->freelancer }}" name="freelancer" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                            placeholder="freelancer revenue" disabled>
                    </div>
                </div>
                <div>
                    <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <input type="number" oninput="validity.valid||(value='');" id="company"
                            value="{{ $settingRevenue->company }}" name="company" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                            placeholder="company revenue" disabled>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($settingTermin == null)
        <div class="flex justify-between">
            <div class="grow w-full max-w-full mr-3 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <form class="space-y-6" action="{{ route('setting-store') }}" method="POST" id="termin-form">
                    @csrf
                    <h5 class="text-xl font-medium text-gray-900">Termin</h5>
                    <div>
                        <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Termin
                            Amount</label>
                        <input type="number" name="jumlah_termin" id="jumlah_termin"
                            oninput="validity.valid||(value='');" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="termin amount" required />
                    </div>
                    <div id="termin-container"></div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-between">
            <div class="w-full max-w-full mr-2 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <form class="space-y-6" action="{{ route('setting-update', $settingTermin->id) }}" method="POST"
                    id="termin-form">
                    @csrf
                    <h5 class="text-xl font-medium text-gray-900">Update Termin</h5>
                    <div>
                        <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                            Termin</label>
                        <input type="number" name="jumlah_termin" id="jumlah_termin"
                            min="{{ $settingTermin->jumlah_termin }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $settingTermin->jumlah_termin }}" required />
                    </div>
                    <div id="termin-container">
                        @foreach ($settingTermin->rincian as $index => $termin)
                            <div>
                                <label for="termin-{{ $index + 1 }}"
                                    class="block mb-2 text-sm font-medium text-gray-900">Termin {{ $index + 1 }}</label>
                                <input type="number" name="termin[]" placeholder="termin {{ $index + 1 }}"
                                    id="termin-{{ $index + 1 }}"
                                    class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    value="{{ $termin }}" required />
                            </div>
                        @endforeach
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>
            </div>
            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
                <form class="space-y-6" action="#">
                    <h5 class="text-xl font-medium text-gray-900">Current Termin</h5>
                    <div>
                        <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                            Termin</label>
                        <input type="number" name="jumlah_termin" id="jumlah_termin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $settingTermin->jumlah_termin }}" readonly />
                    </div>
                    @foreach ($settingTermin->rincian as $termin)
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Termin
                                {{ $loop->index + 1 }}</label>
                            <input type="number" name="termin" id="termin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $termin }}" required readonly />
                        </div>
                    @endforeach
            </div>
            </form>
        </div>
        </div>
        </div>
    @endif

@endsection
@section('scripts')
    <script>
        document.getElementById('jumlah_termin').addEventListener('input', function() {
            const jumlahTermin = parseInt(this.value);
            const terminContainer = document.getElementById('termin-container');

            // Bersihkan input termin sebelumnya
            const existingTerminCount = document.querySelectorAll('input[name="termin[]"]').length;
            if (jumlahTermin < existingTerminCount) {
                for (let i = existingTerminCount; i > jumlahTermin; i--) {
                    document.getElementById(`termin-${i}`).parentElement.remove();
                }
            }

            if (jumlahTermin > 0) {
                for (let i = existingTerminCount + 1; i <= jumlahTermin; i++) {
                    const inputGroup = document.createElement('div');
                    inputGroup.classList.add('input-group');
                    inputGroup.innerHTML = `
                                <label for="termin-${i}" class="block mb-2 text-sm font-medium text-gray-900">Termin ${i}</label>
                                <input type="number" name="termin[]" placeholder="termin ${i}" oninput="validity.valid||(value='');" min="0" id="termin-${i}"
                                    class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            `;
                    terminContainer.appendChild(inputGroup);
                }

                // Tambahkan event listener untuk setiap input termin
                const terminInputs = document.querySelectorAll('input[name="termin[]"]');
                terminInputs.forEach(input => {
                    input.addEventListener('input', validateTerminTotal);
                });
            }
        });

        function validateTerminTotal() {
            const terminInputs = document.querySelectorAll('input[name="termin[]"]');
            let total = 0

            terminInputs.forEach(input => {
                total += parseInt(input.value) || 0;
            });

            if (total > 100 || total < 100) {
                return false;
            } else {
                return true;
            }
        }

        function validateRevenueTotal() {
            const freelancerInput = document.querySelector('#freelancer').value;
            const companyInput = document.querySelector('#company').value;

            let freelancerRevenue = parseFloat(freelancerInput) || 0; // Default ke 0 jika input kosong
            let companyRevenue = parseFloat(companyInput) || 0;

            let totalRevenue = freelancerRevenue + companyRevenue;
            console.log(totalRevenue);

            if (totalRevenue !== 100) {
                return false;
            } else {
                return true;
            }
        }

        document.getElementById('termin-form').addEventListener('submit', function(event) {
            const isValid = validateTerminTotal();

            if (!isValid) {
                event.preventDefault(); // Mencegah submit jika total tidak valid
                Swal.fire({
                    toast: true,
                    icon: 'error', // Gunakan icon 'error' untuk menunjukkan bahwa ini kesalahan
                    title: 'The total number of terms must be exactly 100. Please double check the terms input.',
                    position: 'top-end', // Posisi toast di kanan atas
                    showConfirmButton: false,
                    timer: 3000, // Toast akan menghilang setelah 3 detik
                    timerProgressBar: true,
                });
            }
        });

        document.getElementById('revenue-form').addEventListener('submit', function(event) {
            const isValid = validateRevenueTotal();

            if (!isValid) {
                event.preventDefault(); // Mencegah submit jika total tidak valid
                Swal.fire({
                    toast: true,
                    icon: 'error', // Gunakan icon 'error' untuk menunjukkan bahwa ini kesalahan
                    title: 'The total percentage of revenue distribution must be 100%',
                    position: 'top-end', // Posisi toast di kanan atas
                    showConfirmButton: false,
                    timer: 3000, // Toast akan menghilang setelah 3 detik
                    timerProgressBar: true,
                });
            }
        });
    </script>
@endsection
