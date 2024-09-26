<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <style>
            header{
                height: 80px;
                background-color: rgb(65, 64, 64);
                align-items: center;
            }
            .menu_btn{
                width: 100%;
                background-color: rgb(24, 25, 26);
                color: #fff;
                height: 50px;
            }
            .menu_btn:hover{
                background-color:rgb(5, 182, 5);
                color: #fff;
            }
            .active_btn{
                background-color: green !important;
            }
            .sidebar{
                height: 80vh;
            }
        </style>

    </head>

    <body>
        <div class="container">
           <header class="p-3 d-flex justify-content-between">
                <h5 class="text-light">{{ auth()->user()->name }}</h5>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class=" btn btn-danger"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                           Logout
                    </button>
                </form>
           </header>
           <div class="row mt-3">
            <div class="sidebar col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <a href="{{ route('dashboard') }}" class="btn menu_btn {{ Route::is('dashboard') ? 'active_btn' : '' }}">Dashboard</a>
                        <a href="{{ route('tickets.index') }}" class="btn menu_btn mt-3 {{ Route::is('tickets.index') ? 'active_btn' : '' }}">Tickets</a>
                    </div>
                </div>
            </div>
            <div class="body-section col-md-9">
                @yield('content')
            </div>
           </div>
        </div>
        
        
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
