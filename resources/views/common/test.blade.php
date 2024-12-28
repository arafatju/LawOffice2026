<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,
                   initial-scale=1.0">
    <title>Officers Transfer Management System</title>
  
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
          rel="stylesheet"
        integrity=
"sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="style.css">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity=
"sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
  
  .bg-purple {
    background-color: #6f42c1; /* A common purple shade */
    color: #fff; /* Optional: ensure text contrasts well */
}
html, body {
    height: 100%;
    font-family: 'Ubuntu', sans-serif;
}

.gfg {
    height: 50px;
    width: 50px;

}

.mynav {
    color: #fff;
}

.mynav li a {
    color: #fff;
    text-decoration: none;
    width: 100%;
    display: block;
    border-radius: 5px;
    padding: 8px 5px;
}

.mynav li a.active {
    background: rgba(255, 255, 255, 0.2);
}

.mynav li a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.mynav li a i {
    width: 25px;
    text-align: center;
}

.notification-badge {
    background-color: rgba(255, 255, 255, 0.7);
    float: right;
    color: #222;
    font-size: 11px;
    padding: 0px 2px;
    border-radius: 2px;
}
    </style>



    </head>

<body>

    <div class="container-fluid p-0 d-flex h-100">
        <div id="bdSidebar" 
             class="d-flex flex-column 
                    flex-shrink-0 
                    p-3 bg-success
                    text-white offcanvas-md offcanvas-start">
            <a href="#" 
               class="navbar-brand"> Officer Transfer Management System
            </a><hr>
            <ul class="mynav nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="#">
                        <i class=" fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="#">
                        <i class="fa-solid fa-user-shield"></i>
                        User Management
                         
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{route('dash2')}}">
                        <i class="fa-solid fa-table"></i>
                        Data Sheet 
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit & Delete
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#">
                        <i class="fa-solid fa-user-cog"></i>
                       Change  Password 
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#">
                     <i class="fa-solid fa-envelope "></i> 
                       Change  Email 
                    </a>
                </li>
                <li class="sidebar-item  nav-item mb-1">
                    <a href="#" 
                       class="sidebar-link collapsed" 
                       data-bs-toggle="collapse"
                       data-bs-target="#settings"
                       aria-expanded="false"
                       aria-controls="settings">
                        <i class="fas fa-cog pe-2"></i>
                        <span class="topic">Settings </span>
                    </a>
                    <ul id="settings" 
                        class="sidebar-dropdown list-unstyled collapse" 
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-sign-in-alt pe-2"></i>
                                <span class="topic"> Loginfo </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-user-plus pe-2"></i>
                                <span class="topic">Special Code</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-sign-out-alt pe-2"></i>
                                <span class="topic">Device Registration</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{route('signout')}}">
                     <i class="fas fa-sign-out-alt"></i> 
                       Logout
                    </a>
                </li>
            </ul>
             
        </div>
        <main class="container-fluid" >
    @yield('content')
</main>
       
    </div>
</body>

</html>