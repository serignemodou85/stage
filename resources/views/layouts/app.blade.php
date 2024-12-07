<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Style personnalisé pour un design moderne et professionnel -->
    <style>
        body {
            background-color: #f7f7f7;
            color: #343a40;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #007bff;
            padding: 15px;
        }

        .navbar a {
            color: #fff;
            font-size: 1.2rem;
        }

        h2, h1, h3 {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .container-fluid {
            padding-top: 30px;
        }

        .card {
            border-radius: 12px;
            border: none;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr {
            background-color: #fff;
            transition: all 0.2s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .badge {
            font-size: 1rem;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Contenu principal -->
    <div class="container-fluid mt-4">
        @yield('content')
    </div>    

    <!-- Bootstrap JS et Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
