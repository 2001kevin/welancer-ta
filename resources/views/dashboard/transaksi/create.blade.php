@extends('layouts.sidebar')
@section('main')
    <div class="container">
        <form action="{{ route('store-transaksi') }}" method="POST">
            @csrf
            <div id="sub-service-data-container"></div>
            <input type="hidden" id="totalValueInput" name="total_value">
            <div class="float-start w-75">
                <div class="form-container">
                    <div class="card border-0 shadow-sm mb-3 p-3">
                        <div class="card-body">
                            <div class="header mb-3">
                                <h2><strong>Request Project</strong></h2>
                            </div>
                            <label for="exampleInputEmail1" class="form-label">Project Name</label>
                            <input type="text" name="name_project"
                                class="form-control block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Project Name" required>

                            <label for="exampleInputEmail1" class="form-label mt-3">Project Category</label>
                            <select class="form-select" name="kategori" id="kategori" aria-label="Default select example"
                                required>
                                <option value selected>Choose Project Category</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full flex item-start justify-start gap-4" id="card-service">
                        <div class="w-full card border-0 shadow-sm p-3">
                            <div class="card-body">
                                <div class="header mb-3">
                                    <h2><strong>Choose Service</strong></h2>
                                </div>
                                <ul id="service" class="max-h-[500px] overflow-y-auto"></ul>
                            </div>
                        </div>
                        <div class="w-full card border-0 shadow-sm p-3" id="sub-service" style="display: none;">
                            <div class="card-body">
                                <div class="header mb-3">
                                    <h2><strong>Choose Sub Service</strong></h2>
                                </div>
                                <ul id="sub-service-list" class="max-h-[500px] overflow-y-auto">
                                    <!-- Sub-services will be dynamically added here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="material-links-section" class="mt-3"></div>
                    <div class="col d-grid gap-2 purple button-submit mt-3 mb-3">
                        <button style="display: none" id="submit-transaction" type="submit">Submit</button>
                    </div>
                </div>
            </div>
            <div class="float-end w-25 ps-4">
                <div class="card border-0 shadow-sm position-relative">
                    <div class="card-body bottom-50 end-50">
                        <h1 class="center text-center"><strong>Order Summary</strong></h1>
                        <div id="order-summary">

                        </div>
                        <div class="mt-5 text-center">
                            <span class="badge bg-secondary p-2 text-center">
                                <p class="center mb-2"><strong>Total : </strong></p>
                                <p id="total" class="fs-6">0</p>
                                <input type="hidden" name="totalValue" id="totalValueInput" value="0">
                                <input type="hidden" name="valueMax" id="valueMax" value="0">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('change', function(event) {
                if (event.target.name === 'sub_service[]') {
                    toggleSubmitButton();
                    toggleQuantityInput(event.target);
                    updateMaterialLinksForm();
                    updateOrderSummary();
                    updateTotal();
                }
                if (event.target.name.startsWith('quantity[')) {
                    updateOrderSummary();
                    updateTotal();
                }
            });

            function updateMaterialLinksForm() {
                const materialLinksSection = document.getElementById('material-links-section');
                materialLinksSection.innerHTML = '';

                const selectedSubServices = document.querySelectorAll('input[name="sub_service[]"]:checked');
                const selectedServices = new Set();

                selectedSubServices.forEach(subService => {
                    const serviceId = subService.value;
                    const serviceName = subService.dataset.name;
                    const parentServiceName = subService.closest('.service-section').querySelector('h3')
                        .textContent;

                    if (!selectedServices.has(parentServiceName)) {
                        selectedServices.add(parentServiceName);
                        const materialLinkForm = document.createElement('div');
                        materialLinkForm.classList.add('card', 'border-0', 'shadow-sm', 'p-3', 'mb-3');
                        materialLinkForm.innerHTML = `
                        <div class="card-body">
                            <h3><strong>Material Links for ${parentServiceName}</strong></h3>
                            <div class="mb-1 mt-3">
                                <label for="material-link-${serviceId}" class="form-label">Material Link</label>
                                <input type="url" name="material_links[]" class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500" id="material-link-${serviceId}" placeholder="Enter material link" required>
                            </div>
                            <div class="mb-3">
                                <label for="material-description-${serviceId}" class="form-label">Material Description</label>
                                <textarea type="text" name="material_desc[]" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="material-description-${serviceId}" placeholder="Enter material description" required></textarea>
                            </div>
                        </div>
                    `;
                        materialLinksSection.appendChild(materialLinkForm);
                    }
                });
            }

            function toggleSubmitButton() {
                const subServiceCheckboxes = document.querySelectorAll('input[name="sub_service[]"]');
                const submitButton = document.getElementById('submit-transaction');

                const isAnyChecked = Array.from(subServiceCheckboxes).some(checkbox => checkbox.checked);
                submitButton.style.display = isAnyChecked ? 'block' : 'none';
            }

            function toggleQuantityInput(checkbox) {
                const quantityInput = checkbox.closest('li').querySelector('.input-quantity');
                quantityInput.style.display = checkbox.checked ? 'block' : 'none';
            }

            document.getElementById('kategori').addEventListener('change', function() {
                const selectedCategoryId = this.value;
                const serviceRadio = document.getElementById('service');
                serviceRadio.innerHTML = '';

                document.getElementById('sub-service-list').innerHTML = '';
                document.getElementById('sub-service').style.display = 'none';

                @foreach ($jasas as $jasa)
                    if ("{{ $jasa->kategori->id }}" == selectedCategoryId) {
                        serviceRadio.innerHTML += `
                    <li class="">
                        <input type="checkbox" id="service-option-{{ $jasa->id }}" value="{{ $jasa->id }}" data-min="{{ $jasa->min_price }}" data-max="{{ $jasa->max_price }}" name="service[]" class="peer hidden"/>
                        <label for="service-option-{{ $jasa->id }}" class="mb-2 mr-2 inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-950 peer-checked:text-gray-950 hover:bg-gray-50">
                            <div class="block">
                                <div class="w-full text-lg font-semibold capitalize">{{ $jasa->nama }}</div>
                                <div class="w-full text-sm normal-case">{{ $jasa->deskripsi }}.</div>
                                <div class="w-full text-lg font-semibold capitalize">Estimated Price:</div>
                                <div class="w-full text-sm normal-case">Rp {{ $jasa->min_price }} - Rp {{ $jasa->max_price }}</div>
                            </div>
                        </label>
                    </li>
                `;
                    }
                @endforeach
            });

            document.addEventListener('change', function(event) {
                if (event.target.name === 'service[]') {
                    document.getElementById('sub-service').style.display = 'block';
                    loadAllSelectedSubServices();
                    updateOrderSummary();
                    updateTotal();
                }
            });

            function loadAllSelectedSubServices() {
                const subServiceList = document.getElementById('sub-service-list');
                subServiceList.innerHTML = '';

                const selectedServices = document.querySelectorAll('input[name="service[]"]:checked');
                selectedServices.forEach(service => {
                    loadSubServices(service.value);
                });
            }

            function loadSubServices(serviceId) {
                $.ajax({
                    url: `/get-sub-services/${serviceId}`,
                    method: 'GET',
                    success: function(response) {
                        const subServices = response.subServices;
                        const service = response.services;
                        const subServiceList = document.getElementById('sub-service-list');

                        const section = document.createElement('div');
                        section.id = `service-section-${serviceId}`;
                        section.classList.add('service-section');

                        section.innerHTML = `
                        <h3 class="capitalize mb-2 font-semibold">${service[0].nama} services: </h3>
                        <ul>
                            ${subServices.map(subService => `
                                        <li id="sub-service-item-${subService.id}">
                                            <input type="checkbox" id="sub-service-option-${subService.id}" data-name="${subService.nama}" value="${subService.id}" data-harga="${subService.harga}" name="sub_service[]" class="peer hidden"/>
                                            <label for="sub-service-option-${subService.id}" class="mb-2 inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-950 peer-checked:text-gray-950 hover:bg-gray-50">
                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold capitalize">${subService.nama}</div>
                                                    <div class="input-quantity" style="display: none;">
                                                        <label for="small-input-${subService.id}" class="block text-sm font-medium text-xs ml-1 text-gray-900">Quantity (${subService.tipe_unit})</label>
                                                        <input type="number" id="small-input-${subService.id}" min="${subService.unit}" value="${subService.unit}" class="block w-full p-2 text-gray-900 border border-gray-500 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500" placeholder="quantity" name="quantity[${subService.id}]">
                                                    </div>
                                                </div>
                                            </label>
                                        </li>
                                    `).join('')}
                        </ul>
                    `;

                        subServiceList.appendChild(section);
                    },
                    error: function(error) {
                        console.error('Error fetching sub-services:', error);
                    }
                });
            }

            function updateOrderSummary() {
                const orderSummary = document.getElementById('order-summary');
                orderSummary.innerHTML = '';

                const subServiceDataContainer = document.getElementById('sub-service-data-container');
                subServiceDataContainer.innerHTML = '';

                const selectedSubServices = document.querySelectorAll('input[name="sub_service[]"]:checked');
                selectedSubServices.forEach(subService => {
                    const subServiceName = subService.dataset.name;
                    const subServicePrice = subService.dataset.harga;
                    const quantityInput = document.querySelector(
                        `input[name="quantity[${subService.value}]"]`);
                    const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
                    const unit = parseInt(quantityInput.getAttribute('min'));
                    const totalPrice = hitungTotalHarga(unit, quantity, parseInt(subServicePrice));

                    const summaryItem = document.createElement('div');
                    summaryItem.classList.add('order-summary-item', 'flex', 'justify-between', 'mt-3');
                    summaryItem.innerHTML = `
                    <p class="font-medium">${subServiceName}</p>
                    <p> Rp ${totalPrice}</p>
                `;
                    orderSummary.appendChild(summaryItem);

                    // Tambahkan input tersembunyi untuk harga per sub-service
                    subServiceDataContainer.innerHTML += `
                    <input type="hidden" name="subService_price[${subService.id}]" value="${totalPrice}">
                    <input type="hidden" name="quantity2[${subService.id}]" value="${quantity}">
                `;
                });
            }

            function updateTotal() {
                let totalPrice = 0;
                let minPrice = Infinity;

                const selectedSubServices = document.querySelectorAll('input[name="sub_service[]"]:checked');
                selectedSubServices.forEach(function(subService) {
                    const subServicePrice = parseInt(subService.dataset.harga);
                    const quantityInput = document.querySelector(
                        `input[name="quantity[${subService.value}]"]`);
                    const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
                    const unit = parseInt(quantityInput.getAttribute('min'));
                    const totalSubServicePrice = hitungTotalHarga(unit, quantity, subServicePrice);

                    if (subServicePrice < minPrice) {
                        minPrice = subServicePrice;
                    }

                    totalPrice += totalSubServicePrice;
                });

                const totalText = document.getElementById('total');
                totalText.textContent = `Rp ${minPrice} - Rp ${totalPrice}`;

                const totalValueInput = document.getElementById('totalValueInput');
                const maxValue = document.getElementById('valueMax');
                if (minPrice === Infinity) {
                    totalValueInput.value = '0';
                } else {
                    totalValueInput.value = `Rp ${minPrice} - Rp ${totalPrice}`;
                    maxValue.value = `${totalPrice}`;
                }
            }

            function hitungTotalHarga(unit, kuantitas, harga) {
                let totalHarga = harga;
                if (kuantitas <= unit) {
                    return totalHarga;
                }
                const additionalUnits = kuantitas - unit;
                totalHarga += Math.ceil(additionalUnits / unit) * harga;
                return totalHarga;
            }
        });
    </script>
@endsection
