<!DOCTYPE html>
<html lang="id" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NQ Absensi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* ====================================================
           📱 DESAIN KHUSUS TAMPILAN HP (Layar Kecil)
           ==================================================== */
        @media (max-width: 767.98px) {
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa; /* Latar belakang abu-abu terang yang bersih */
                color: #212529;
            }

            /* Navbar HP yang Clean & Elegan */
            .navbar-custom {
                background-color: #ffffff !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
                border-bottom: 1px solid #eef2f5;
            }
            .navbar-custom .navbar-brand {
                font-weight: 600;
                color: #198754 !important; /* Hijau Bootstrap yang fresh */
                font-size: 1.15rem;
            }
            .navbar-custom .nav-link {
                color: #495057 !important;
                padding: 10px 12px !important;
                font-weight: 500;
                border-radius: 6px;
                margin-bottom: 5px;
            }
            /* Efek menu aktif/diklik di HP */
            .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active {
                background-color: #e8f5e9;
                color: #198754 !important;
            }

            /* Pembungkus Konten Utama di HP (Biar rapi seperti aplikasi) */
            .wrapper-konten {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
                padding: 16px;
                margin-top: 15px;
                margin-bottom: 30px;
                border: 1px solid #f1f3f5;
            }

            /* Penyelamat Tabel: Biar tabel lebar bisa digeser mulus di HP & tidak merusak layar */
            .table-responsive-hp {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
            }
            
            /* Merapikan ukuran tombol-tombol aksi agar pas di jempol HP */
            .btn {
                padding: 6px 12px;
                font-size: 0.9rem;
                border-radius: 6px;
            }
        }

        /* ====================================================
           💻 DESAIN KHUSUS TAMPILAN LAPTOP (Kembali ke Awal)
           ==================================================== */
        @media (min-width: 768px) {
            body {
                font-family: var(--bs-body-font-family);
                background-color: var(--bs-body-bg);
            }
            .wrapper-konten {
                background: transparent;
                border: none;
                box-shadow: none;
                padding: 0;
                margin-top: 25px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm navbar-custom">
        <div class="container">
            <a class="navbar-brand text-success fw-bold" href="{{ url('/') }}">NQ Absensi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/santri') }}">Data Santri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/absensi') }}">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/laporan') }}">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper-konten">
            <div class="table-responsive-hp">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>