<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Salon Kosmetyczny'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #be5bd7 !important;
        }

        .navbar-brand {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link {
            color: #d1d1d1 !important;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link.active {
            color: #ffffff !important;
            font-weight: bold;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #f792d4;
            border-color: #db8fc1;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #f792d4;
            border-color: #db8fc1;
        }

        .navbar-text {
            color: #d1d1d1 !important;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Salon Kosmetyczny</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/services">Usługi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/client">Wizyty</a></li>
                    <li class="nav-item"><a class="nav-link" href="/employees">Pracownicy</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reviews">Recenzje</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if(Auth::check()): ?>
                        <li class="nav-item">
                            <span class="navbar-text">
                                Zalogowany jako: <?php echo e(Auth::user()->email); ?>

                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?php echo e(route('logout')); ?>">Wyloguj</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login-form')); ?>">Zaloguj się</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer>
        &copy; 2026 Salon Kosmetyczny by Jagoda150. Wszystkie prawa zastrzeżone.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\salonf_ostateczny-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>