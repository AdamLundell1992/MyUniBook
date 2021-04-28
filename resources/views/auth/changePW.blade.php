@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
        <div class="flex">
            <div class="w-full">
                <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                    <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                        Change account Details
                    </header>

                    <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                          action="/auth/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                                                <div class="flex flex-wrap">
                                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                                        {{ __('Password') }}:
                                                    </label>

                                                    <input id="password" type="password"
                                                           class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                                                           autocomplete="new-password">

                                                    @error('password')
                                                    <p class="text-red-500 text-xs italic mt-4">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-wrap">
                                                    <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                                        {{ __('Confirm Password') }}:
                                                    </label>

                                                    <input id="password-confirm" type="password" class="form-input w-full"
                                                           name="password_confirmation" autocomplete="new-password">
                                                </div>
                        <div class="flex flex-wrap pb-5">
                            <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                <i class="fas fa-user-edit" style="font-size: x-large"></i> Update User-Data
                            </button>

                        </div>
                    </form>
                    @if (session()->has('success'))
                        <h1 class="text-center fw-bold fs-1 mb-4" style="color: blue; ">Password changed!</h1>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection

