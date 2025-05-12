<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMoney</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-bg {
            background-color: #f0f7ff;
            background-image: radial-gradient(circle at 25% 50%, rgba(104, 159, 255, 0.2) 0%, transparent 40%),
                radial-gradient(circle at 75% 30%, rgba(255, 214, 102, 0.2) 0%, transparent 40%);
        }

        .fun-card {
            transition: all 0.3s ease;
            border-radius: 20px;
        }

        .fun-card:hover {
            transform: translateY(-5px);
        }

        .app-btn {
            box-shadow: 0 4px 14px rgba(0, 98, 255, 0.3);
            transition: all 0.3s ease;
        }

        .app-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 98, 255, 0.4);
        }

        @media (max-width: 640px) {
            .hero-image {
                max-height: 250px;
            }

            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body class="font-sans">
    <div class="hero-bg min-h-screen">
        <div class="container mx-auto px-5 py-10">
            <!-- Header -->
            <nav class="flex justify-between items-center mb-12 md:mb-16">
                <div class="flex items-center">
                    <i class="fas fa-wallet text-3xl text-blue-600 mr-3"></i>
                    <span class="text-2xl font-bold text-gray-800">MyMoney</span>
                </div>
                <a href="/dashboard" class="bg-blue-600 text-white px-5 py-2 rounded-full font-medium app-btn">
                    Mulai Sekarang
                </a>
            </nav>

            <!-- Hero Section -->
            <section class="flex flex-col lg:flex-row items-center mb-20 md:mb-28">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <h1 class="hero-title text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                        Kelola Keuangan <span class="text-blue-600">Dengan Mudah</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8">
                        Pantau pemasukan dan pengeluaran Anda dengan cara yang menyenangkan. Raih tujuan finansial
                        dengan lebih baik!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/dashboard"
                            class="bg-blue-600 text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full text-lg text-center app-btn">
                            <i class="fas fa-play mr-2"></i> Mulai Sekarang
                        </a>
                        <a href="#fitur"
                            class="border-2 border-blue-600 text-blue-600 font-bold py-3 px-6 md:py-4 md:px-8 rounded-full text-lg text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                        alt="Kelola keuangan" class="hero-image w-full rounded-2xl shadow-xl">
                </div>
            </section>

            <!-- Features -->
            <section id="fitur" class="mb-20 md:mb-28">
                <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-12 md:mb-16">Mengapa Memilih
                    FinTrack?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <div class="fun-card bg-white p-6 md:p-8 text-center">
                        <div class="text-4xl md:text-5xl text-blue-500 mb-4 md:mb-6">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold mb-3 text-gray-800">Pelacakan Otomatis</h3>
                        <p class="text-gray-600">Kategorikan transaksi Anda secara otomatis untuk analisis yang lebih
                            mudah</p>
                    </div>
                    <div class="fun-card bg-white p-6 md:p-8 text-center">
                        <div class="text-4xl md:text-5xl text-yellow-500 mb-4 md:mb-6">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold mb-3 text-gray-800">Pengingat Tagihan</h3>
                        <p class="text-gray-600">Tidak akan lagi terlupa membayar tagihan dengan notifikasi yang tepat
                            waktu</p>
                    </div>
                    <div class="fun-card bg-white p-6 md:p-8 text-center">
                        <div class="text-4xl md:text-5xl text-green-500 mb-4 md:mb-6">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold mb-3 text-gray-800">Keamanan Data</h3>
                        <p class="text-gray-600">Data finansial Anda terlindungi dengan enkripsi tingkat tinggi</p>
                    </div>
                </div>
            </section>

            <!-- Testimonial -->
            <section class="fun-card bg-white p-6 md:p-8 rounded-2xl shadow-md max-w-4xl mx-auto mb-20 md:mb-28">
                <div class="flex flex-col md:flex-row items-center">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Pengguna"
                        class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-4 md:mb-0 md:mr-8 border-4 border-yellow-400">
                    <div>
                        <p class="text-lg md:text-xl text-gray-700 mb-4 italic">
                            "Sejak menggunakan FinTrack, saya bisa menabung Rp2 juta lebih banyak setiap bulan.
                            Aplikasinya sangat mudah digunakan!"
                        </p>
                        <div class="font-bold text-gray-800">- Dian S., Freelancer</div>
                        <div class="text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Final CTA -->
            <section class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Siap Mengatur Keuangan dengan Lebih Baik?
                </h2>
                <a href="/dashboard"
                    class="inline-block bg-blue-600 text-white font-bold py-3 px-8 md:py-4 md:px-10 rounded-full text-lg app-btn">
                    Gabung dengan 50.000+ Pengguna
                </a>
            </section>

            <!-- Footer -->
            <footer class="text-center text-gray-600 text-sm md:text-base">
                <p>© 2025 FinTrack. Membantu mengelola keuangan pribadi dengan lebih baik.</p>
            </footer>
        </div>
    </div>
</body>

</html>
