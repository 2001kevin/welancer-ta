@extends('layouts.head')
@section('content')
  <section class="background h-full flex justify-center py-48">
      <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg  lg:max-w-4xl">
          <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image: url('https://images.unsplash.com/photo-1606660265514-358ebbadc80d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1575&q=80');"></div>

          <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
              <div class="flex justify-center mx-auto">
                    <a href="/">
                        <img src="{{ asset('images/LOGO.png') }}" alt="">
                    </a>

              </div>

              <p class="mt-3 text-xl text-center text-gray-600">
                  Welcome back!
              </p>
              <form action="{{ route('register-action') }}" method="post">
                @csrf
                  <div class="mt-4">
                      <label class="block mb-2 text-sm font-medium text-gray-600" for="LoggingEmailAddress">Name</label>
                      <input name="name" id="LoggingEmailAddress" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" required />
                  </div>
                  <div class="mt-4">
                      <label class="block mb-2 text-sm font-medium text-gray-600" for="LoggingEmailAddress">Alamat</label>
                      <input name="alamat" id="LoggingEmailAddress" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" required/>
                  </div>
                  <div class="mt-4">
                      <label class="block mb-2 text-sm font-medium text-gray-600" for="LoggingEmailAddress">Email Address</label>
                      <input name="email" id="LoggingEmailAddress" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="email" required/>
                  </div>

                  <div class="mt-4">
                      <div class="flex justify-between">
                          <label class="block mb-2 text-sm font-medium text-gray-600" for="loggingPassword">Password</label>
                      </div>

                      <input name="password" id="loggingPassword" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" required/>
                  </div>

                  <div class="mt-6">
                      <button type="submit" class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                          Sign Up
                      </button>
                  </div>
                </form>

              <div class="flex items-center justify-between mt-4">
                  <span class="w-1/5 border-b md:w-1/4"></span>

                  <a href="{{ route('login') }}" class="text-xs text-gray-500 uppercase hover:underline">or sign in</a>

                  <span class="w-1/5 border-b md:w-1/4"></span>
              </div>
          </div>
      </div>
  </section>
@endsection
