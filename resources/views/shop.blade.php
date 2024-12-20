@extends('logintemp')

@section('content')
<div class="product-page">
    <div class="container-fluid px-4 py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white mb-3 animate-fade-in">Discover Our Collection</h1>
            </div>
        </div>

        <!-- Back -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('welcome') }}" class="btn btn-outline-light transition-transform">
                    <i class="fas fa-arrow-left me-2"></i>Back to Orders
                </a>
            </div>
        </div>

        <!-- Product -->
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="product-card">
                        <!-- Product Image -->
                        <div class="product-image-container">
                            <img src="{{ $product->photo ? asset('images/' . $product->photo) : asset('images/default.jpg') }}" 
                                 class="product-image" 
                                 alt="{{ $product->name }}" width="100">
                            <div class="product-overlay">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="d-flex align-items-center">
                                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                               class="form-control me-2 quantity-input" style="width: 80px;">
                                        <button type="submit" class="btn btn-primary btn-add-cart">
                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Product Details -->
                        <div class="product-details">
                            <h5 class="product-title">{{ $product->name }}</h5>
                            <div class="product-price-section">
                                <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                <span class="product-badge">New Arrival</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<style>
:root {
    --primary-color: #3498db;
    --primary-hover: #2980b9;
    --secondary-color: #2ecc71;
    --secondary-hover: #27ae60;
    --text-color: #f4f4f4;
    --background-dark: #121212;
    --card-background: rgba(255, 255, 255, 0.05);
    --border-color: rgba(255, 255, 255, 0.125);
    --shadow-color: rgba(0, 0, 0, 0.4);
    --input-background: rgba(255, 255, 255, 0.1);
    --input-border: rgba(255, 255, 255, 0.2);
    --input-focus: rgba(52, 152, 219, 0.5);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body, html {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    background-color: var(--background-dark);
    color: var(--text-color);
    overflow-x: hidden;
}

.product-page {
    background: 
        linear-gradient(rgba(18, 18, 18, 0.9), rgba(18, 18, 18, 0.9)), 
        url('https://img.freepik.com/free-photo/clothes-store-with-mannequin_23-2148929527.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 2rem 0;
}

.product-card {
    background-color: var(--card-background);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid var(--border-color);
    backdrop-filter: blur(15px);
    position: relative;
    will-change: transform;
    box-shadow: 0 10px 20px var(--shadow-color);
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, 
        rgba(255,255,255,0.05), 
        rgba(255,255,255,0.01)
    );
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
}

.product-card:hover::before {
    opacity: 1;
}

.product-image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44);
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to bottom, 
        rgba(0,0,0,0.8), 
        rgba(0,0,0,0.5)
    );
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.4s ease;
    transform: translateY(10px);
}

.product-card:hover .product-overlay {
    opacity: 1;
    transform: translateY(0);
}

.quantity-input {
    text-align: center;
    font-size: 14px;
    height: 40px;
    width: 80px !important;
    border: 2px solid var(--input-border);
    border-radius: 8px;
    background-color: var(--input-background);
    color: #fff;
    padding: 0.5rem;
    transition: all 0.3s ease;
    -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--input-focus);
    background-color: #fff;
}

.product-details {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 130px;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0.05),
        rgba(255, 255, 255, 0.02)
    );
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 0.5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.product-price-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.product-price {
    font-size: 1.3rem;
    font-weight: bold;
    color: var(--secondary-color);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.btn-add-cart {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-add-cart:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.btn-add-cart:active {
    transform: translateY(0);
}

.animate-fade-in {
    animation: fadeIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .product-details {
        height: 120px;
        padding: 1rem;
    }

    .btn-add-cart {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .product-title {
        font-size: 0.95rem;
    }

    .product-price {
        font-size: 1.1rem;
    }

    .quantity-input {
        width: 60px !important;
        height: 35px;
    }
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation: none !important;
        transition: none !important;
    }
}
</style>
@endsection
