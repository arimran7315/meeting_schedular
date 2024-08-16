@extends('masterLayout.layout')
@section('content')
    <div class="container-fluid">
        <div class="mt-4 mb-5"
            style="
        --bs-breadcrumb-divider: url(
          &#34;data:image/svg + xml,
          %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
        );
      "
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Profile
                </li>
            </ol>
        </div>
        @if (session('type'))
            <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
        @endif
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">Edit Profile</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 g-2 d-flex flex-column justify-content-center align-items-center text-center">
                        <div class="profile-image">
                            @if (Auth::user()->image == '')
                                <img src="{{ asset('assets/images/user/Profile.jpg') }}" width="40%"
                                    class="img rounded-circle border p-2 border-primary" alt="" id="img" />
                            @else
                                <img src="{{ asset('/storage/' . Auth::user()->image) }}" width="40%"
                                    class="img rounded-circle border p-2 border-primary" alt="" id="img" />
                            @endif
                        </div>
                        <form action="{{ route('updateImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="image-upload p-4">
                                <input type="file" class="form-control" name="profile"
                                    onchange="document.querySelector('#img').src=window.URL.createObjectURL(this.files[0])">
                                @error('profile')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="row px-5">
                                <input type="submit" value="Update" class="btn btn-primary" name="update_img">
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-lg-8 border-start py-2 px-4">
                        <div class="top-brdr card-subtitle py-3">
                            <p style="font-size: 20px">Personal Information</p>
                        </div>
                        <x-form action="{{ route('updateInformation') }}" method="PUT">
                            <div class="row mt-4">
                                <div class="col-lg-6 w-50 m-auto">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control mt-2" value="{{ Auth::user()->name }}"
                                        name="name">
                                </div>
                            </div>
                            <div class="form-body row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control mt-2 bg-primary bg-opacity-10"
                                            value="{{ Auth::user()->email }}" readonly />
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="cell">Cell</label>
                                    <input type="text" class="form-control mt-2" value="{{ Auth::user()->contact }}"
                                        name="cell" />
                                </div>
                            </div>
                            <div class="form-body row mt-4">
                                <div class="col">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control mt-2" value="{{ Auth::user()->address }}"
                                        name="address" />
                                </div>
                            </div>
                            <div class="submit-btn row my-4">
                                <input type="submit" value="Update" name="update_info"
                                    class="btn btn-primary w-50 m-auto" />
                            </div>
                        </x-form>
                        <div class="card-subtitle py-4">
                            <p style="font-size: 20px" class="border-top pt-4">
                                Change Password
                            </p>
                        </div>
                        <x-form action="{{ route('updatePassword') }}" method="PUT">
                            <div class="form-body row">
                                {{-- <div class="col">
                                    <div class="form-group">
                                        <label for="password">Old Password</label>
                                        <input type="password" class="form-control mt-2" placeholder="Enter Old Password"
                                            name="old_pass" />
                                    </div>
                                    @error('old_pass')
                                        <p class="text-danger">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div> --}}
                                <div class="col">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control mt-2" placeholder="Enter New Password"
                                        name="password" />
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control mt-2" placeholder="Confirm New Password"
                                        name="password_confirmation" />
                                    @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="submit-btn row mt-4">
                                    <input type="submit" value="Submit" name="update_pass"
                                        class="btn btn-primary w-50 m-auto" />
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
