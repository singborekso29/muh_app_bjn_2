<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP_MUH_BJN
    
    </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">            
</head>

<body>

    @include('dashboard.header')

    <div class="d-flex">

        @include('dashboard.sidebar')

        <div class="p-4 w-100">
            @yield('content')
        </div>

    </div>

    @include('dashboard.footer')
    @stack('scripts')

</body>

</html>