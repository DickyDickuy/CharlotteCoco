<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Charlotte Essence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md fixed w-full top-0 z-50">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="logo">
                    <a href="index.html"><img src="images/Charlotte Essence logo 1.png" alt="Charlotte Essence" class="h-10"></a>
                </div>
                <ul class="hidden md:flex space-x-8">
                    <li><a href="index.html#home" class="text-gray-700 hover:text-[#0093cd] transition duration-300">Home</a></li>
                    <li><a href="index.html#about" class="text-gray-700 hover:text-[#0093cd] transition duration-300">About Us</a></li>
                    <li><a href="index.html#offer" class="text-gray-700 hover:text-[#0093cd] transition duration-300">Offer</a></li>
                    <li><a href="index.html#products" class="text-gray-700 hover:text-[#0093cd] transition duration-300">Products</a></li>
                    <li><a href="index.html#gallery" class="text-gray-700 hover:text-[#0093cd] transition duration-300">Gallery</a></li>
                    <li><a href="index.html#contact" class="text-gray-700 hover:text-[#0093cd] transition duration-300">Contact</a></li>
                </ul>
                <button class="md:hidden text-gray-700" id="mobile-menu-btn" aria-label="Toggle menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <ul class="pt-4 space-y-2">
                    <li><a href="index.html#home" class="block text-gray-700 hover:text-[#0093cd] py-2">Home</a></li>
                    <li><a href="index.html#about" class="block text-gray-700 hover:text-[#0093cd] py-2">About Us</a></li>
                    <li><a href="index.html#offer" class="block text-gray-700 hover:text-[#0093cd] py-2">Offer</a></li>
                    <li><a href="index.html#products" class="block text-gray-700 hover:text-[#0093cd] py-2">Products</a></li>
                    <li><a href="index.html#gallery" class="block text-gray-700 hover:text-[#0093cd] py-2">Gallery</a></li>
                    <li><a href="index.html#contact" class="block text-gray-700 hover:text-[#0093cd] py-2">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="pt-24 pb-16">
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h1>
                    <p class="text-gray-600 leading-relaxed">
                        We'd love to hear from you. Please fill out the form below to get in touch with our team.
                    </p>
                </div>

                <div class="max-w-3xl mx-auto mt-12 bg-white p-8 rounded-lg shadow-lg">
                    <form action="submit_form.php" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0093cd]">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                                <input type="email" id="email" name="email" placeholder="your.email@example.com" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0093cd]">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="product" class="block text-gray-700 font-semibold mb-2">Product of Interest</label>
                            <select id="product" name="product" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0093cd]">
                                <option value="" disabled selected>Select a product</option>
                                <option value="Palm Sugar">Palm Sugar</option>
                                <option value="Granulated Coconut Sugar">Granulated Coconut Sugar</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                            <textarea id="address" name="address" rows="3" placeholder="Your full address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0093cd]"></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Your message..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0093cd]"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="w-full md:w-auto bg-[#8e531d] text-white font-bold py-3 px-8 rounded-md hover:bg-[#774418] transition duration-300">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">CHARLOTTE ESSENCE</h3>
                    <p class="text-gray-400">Premium coconut sugar products from Indonesia, serving customers worldwide with quality and reliability.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Products</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="index.html#products" class="hover:text-white">Palm Sugar</a></li>
                        <li><a href="index.html#products" class="hover:text-white">Granulated Coconut Sugar</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="index.html#about" class="hover:text-white">About Us</a></li>
                        <li><a href="index.html#specs" class="hover:text-white">Quality Standards</a></li>
                        <li><a href="index.html#certifications" class="hover:text-white">Certifications</a></li>
                        <li><a href="index.html#about" class="hover:text-white">Sustainability</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="contact.php" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">Export Documentation</a></li>
                        <li><a href="#" class="hover:text-white">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 CHARLOTTE ESSENCE. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
