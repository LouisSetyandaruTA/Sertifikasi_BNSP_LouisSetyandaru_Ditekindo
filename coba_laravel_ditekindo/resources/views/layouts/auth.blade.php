<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.styles')
    <style>
        body { background-color: #4e73df; background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%); background-size: cover; height: 100vh; }
        .card-auth { margin-top: 10%; border: none; border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    @include('includes.script')
</body>
</html>
