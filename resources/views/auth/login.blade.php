@extends('layout.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="p-5 mb-4 bg-light rounded-3">
                    <h5 class="text-center"><i class="bi bi-unlock2"></i> Login</h5>
                    <hr>
                    @include('_message')
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required>

                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i id="toggleIcon" class="bi bi-eye"></i>
                                </button>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-success"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                        </div>

                    </form>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
@endsection
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>
