@extends('logintemp')
@section('content')
<div class="container-fluid login-background">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-lock-fill me-2"></i>User Login
                    </h3>
                </div>
                
                <div class="card-body p-5">
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('check') }}" method="POST">
                        {!! csrf_field() !!}   

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email Address
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input 
                                    type="email" 
                                    class="form-control form-control-lg" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Enter your email"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-key me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input 
                                    type="password" 
                                    class="form-control form-control-lg" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Enter your password"
                                    required
                                >
                                <button 
                                    type="button" 
                                    class="btn btn-outline-secondary" 
                                    id="togglePassword">
                                    Show
                                </button>
                            </div>
                        </div>

                        <!-- Show Password Script -->
                        <script>
                            document.getElementById('togglePassword').addEventListener('click', function () {
                                const passwordField = document.getElementById('password');
                                const type = passwordField.type === 'password' ? 'text' : 'password';
                                passwordField.type = type;
                                this.textContent = type === 'password' ? 'Show' : 'Hide';
                            });
                        </script>
                        
                            </div>
                            <div class="text-end mt-2">
                                <a href="#" class="text-primary small text-decoration-none">Forgot Password?</a>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center py-3">
                    <p class="text-muted mb-0">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary">Create Account</a>
                    </p>
                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Your Company. All Rights Reserved.
                </small>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
.login-background {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    background-size: cover;
    background-position: center;
}

.card {
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.card-header {
    background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
}

.btn-primary {
    background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: scale(1.02);
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.form-control:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.25);
}
</style>
@endpush