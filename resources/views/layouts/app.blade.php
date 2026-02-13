<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRUD APP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .app-topbar {
            background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
            border-bottom: 1px solid #1f345a;
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.25);
        }

        .app-brand {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
            text-decoration: none;
        }

        .app-brand-title {
            color: #f8fafc;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .app-brand-subtitle {
            color: #93c5fd;
            font-size: 0.75rem;
            margin-top: 0.15rem;
            font-weight: 500;
        }

        .app-nav-list {
            gap: 0.45rem;
        }

        .app-nav-link {
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            padding: 0.45rem 0.75rem !important;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .app-nav-link:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-1px);
        }

        .app-nav-link.active {
            background: rgba(37, 99, 235, 0.3);
        }

        .app-nav-title {
            color: #f8fafc;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.2px;
            line-height: 1.1;
        }

        .app-nav-subtitle {
            color: #cbd5e1;
            font-size: 0.7rem;
            margin-top: 0.15rem;
            line-height: 1.1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark app-topbar">
        <div class="container">
            <a class="navbar-brand me-3 app-brand" href="{{ route('clientes.index') }}">
                <span class="app-brand-title">CRUD APP</span>
                <span class="app-brand-subtitle">Gestion de Clientes</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav app-nav-list">
                    <li class="nav-item">
                        <a class="nav-link app-nav-link {{ request()->routeIs('clientes.index') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                            <span class="app-nav-title">Clientes</span>
                            <span class="app-nav-subtitle">Ver listado</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link app-nav-link {{ request()->routeIs('clientes.create') ? 'active' : '' }}" href="{{ route('clientes.create') }}">
                            <span class="app-nav-title">Crear Cliente</span>
                            <span class="app-nav-subtitle">Nuevo registro</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
