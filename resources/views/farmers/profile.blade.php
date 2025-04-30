@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <center>
        <h2 class="mb-4 justify-content-center" style="color: #28a745;">Profile Management</h2>
    </center>

    @if(session('success'))
        <div class="alert alert-success mt-3 p-2">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center align-items-start gap-4">
            <!-- Profile Picture -->
            <div class="text-center">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/150" alt="Default Profile Picture" class="rounded-circle shadow" style="width: 150px; height: 150px;">
                @endif

                <!-- File Upload Input -->
                <div class="mt-3">
                    <label for="profile_picture" class="btn btn-outline-success">Choose Image</label>
                    <input type="file" id="profile_picture" name="profile_picture" style="display:none;" />
                </div>
            </div>

            <!-- Input Fields -->
            <div style="width: 400px;">
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your name" value="{{ old('name', $user->username) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="contact_no" class="form-label">Phone</label>
                    <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Enter your phone number" value="{{ old('phone', $user->contact_no) }}">
                </div>

                <button type="submit" class="btn btn-success w-100">Update Profile</button>
                
            </div>
        </div>
    </form>
    <br/<br/>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Name validation
        $('input[name="username"]').on('keypress', function (e) {
            const charStr = String.fromCharCode(e.which);
            if (!/^[a-zA-Z\s]+$/.test(charStr)) {
                e.preventDefault();
            }
        });

        // Phone validation
        $('input[name="contact_no"]').on('keypress', function (e) {
            const charStr = String.fromCharCode(e.which);
            const currentValue = $(this).val();
            if ((currentValue.length === 0 && !/^[6-9]$/.test(charStr)) ||
                (currentValue.length >= 10 || !/^[0-9]$/.test(charStr))) {
                e.preventDefault();
            }
        });

        // Profile picture format validation + preview
        $('#profile_picture').on('change', function () {
            const file = this.files[0];
            if (file) {
                const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Invalid file format. Please upload a JPG, PNG, or JPEG image.');
                    $(this).val('');
                    return;
                }

                // Preview selected image
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('img[alt="Profile Picture"], img[alt="Default Profile Picture"]').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection
