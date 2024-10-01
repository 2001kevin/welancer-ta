@extends('layouts.sidebar')
@section('main')
    <div class="d-flex pb-5 justify-content-center container mt-5 ">
        <div class="card border-0 shadow mb-4 mr-5" style="width: 25rem;">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
                    <span class="title-welancer ms-3">About </span>
                </div>
                <p class="font-bold mb-2">
                    Topic :
                </p>
                <p class="font-medium capitalize">{{ $room->tipe_diskusi }}</p>
                <p class="font-bold mb-2 mt-3">
                    From Transaction :
                </p>
                <p class="font-medium">{{ $room->transaksis->nama }}</p>
                <p class="font-bold mt-3">
                    Service Requested :
                </p>
                @foreach ($det_transaksi as $det)
                    <span
                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $det->jasa->nama }}</span>
                @endforeach

                @if ($room->transaksis->fix_price !== null)
                    <p class="font-bold mb-2 mt-3">
                        Fix Price :
                    </p>
                    <p class="font-medium">Rp {{ number_format($room->transaksis->fix_price, 2) }}</p>
                @else
                    <p class="font-bold mb-2 mt-3">
                        Price Range :
                    </p>
                    <p class="font-medium">{{ formatCurrency($room->transaksis->min, $currency[0]) }} - {{ formatCurrency($room->transaksis->max, $currency[0]) }}</p>
                @endif
                @if(Auth::guard('pegawai')->id() == $mapping_grup->pegawai_id)
                    <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                        class=" mt-4 w-100 text-white bg-[#5932ea] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Update</button>
                @else
                @endif
            </div>
        </div>

        <div class="main ">
            <div class="px-2 scroll" id="message">
            </div>
            <form id="form">
                <nav class="navbar bg-white navbar-expand-sm d-flex justify-content-between px-2">
                    <input type="text number" name="pesan" class="form-control" placeholder="Type a message...">
                    <div class="icondiv d-flex justify-content-end align-content-center text-center ml-2"> <i
                            class="fa fa-arrow-circle-right icon2"></i> </div>
                </nav>
            </form>
        </div>

        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[100%] md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow w-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                        <h3 class="text-lg font-semibold text-gray-900 ">
                            Update Transaction
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('update-transaksi', $room->transaksis->id) }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5">
                            <p class="mb-3">Range Price : {{ formatCurrency($room->transaksis->min, $currency[0]) }} - {{ formatCurrency($room->transaksis->max, $currency[0]) }}</p>
                            <div class="col-span-2 mb-2">
                                <label for="fix_price" class="block mb-2 text-sm font-medium text-gray-900">Fix
                                    Price</label>
                                <input type="number" oninput="validity.valid||(value='');" name="fix_price" id="fix_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="fix price" required="">
                            </div>
                            {{-- <label for="website-admin"
                                class="block mb-2 text-sm font-medium text-gray-900">First Termin</label>
                            <div class="flex mb-2">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                                   <i class="fa-solid fa-percent"></i>
                                </span>
                                <input type="number" id="website-admin" oninput="validity.valid||(value='');" name="termin"
                                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="First Termin">
                            </div> --}}
                            <div class="mb-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Select
                                    Status</label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Status</option>
                                    <option {{ $room->transaksis->status == 'On Negotiations' ? 'selected' : '' }}
                                        value="On Negotiations">On Negotiations</option>
                                    <option {{ $room->transaksis->status == 'Waiting for Payment' ? 'selected' : '' }}
                                        value="Waiting for Payment">Waiting for Payment</option>
                                    <option {{ $room->transaksis->status == 'On Progress' ? 'selected' : '' }}
                                        value="On Progress">On Progres</option>
                                    <option {{ $room->transaksis->status == 'Finish' ? 'selected' : '' }} value="Finish">
                                        Finish
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                Submit
                            </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-center container mt-5">
        <div class="wrapper">
            <div class="main">
                <div class="px-2 scroll" id="message">
                </div>
                <form id="form" class="navbar bg-white navbar-expand-sm d-flex justify-content-between">
                    <input type="text number" name="text" class="form-control" placeholder="Type a message...">
                    <button class="btn btn-success">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div> --}}

        {{-- Load pusher library --}}
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>
            // Get chat from API
            const getChat = async () => {
                const response = await fetch('/diskusi/get/{{ $room->id }}')
                const data = await response.json()
                console.log(data);
                // Print chat
                let chatsHTML = ''
                const isPegawaiLoggedIn = {{ Auth::guard('pegawai')->check() ? 'true' : 'false' }};
                const isUserLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                data.map(r => {
                    let isPegawaiNotNull = (r.pegawai_id !== null);
                    let isUserNotNull = (r.user_id !== null);
                    if (isPegawaiLoggedIn) {
                        if (isPegawaiNotNull) {
                            chatsHTML += `
                        <div class="d-flex align-items-center text-right justify-content-end mb-3">
                            <div class="pr-2"> <span class="name">Freelancer</span>
                                <p class="msg">${r.text}</p>
                            </div>
                            <div><img src="https://ik.imagekit.io/u1ds9zj1i/LOGO.png?updatedAt=1713292637310" width="30" class="img1" /></div>
                        </div>
                       `
                        } else {
                            chatsHTML += `
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-left pr-1"><img src="https://ik.imagekit.io/u1ds9zj1i/LOGO.png?updatedAt=1713292637310" width="30" class="img1" /></div>
                            <div class="pr-2 pl-1"> <span class="name">${r.user_name}</span>
                                <p class="msg">${r.text}</p>
                            </div>
                        </div>
                       `
                        }
                    } else if (isUserLoggedIn) {
                        if (isUserNotNull) {
                            chatsHTML += `
                        <div class="d-flex align-items-center text-right justify-content-end mb-3">
                            <div class="pr-2"> <span class="name">Me</span>
                                <p class="msg">${r.text}</p>
                            </div>
                            <div><img src="https://ik.imagekit.io/u1ds9zj1i/LOGO.png?updatedAt=1713292637310" width="30" class="img1" /></div>
                        </div>
                       `
                        } else {
                            chatsHTML += `
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-left pr-1"><img src="https://ik.imagekit.io/u1ds9zj1i/LOGO.png?updatedAt=1713292637310" width="30" class="img1" /></div>
                            <div class="pr-2 pl-1"> <span class="name">Freelancer</span>
                                <p class="msg">${r.text}</p>
                            </div>
                        </div>
                       `
                        }
                    }
                })

                document.getElementById('message').innerHTML = chatsHTML
            }

            window.addEventListener('load', async (ev) => {
                await getChat()
                // Connect to pusher
                const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                    cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                })

                // Connect to chat channel
                const channel = pusher.subscribe('chat-channel')

                // Listen for chat-send event
                channel.bind('chat-send', async (data) => {
                    // Update chat after receiving new message
                    await getChat()
                })

                // Get chat from API after connecting to Pusher
                // await getChat()

                // Send message
                document.getElementById('form').addEventListener('submit', async (ev) => {
                    ev.preventDefault()

                    const message = document.querySelector('input[name="pesan"]')
                    const response = await fetch('/diskusi/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: message.value,
                            room: '{{ $room->id }}'
                        })
                    })

                    const data = await response.json()

                    if (data) {
                        // Get chat after sending message
                        await getChat()

                        message.value = ''
                    }
                })
            })
        </script>
    @endsection
