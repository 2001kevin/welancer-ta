@extends('layouts.sidebar')
@section('main')
@if ($settingTermin == null)
    <div class="flex justify-between">
        <div class="grow w-full max-w-full mr-3 p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
            <form class="space-y-6" action="{{ route('setting-store') }}" method="POST" id="termin-form">
                @csrf
                <h5 class="text-xl font-medium text-gray-900">Change Termin</h5>
                <div>
                    <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Termin Amount</label>
                    <input type="number" name="jumlah_termin" id="jumlah_termin" oninput="validity.valid||(value='');" min="0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="termin amount" required />
                </div>
                <div id="termin-container"></div>
                <p id="error-message" class="error">Jumlah termin tidak boleh lebih dari 100.</p>
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
            <form class="space-y-6" action="{{ route('setting-update', $settingTermin->id) }}" method="POST" id="termin-form">
                @csrf
                <h5 class="text-xl font-medium text-gray-900">Update Termin</h5>
                <div>
                    <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Termin</label>
                    <input type="number" name="jumlah_termin" id="jumlah_termin" min="{{ $settingTermin->jumlah_termin }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $settingTermin->jumlah_termin }}" required />
                </div>
                <div id="termin-container">
                    @foreach ($settingTermin->rincian as $index => $termin)
                        <div>
                            <label for="termin-{{ $index+1 }}" class="block mb-2 text-sm font-medium text-gray-900">Termin {{ $index+1 }}</label>
                            <input type="number" name="termin[]" placeholder="termin {{ $index+1 }}" id="termin-{{ $index+1 }}"
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $termin }}" required />
                        </div>
                    @endforeach
                </div>
                <p id="error-message" class="error">Jumlah termin tidak boleh lebih dari 100.</p>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Submit
                </button>
            </form>
        </div>
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8">
            <form class="space-y-6" action="#">
                <h5 class="text-xl font-medium text-gray-900">Current Termin</h5>
                <div>
                    <label for="jumlah_termin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Termin</label>
                    <input type="number" name="jumlah_termin" id="jumlah_termin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ $settingTermin->jumlah_termin }}" readonly/>
                    </div>
                    @foreach ($settingTermin->rincian as $termin)
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Termin {{ $loop->index+1 }}</label>
                            <input type="number" name="termin" id="termin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ $termin }}" required readonly/>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        </div>
    </div>
@endif

<script>
    document.getElementById('jumlah_termin').addEventListener('input', function() {
        const jumlahTermin = parseInt(this.value);
        const terminContainer = document.getElementById('termin-container');
        const errorMessage = document.getElementById('error-message');

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
        let total = 0;
        terminInputs.forEach(input => {
            total += parseInt(input.value) || 0;
        });

        if (total > 100) {
            document.getElementById('error-message').style.display = 'block';
            return false;
        } else {
            document.getElementById('error-message').style.display = 'none';
            return true;
        }
    }

    document.getElementById('termin-form').addEventListener('submit', function(event) {
        const isValid = validateTerminTotal();

        if (!isValid) {
            event.preventDefault();  // Mencegah submit jika total lebih dari 100
            alert('Jumlah total termin tidak boleh lebih dari 100.');
        }
    });
</script>
@endsection
