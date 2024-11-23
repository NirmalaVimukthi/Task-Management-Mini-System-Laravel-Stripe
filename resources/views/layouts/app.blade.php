<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet">
    
    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    
    <!-- Custom CSS for Sidebar -->
    <style>
:root {
    --sidebar-width: 300px;
    --slidebar-padding:10px;
}


html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

#app {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    height:100%;
}


        body{
            background-image: linear-gradient(to top, #dce6f1 0%, rgb(233 238 244) 100%);
        }


        /* Custom styles to handle desktop and mobile sidebar behavior */
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            top: 55;
            left: 0;
            z-index: 1030; /* Make sure it is above the main content */
        
         
            transition: transform 0.3s ease;
            padding: var(--slidebar-padding);
    
        }

        /* Hide the sidebar by default on mobile */
        .sidebar-hidden {
            transform: translateX(-100%);
        }


        .main-content {
           
                min-height: 100%;
                padding-top: 65px;
                overflow-y: scroll;
                overflow-x: hidden;
                padding-top: 100px !important;
            }
        


        .navbar{
            top: 0px;
            position: fixed;
            z-index: 1080;
            left: 0px;
            width: 100%;
           

        }

        .navbar .container{
            background: rgb(255 255 255 / 55%);
            border-radius: 10px;
            /* box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); */
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            height: 55px;


        }

        .card{
            border: 0.1px solid #d3d3d380;
        }

        /* .row{
            margin-bottom:20px;    

        } */


       .padding-2{
            padding: 2px;
            height: fit-content;
        }

            /* class for windesign  */

            .win-menu{
                font-size: 14px;
                color: black;
                margin-top: 55px;

            }

            
            .win-menu .nav-link{
                color:black;
            }

            .win-menu ul li {
               display:flex;
               padding: 0px 10px;
                border-radius: 5px;
                cursor: pointer;
                border-left: 6px solid #ffffff00;

            }

            .win-menu ul li img{
                width: auto;
                height: 24px;
                margin: 8px 0px;
            }

            .win-menu ul li:hover {
                background-color: #d3d3d38c;
                border-left: 6px solid dodgerblue;
                background: rgb(255 255 255 / 55%);
                border-radius: 5px;
                /* box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); */
                backdrop-filter: blur(5px);
                /* transition:  0.1s */
            }

            .win-menu ul .active{
                background-color: #d3d3d38c;
                border-left: 6px solid dodgerblue;
                background: rgb(255 255 255 / 55%);
                border-radius: 5px;
                /* box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); */
                backdrop-filter: blur(5px);
            }

            .navbar .container .icon{
                height: 38px;
                margin-right: 10px;
            }

            .navbar .container .navbar-brand{
                

                font-weight: 700;
                color: #495057;
            }

        /* Show sidebar on larger screens */
        @media (min-width: 768px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: none;
             
            }

            /* Adjust the main content margin to make room for the sidebar */
            .main-content {
                margin-left: var(--sidebar-width);
                padding-right: 65px;
              
            }
            .navbar .container{
                margin-left:var(--sidebar-width);
                margin-right: 65px;
              
            }
        }
    </style>
</head>
<body>
    <div id="app">


    <nav class="navbar navbar-expand-md navbar-light bg-transparent">
            <div class="container">
                <!-- Sidebar Toggle Button for Mobile -->
                <button class="btn btn-primary d-md-none" id="sidebarToggle">
                    ☰ Menu
                </button>
                <a class="navbar-brand ms-2" href="{{ url('/') }}">
                <img class="icon" src="/icons/task.png">
                   Task Management System 
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Single Sidebar -->
        <div class="sidebar sidebar-hidden" id="sidebar">
            <div class="pt-3 win-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <img src="/icons/dashboard.png">
                        <a class="nav-link " href="/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <img src="/icons/create.png">
                        <a class="nav-link " href="{{ route('create') }}">New Task</a>
                    </li>
                    <li class="nav-item">
                        <img src="/icons/task1.png">
                        <a class="nav-link " href="{{ route('tasks') }}">All Tasks</a>
                    </li>
                    <li class="nav-item">
                    <img src="/icons/user.png">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                    <img src="/icons/settings.png">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                    <img src="/icons/power-off.png">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="main-content py-4 ">

    

            <div class="container ">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- JavaScript to Handle Sidebar Toggle on Mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebarToggle');

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('sidebar-hidden');
            });
        });
    </script>
</body>
</html>
