@extends('layouts.sidebar')
@section('main')
     <div class="container">
         <form action="{{ route('store-transaksi') }}" method="POST">
            @csrf
            <div class="float-start w-75">
                    <div class="form-container">
                        <div class="card border-0 shadow-sm mb-3 p-3">
                            <div class="card-body">
                                <div class="header mb-3">
                                    <h2><strong>Request Project</strong></h2>
                                </div>
                                    <label for="exampleInputEmail1" class="form-label">Project Name</label>
                                    <input type="text" name="name_project" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Project Name" required>

                                    <label for="exampleInputEmail1" class="form-label mt-3">Project Cattegory</label>
                                    <select class="form-select" name="kategori" id="kategori" aria-label="Default select example" required>
                                        <option value selected>Choose Project Cattegory</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm p-3">
                            <div class="card-body">
                                <div class="header mb-3">
                                    <h2><strong>Choose Service</strong></h2>
                                </div>
                                <div id="service">
                                </div>
                                {{-- <label for="exampleInputEmail1" class="form-label">Quantity</label>
                                <input type="number" name="qty" min="0" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quantity" required> --}}
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="badge bg-secondary mt-3 p-3" type="button" id="button-add" onclick="addForm()" ><i class="fa-solid fa-plus me-2"></i>Add More Service</button>
                    </div>
                    <div class="col d-grid gap-2 purple button-submit mt-3 mb-3">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            <div class="float-end w-25 ps-4">
                <div class="card border-0 shadow-sm position-relative">
                    <div class="card-body bottom-50 end-50">
                        <h1 class="center text-center"><strong>Order Summary</strong></h1>
                        <div id="order-summary">

                        </div>
                        {{-- <div class="d-flex row mt-3 mb-3" >
                            <p><strong>Service 1</strong></p>
                            <p class="fs-6">Rp 400,000 - Rp 500,000</p>
                        </div>
                        <div class="d-flex row mt-3 mb-3">
                            <p><strong>Service 1</strong></p>
                            <p class="fs-6">Rp 400,000 - Rp 500,000</p>
                        </div> --}}
                        <div class="mt-5 text-center">
                            <span class="badge bg-secondary p-2 text-center">
                                <p class="center  mb-2 "><strong>Total : </strong></p>
                                <p id="total" class="fs-6">0</p>
                                <input type="hidden" name="totalValue" id="totalValueInput" value="0">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
     </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('sdfsdfsd');
            // Listen for change events on radio buttons
            var serviceInputs = document.querySelectorAll('input[name="service"]');
            serviceInputs.forEach(function (input) {
                input.addEventListener('change', function () {
                    // Clear existing order summary
                    var orderSummary = document.getElementById('order-summary');
                    orderSummary.innerHTML = '';

                    // Get all selected services
                    var selectedServices = document.querySelectorAll('input[name="service"]:checked');

                    // Iterate through selected services and update order summary
                    selectedServices.forEach(function (selectedService) {
                        var serviceName = selectedService.nextElementSibling.querySelector('strong').textContent;
                        var minPrice = selectedService.dataset.min;
                        var maxPrice = selectedService.dataset.max;
                        var totalValue = document.getElementById('total').textContent;

                        // Create new order summary entry for each selected service
                        var orderSummaryEntry = document.createElement('div');
                        orderSummaryEntry.className = 'd-flex row mt-3 mb-3';
                        orderSummaryEntry.innerHTML = `
                            <p><strong>${serviceName}</strong></p>
                            <p id="total" class="fs-6">Rp ${minPrice} - Rp ${maxPrice}</p>
                        `;
                        // var totalValue = document.getElementById('total').textContent;


                        // Append the new entry to the order summary
                        orderSummary.appendChild(orderSummaryEntry);
                    });
                });
            });
        });
    </script>

    <script>
        let count = 0;
        let selectedCategoryId = document.getElementById('kategori').value;

        let buttonAdd = document.getElementById('button-add');
        buttonAdd.style.display = 'none';

        document.getElementById('kategori').addEventListener('change', function () {
            selectedCategoryId = this.value;
            buttonAdd.style.display = selectedCategoryId ? 'block' : 'none';
        });

        document.addEventListener('DOMContentLoaded', function () {
            loadServices(selectedCategoryId);
        });

        function loadServices(categoryId, containerId) {
            var serviceContainer = document.getElementById(containerId);

            serviceContainer.innerHTML = '';

            @foreach ($jasas as $jasa)
                if ("{{ $jasa->kategori->id }}" == categoryId) {
                    serviceContainer.innerHTML += `
                        <div class="card w-75 rounded-3 mb-3">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="service_tambahan[]" value="{{ $jasa->id }}" data-min="{{ $jasa->min_price }}" data-max="{{ $jasa->max_price }}" id="service-${count}">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <div class="d-flex row">
                                            <strong>{{ $jasa->nama }}</strong>
                                        </label>
                                        <label for="description">
                                            {{ $jasa->deskripsi }}
                                        </label>
                                        <label for="Price">
                                            <strong>Estimated Price : </strong>
                                        </label>
                                        <label for="Price">
                                            Rp {{ $jasa->min_price }} - Rp {{ $jasa->max_price }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            @endforeach
        }

        function addForm() {
            count++;
            let newJasaId = `jasa-${count}`;
            var formContainer = document.querySelector('.form-container');

            var newForm = document.createElement('div');
            newForm.classList.add('card', 'p-3', 'mt-3', 'border-0', 'shadow-sm');
            newForm.id = `${newJasaId}`;

            newForm.innerHTML = `
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="header mb-3">
                            <h2><strong>Service Extra</strong></h2>
                        </div>
                        <div>
                            <button type="button" id="hapusJasaBtn-${count}"><i class="fa-solid fa-trash mx-2 "></i></button>
                        </div>
                    </div>
                    <div id="service-${count}">
                        <!-- Service content will be added here dynamically -->
                    </div>
                    <label for="exampleInputEmail1" class="form-label">Quantity</label>
                    <input type="number" min="0" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quantity">
                </div>
            `;

            formContainer.appendChild(newForm);

            $(`#hapusJasaBtn-${count}`).on('click', function () {
                hapusFitur(newJasaId);
            });

            // Load services initially for the newly added service form
            loadServices(selectedCategoryId, `service-${count}`);

            updateTotal();
        }

        function hapusFitur(fiturId) {
            let featureToRemove = $(`#${fiturId}`);
            if (featureToRemove) {
                featureToRemove.remove();
            }
        }
    </script>

    {{-- Service pertama --}}
    <script>
        document.getElementById('kategori').addEventListener('change', function () {
         // Get the selected category value
        var selectedCategoryId = this.value;

        // Get the service container element
        var serviceRadio = document.getElementById('service');

        // Clear existing content
        serviceRadio.innerHTML = '';

        // Append services based on the selected category
        @foreach ($jasas as $jasa)
            if ("{{ $jasa->kategori->id }}" == selectedCategoryId) {
                serviceRadio.innerHTML += `
                    <div class="card w-75 rounded-3 mb-3">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="service" value="{{ $jasa->id }}" data-min="{{ $jasa->min_price }}" data-max="{{ $jasa->max_price }}" id="service">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <div class="d-flex row">
                                        <strong>{{ $jasa->nama }}</strong>
                                    </label>
                                    <label for="description">
                                        {{ $jasa->deskripsi }}
                                    </label>
                                    <label for="Price">
                                        <strong>Estimated Price : </strong>
                                    </label>
                                    <label for="Price">
                                        Rp {{ $jasa->min_price }} - Rp {{ $jasa->max_price }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        @endforeach
    });
    </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('sdfs');
            var radio = document.getElementById('service');  // Ganti 'service' dengan ID yang sesuai
            if (radio) {
                radio.addEventListener('change', function () {
                    updateTotal();
                    console.log('klik');
                });
            }
        });

        function updateTotal() {
            console.log('Update Total Called');

            var totalMin = 0;
            var totalMax = 0;

            var radioButtons = document.querySelectorAll('input[name="service"]:checked');

            radioButtons.forEach(function (radio) {
                var minPrice = parseInt(radio.getAttribute('data-min'));
                var maxPrice = parseInt(radio.getAttribute('data-max'));

                totalMin += minPrice;
                totalMax += maxPrice;
            });

            // Tampilkan total dalam elemen dengan ID 'total'
            var totalElement = document.getElementById('total');
            if (totalElement) {
                totalElement.textContent = 'Rp ' + totalMin.toLocaleString() + ' - Rp ' + totalMax.toLocaleString();
            }
        }


    </script> --}}

    <script>
        // Add event listener to the document or a specific container
        document.addEventListener('change', function (event) {
            console.log('sdf');
            // Check if the change is on a radio input
            if (event.target.type === 'radio') {
                updateTotal();
            }
        });

        function updateTotal() {
            // Get all selected radio buttons
            const selectedRadios = document.querySelectorAll('input[type="radio"]:checked');

            if (selectedRadios.length > 0) {
                // Initialize minPrice and maxPrice variables
                let minPrice = 0;
                let maxPrice = 0;

                // Loop through selected radio buttons to calculate total
                selectedRadios.forEach(function (radio) {
                    const min = parseInt(radio.dataset.min);
                    const max = parseInt(radio.dataset.max);

                    // Add the min and max values to the total
                    minPrice += min;
                    maxPrice += max;
                });

                // Update the totalContainer with the calculated total
                const totalText = document.getElementById('total');
                var total = totalText.textContent = `Rp ${minPrice} - Rp ${maxPrice}`;
                document.getElementById('totalValueInput').value = total;
            } else {
                // No radio button is selected, reset the total text content
                const totalText = document.getElementById('total');
                totalText.textContent = `Rp 0 - Rp 0`;
            }
        }
    </script>


    {{-- <script>

            var radioButtons = document.querySelectorAll('input[name="service"]:checked');
            var totalElement = document.getElementById('total');

            radioButtons.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    updateTotal();
                });
            });

            function updateTotal() {
                  console.log('Update Total Called');
                var totalMin = 0;
                var totalMax = 0;

                radioButtons.forEach(function (radio) {
                    if (radio.checked) {
                        var minPrice = parseInt(radio.getAttribute('data-min'));
                        var maxPrice = parseInt(radio.getAttribute('data-max'));

                        totalMin += minPrice;
                        totalMax += maxPrice;
                    }
                });

                // Tampilkan total dalam elemen dengan ID 'total'
                totalElement.textContent = 'Rp ' + totalMin.toLocaleString() + ' - Rp ' + totalMax.toLocaleString();
            }
    </script> --}}
@endsection
