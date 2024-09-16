@extends('layouts.sidebar')
@section('main')
    <!-- Invoice -->
    <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10 border rounded-xl">
        <!-- Grid -->
        <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Project Details</h2>
            </div>
            <!-- Col -->

            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Grid -->
        <div class="grid md:grid-cols-2 gap-3">
            <div>
                <div class="grid space-y-3">
                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500 ">
                            Project Manager:
                        </dt>
                        <dd class="text-gray-800 block font-semibold">
                            {{ $project->subGrup->mapping_grups->pegawais->name }}
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500">
                            Service Lead:
                        </dt>
                        <dd class="font-medium text-gray-800">
                            <span class="block font-semibold">{{ $project->subGrup->pegawai->name }}</span>
                        </dd>
                    </dl>
                </div>
            </div>
            <!-- Col -->
            @php
                \Carbon\Carbon::setLocale('id');
            @endphp
            <div>
                <div class="grid space-y-3">
                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500">
                            Created Date:
                        </dt>
                        <dd class="font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($project->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500">
                            From Transaction:
                        </dt>
                        <dd class="font-medium text-gray-800">
                            {{ $project->subGrup->transaksi->nama }}
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500">
                            Grup:
                        </dt>
                        <dd class="font-medium text-gray-800">
                            {{ $project->subGrup->mapping_grups->nama }}
                        </dd>
                    </dl>

                    <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                        <dt class="min-w-36 max-w-[200px] text-gray-500">
                            Sub Grup:
                        </dt>
                        <dd class="font-medium text-gray-800">
                            {{ $project->subGrup->nama }}
                        </dd>
                    </dl>
                </div>
            </div>
            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Table -->
        <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4">
            <div class="hidden sm:grid sm:grid-cols-5">
                <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase">Sub Service</div>
                <div class="text-start text-xs font-medium text-gray-500 uppercase">Qty</div>
                <div class="text-end text-xs font-medium text-gray-500 uppercase">Price</div>
            </div>

            <div class="hidden sm:block border-b border-gray-200"></div>
            @foreach ($services as $service)
                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                    <div class="col-span-full sm:col-span-2">
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Sub Service</h5>
                        <p class="font-medium text-gray-800">{{ $service->rincianJasa->nama }}</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                        <p class="text-gray-800">{{ $service->qty }}</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Price</h5>
                        <p class="sm:text-end text-gray-800">Rp {{ number_format($service->harga, 2) }}</p>
                    </div>
                </div>

                <div class="sm:hidden border-b border-gray-200"></div>
            @endforeach

        </div>
        <!-- End Table -->

        <!-- Flex -->
        <div class="mt-8 flex sm:justify-end">
            <div class="w-full max-w-2xl sm:text-end space-y-2">
                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">

                    <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                        <dt class="col-span-3 text-gray-500">Transaction Price:</dt>
                        <dd class="col-span-2 font-medium text-gray-800">Rp
                            {{ number_format($project->subGrup->transaksi->fix_price, 2) }}</dd>
                    </dl>

                </div>
                <!-- End Grid -->
            </div>
        </div>
        <div class="flex items-center justify-center mt-4">
            @if ($project->link == null)
                <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Input
                    Project</button>

                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Input Link Project
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action="{{ route('input-project', $project->id) }}" method="POST" class="p-4 md:p-5">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="link"
                                            class="block mb-2 text-sm font-medium text-gray-900">Project Link</label>
                                        <input type="url" name="link" id="link"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Type product name" required="">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Edit
                    Project</button>
                 <!-- Main modal -->
                <div id="edit-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Input Link Project
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-toggle="edit-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action="{{ route('input-project', $project->id) }}" method="POST" class="p-4 md:p-5">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="link"
                                            class="block mb-2 text-sm font-medium text-gray-900">Project Link</label>
                                        <input type="url" name="link" id="link" value="{{ $project->link }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            placeholder="Type product name" required="">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- End Flex -->
    </div>
    <!-- End Invoice -->
@endsection
