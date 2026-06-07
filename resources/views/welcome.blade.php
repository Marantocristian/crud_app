<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
        }
        .welcome-shell {
            text-align: center;
            background: rgba(255, 255, 255, 0.05);
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .welcome-subtitle {
            font-size: 1.1rem;
            color: #cbd5e1;
            margin-bottom: 2rem;
        }
        .btn-enter {
            background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
            color: #fff;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
        }
        .btn-enter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            color: #fff;
        }
        @media (max-width: 768px) {
            .welcome-title { font-size: 2rem; }
            .welcome-shell { padding: 2rem 1.5rem; }
            .welcome-subtitle { font-size: 1rem; }
            .btn-enter { width: 100%; display: block; }
        }
    </style>
</head>
<body>
    <div class="welcome-shell">
        <h1 class="welcome-title">Bienvenido a CRUD APP</h1>
        <p class="welcome-subtitle">Sistema de gestion de clientes diseñado para adaptarse a cualquier dispositivo.</p>
        <a href="{{ route('clientes.index') }}" class="btn-enter">Ingresar al Sistema</a>
    </div>
</body>
</html>