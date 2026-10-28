<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventori')</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f6f8; color: #222; }
        nav { background: #0f766e; padding: 14px 24px; color: #fff; }
        nav a { color: #fff; text-decoration: none; font-weight: 600; }
        main { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        .card { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 14px; }
        th { background: #f9fafb; }
        .btn { display: inline-block; padding: 8px 14px; border-radius: 6px; border: 0; background: #0f766e; color: #fff; text-decoration: none; cursor: pointer; font-size: 14px; }
        .btn-danger { background: #b91c1c; }
        .btn-light { background: #e5e7eb; color: #222; }
        .badge { padding: 3px 8px; border-radius: 999px; font-size: 12px; }
        .badge-low { background: #fee2e2; color: #991b1b; }
        .badge-ok { background: #dcfce7; color: #166534; }
        .alert { padding: 12px; border-radius: 6px; margin-bottom: 16px; background: #dcfce7; color: #166534; }
        .error { color: #b91c1c; font-size: 13px; margin-top: 4px; }
        label { display: block; font-size: 14px; margin-bottom: 4px; font-weight: 600; }
        input, select, textarea { width: 100%; padding: 9px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; margin-bottom: 12px; font-size: 14px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 16px; }
        .row { display: flex; gap: 8px; align-items: center; justify-content: space-between; }
        .pagination { margin-top: 16px; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('items.index') }}">Inventori</a>
</nav>
<main>
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
