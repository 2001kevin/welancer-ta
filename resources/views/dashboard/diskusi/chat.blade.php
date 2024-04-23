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
                <p class="font-bold mb-2 mt-4">
                    From Transaction :
                </p>
                <p class="font-medium">{{ $room->transaksis->nama }}</p>
            </div>
        </div>
        
        <div class="main ">
            <div class="px-2 scroll" id="message">
            </div>
            <form id="form">
                <nav class="navbar bg-white navbar-expand-sm d-flex justify-content-between px-2">
                    <input type="text number" name="text" class="form-control" placeholder="Type a message...">
                    <div class="icondiv d-flex justify-content-end align-content-center text-center ml-2"> <i
                            class="fa fa-arrow-circle-right icon2"></i> </div>
                </nav>
            </form>
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

                    const message = document.querySelector('input[name="text"]')
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
