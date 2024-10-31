<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Your Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Include your app styles and scripts -->
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session()->has('toast'))
        <script>
            Toastify({
                text: "{{ session('toast.message') }}",
                duration: 3000, // Duration in milliseconds
                gravity: "top", // 'top' or 'bottom'
                position: 'right', // 'left', 'center' or 'right'
                backgroundColor: "{{ session('toast.type') === 'success' ? '#4CAF50' : '#F44336' }}",
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        </script>
    @endif
</body>
</html>
