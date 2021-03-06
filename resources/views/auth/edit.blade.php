@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
        <div class="flex">
            <div class="w-full">
                <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                    <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                        Change account Details
                        <div class="pt-2">
                            <a href="{{url('ChangeUserPassword' .'/' . $user->id . '/')}}" class="card-link">
                                <i class="fas fa-user-check"></i> Click here to change password

                            </a>
                        </div>
                    </header>

                    <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                          action="/auth/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                <i class="fas fa-user-circle" style="font-size: x-large"></i> {{ __('Name') }}
                            </label>

                            <input id="name" type="text" value="{{Auth::user()->name}}"
                                   class="form-input w-full @error('name')  border-red-500 @enderror"
                                   name="name">

                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap ">
                            <label for="user_info" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                <i class="fas fa-user-secret"
                                   style="font-size: x-large"></i> {{ __('User information') }}
                            </label>

                            <textarea id="user_info" type="text" value="{{Auth::user()->user_info}}"
                                      class="form-input .val() w-full @error('user_info')  border-red-500 @enderror"
                                      name="user_info" style="height: 100px">{{Auth::user()->user_info}}
                          </textarea>

                            @error('user_info')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-black-100 mb-1"><i class="fas fa-graduation-cap"
                                                                          style="font-size: x-large"></i> University
                                Course</label>
                            <select class="form-control" name="UniCourse" id="UniCourse">
                                <li class="list-group-item">
                                    <option>{{Auth::user()->UniCourse}}</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Personal">Personal</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Software-Engineering">Software Engineering</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Electrical-Engineering">Electrical Engineering</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Mechanical-Engineering">Mechanical Engineering</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Computer Science">Computer Science</option>
                                </li>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-black-100 mb-1"><i class="fas fa-school"
                                                                          style="font-size: x-large"></i> University
                                Year</label>
                            <select class="form-control" name="university_year" id="university_year">
                                <li class="list-group-item">
                                    <option>{{Auth::user()->university_year}}</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="1st Year Student">1st Year</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="2nd Year Student">2nd Year</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="3rd Year Student">3rd Year</option>
                                </li>
                            </select>
                        </div>
                        <div class="flex flex-wrap">
                            <label for="date_of_birth" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                <i class="far fa-calendar-alt" style="font-size: x-large"></i> {{ __('Date Of Birth') }}
                            </label>

                            <input id="datepicker" type="text" autocomplete="off"
                                   value="{{ Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('m/d/Y') }}"
                                   class="form-control autocomplete  datepicker w-full @error('date_of_birth')  border-red-500 @enderror"
                                   name="date_of_birth">

                            @error('date_of_birth')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-black-100 mb-1"><i class="fas fa-venus-mars"
                                                                          style="font-size: x-large"></i> Gender <i
                                    class="fas fa-transgender-alt" style="font-size: x-large"></i></label>
                            <select class="form-control" name="gender" id="gender">
                                <li class="list-group-item">
                                    <option>{{Auth::user()->gender}}</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Personal">Personal</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Male">Male</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Female">Female</option>
                                </li>
                                <li class="list-group-item">
                                    <option value="Other">Other</option>
                                </li>
                            </select>
                        </div>
                        {{--                        <div class="flex flex-wrap">--}}
                        {{--                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">--}}
                        {{--                                {{ __('Password') }}:--}}
                        {{--                            </label>--}}

                        {{--                            <input id="password" type="password"--}}
                        {{--                                   class="form-input w-full @error('password') border-red-500 @enderror" name="password"--}}
                        {{--                                   autocomplete="new-password">--}}

                        {{--                            @error('password')--}}
                        {{--                            <p class="text-red-500 text-xs italic mt-4">--}}
                        {{--                                {{ $message }}--}}
                        {{--                            </p>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}

                        {{--                        <div class="flex flex-wrap">--}}
                        {{--                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">--}}
                        {{--                                {{ __('Confirm Password') }}:--}}
                        {{--                            </label>--}}

                        {{--                            <input id="password-confirm" type="password" class="form-input w-full"--}}
                        {{--                                   name="password_confirmation" autocomplete="new-password">--}}
                        {{--                        </div>--}}

                        <label for="image" class="fw-bold mb-2 sm:mb-4">
                            <i class="fas fa-image" style="font-size: x-large"></i> {{ __('Profile Picture') }}
                        </label>
                        <div class=" control mb-3">
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <div class="flex flex-wrap pb-5">
                            <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                <i class="fas fa-user-edit" style="font-size: x-large"></i> Update User-Data
                            </button>

                        </div>
                    </form>
                    @if (session()->has('success'))
                        <h1 class="text-center fw-bold fs-1 mb-4" style="color: blue; ">Profile Updated!</h1>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection
