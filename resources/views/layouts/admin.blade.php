<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
            color: #fff;
            padding: 20px 15px;
        }

        .sidebar h4 {
            margin-bottom: 30px;
        }

        .sidebar .nav-link {
            color: #ccc;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 8px;
            display: block;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .logout-btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @include('admin.includes.sidebar')
    <div class="content">
        @yield('content')
    </div>

</body>

</html>