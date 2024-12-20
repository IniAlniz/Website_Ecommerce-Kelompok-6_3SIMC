<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your Ultimate E-Commerce Destination">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fe1d5cf351.js" crossorigin="anonymous"></script>
    <title>Sigma Store - Online Shopping</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center">
            <img src="/img/ECOMMERCE.jpg" style="height: 100px; width: auto;" class="logo" alt="Sigma Store Logo">
            </a>
            
            <nav>
                <ul class="flex space-x-6 items-center">
                    <li><a href="#" class="text-gray-800 hover:text-blue-600 transition">Home</a></li>
                    <li>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('register') }}" class="text-gray-800 hover:text-blue-600 transition">
                                <i class="fa-regular fa-user"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16" style="background-image: url('https://img.freepik.com/free-photo/clothes-store-with-rack-clothes_23-2148929531.jpg?t=st=1734113070~exp=1734116670~hmac=21c51df8ca500ee7687b2429a7688ad8faf5ceb8885a3c5b72c03b7c804516dc&w=1800'); background-size: ; cover; background-position: center;">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl font-bold mb-4">Welcome to Sigma Store</h1>
                <p class="text-xl mb-6">Discover Amazing Deals and Shop Smarter</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('shop') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full hover:bg-gray-100 transition">SHOP NOW</a>
                </div>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="container mx-auto px-4 py-12 flex justify-center items-center">
            <div class="max-w-screen-xl w-full">
                <h2 class="text-2xl font-bold text-center mb-8">Featured Categories</h2>
                <div class="flex justify-center items-center space-x-6">
                    <a href="{{ route('shop') }}" class="block hover:scale-105 transition-transform duration-300">
                        <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-xl transition w-64">
                        <img src="https://img.freepik.com/free-vector/t-shirt_53876-43890.jpg?t=st=1734110481~exp=1734114081~hmac=ebcfd467b1a7f381621549cfedfc5b751b04f15f74126b53580cfbc82d961d12&w=1060" alt="T-Shirts" class="mx-auto mb-4 w-32 h-32 object-cover rounded-md">
                            <h3 class="font-semibold">T-Shirts</h3>
                        </div>
                    </a>
                    <a href="{{ route('shop') }}" class="block hover:scale-105 transition-transform duration-300">
                        <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-xl transition w-64">
                            <img src="https://img.freepik.com/free-photo/pair-trainers_144627-3800.jpg?t=st=1734110612~exp=1734114212~hmac=e659a9af4428e592f7207941436f0f7b0a65e0a8b1b29cfe9450d4cae02e68dc&w=1060" alt="Shoes" class="mx-auto mb-4 w-32 h-32 object-cover rounded-md">
                            <h3 class="font-semibold">Shoes</h3>
                        </div>
                    </a>
                    <a href="{{ route('shop') }}" class="block hover:scale-105 transition-transform duration-300">
                        <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-xl transition w-64">
                            <img src="https://img.freepik.com/free-photo/beige-loose-pants-white-tee-women-s-fashion-closeup_53876-102147.jpg?t=st=1734110691~exp=1734114291~hmac=5be50c472c22bb47fc76ae2c18a700e39a5076096e9c820e5a10569a966c76fc&w=740" alt="Jeans" class="mx-auto mb-4 w-32 h-32 object-cover rounded-md">
                            <h3 class="font-semibold">Jeans</h3>
                        </div>
                    </a>
                    <a href="{{ route('shop') }}" class="block hover:scale-105 transition-transform duration-300">
                        <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-xl transition w-64">
                            <img src="https://img.freepik.com/free-photo/men-s-gray-hoodie-fashion_53876-97865.jpg?t=st=1734110868~exp=1734114468~hmac=9872d8fbc86cd4d2682a33c9739c5f2bc8014795061cf547ddd18fc5bf0018f3&w=1800" alt="Jacket" class="mx-auto mb-4 w-32 h-32 object-cover rounded-md">
                            <h3 class="font-semibold">Jacket</h3>
                        </div>
                    </a>
                    <a href="{{ route('shop') }}" class="block hover:scale-105 transition-transform duration-300">
                        <div class="bg-white shadow-md rounded-lg p-4 text-center hover:shadow-xl transition w-64">
                            <img src="https://img.freepik.com/free-photo/set-two-trucker-hats-with-mesh-back_23-2149410050.jpg?t=st=1734110803~exp=1734114403~hmac=dd4628381ffaf77bf4f2cb87ddd686a4ae2102193e1d626de7d9b6c5ac65528b&w=1800" alt="Cap" class="mx-auto mb-4 w-32 h-32 object-cover rounded-md">
                            <h3 class="font-semibold">Accesories</h3>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4 grid grid-cols-4 gap-8">
            <div>
                <h4 class="font-bold mb-4">About Us</h4>
                <p class="text-white-700">
                    Welcome to Sigma Store! We are committed to providing you with the best products and a seamless shopping experience. 
                    Our mission is to offer high-quality products at affordable prices, backed by excellent customer service.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Company</h4>
                <ul>
                    <li><a href="#" class="hover:text-blue-400">About Us</a></li>
                    <li><a href="#" class="hover:text-blue-400">Careers</a></li>
                    <li><a href="#" class="hover:text-blue-400">Press</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Connect With Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-400">&copy; 2024 Kelompok 6_3SIMC. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

header {
    position: sticky;
    top: 0;
    z-index: 50;
    transition: all 0.3s ease;
}

header.scrolled {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(5px);
}

.logo {
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.05);
}

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.hero-section > * {
    position: relative;
    z-index: 2;
    animation: fadeIn 1s ease-out;
}

.category-card {
    transition: all 0.3s ease;
    animation: slideIn 0.5s ease-out;
}

.category-card img {
    transition: transform 0.3s ease;
}

.category-card:hover img {
    transform: scale(1.1);
}

::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

footer {
    background-image: linear-gradient(to bottom, #1a202c, #2d3748);
}

footer a {
    transition: color 0.3s ease;
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
}

@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .featured-categories {
        flex-direction: column;
        gap: 1rem;
    }
    
    .category-card {
        width: 100%;
    }
}

.transition-all {
    transition: all 0.3s ease;
}

.hover-scale {
    transition: transform 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}
</style>