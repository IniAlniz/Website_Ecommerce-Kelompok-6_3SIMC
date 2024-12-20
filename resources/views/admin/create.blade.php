@extends('logintemp')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0">Register Form</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.register') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group mb-3">
                        <label for="name" class="form-label">First Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control form-control-lg" 
                            placeholder="Enter your first name"
                            required
                        >
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control form-control-lg" 
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control form-control-lg" 
                                placeholder="Enter your password"
                                required>
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
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-muted mb-0">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary">Log in</a>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
@stop
<style>
body {
    background-color: #f4f6f9;
}
.card {
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}
.card-header {
    background-color: #007bff !important;
}
.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
}
.btn-primary {
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s ease;
}
.btn-primary:hover {
    background-color: #0056b3;
}
</style>