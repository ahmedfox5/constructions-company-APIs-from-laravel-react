<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('imgs/logo.png')}}" >
    <title>Logo Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("css/OverlayScrollbars.min.css")}}">

    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">


    <link rel="stylesheet" href="{{asset('dist/notify/notifications.css')}}">
    <script src="{{asset('dist/notify/notifications.js')}}"></script>


    <style>
        input ,textarea{
            background: #ffffff66;
            border: 1px solid #777777
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">



<script>
    var canvas = document.createElement("canvas");
    function setCanvasWidth(){
        canvas.width = innerWidth;
        canvas.height= innerHeight;
    }
    canvas.style.position = 'fixed';
    canvas.style.filter = 'blur(10px)';
    setCanvasWidth();
    document.body.appendChild(canvas);
    window.onresize = () => {
        setCanvasWidth();
    }

    var ctx = canvas.getContext("2d");



    var circle = function (color ,direction){
        this.counter = 0 ;
        this.direction = direction;
        this.x_add = Math.floor(Math.random() * 10) * this.direction;
        this.y_add = Math.floor(Math.random() * 10) * this.direction;
        this.x = Math.floor(Math.random() * (canvas.width-200) + 300) ;
        this.y = canvas.height - 100;
        this.color = color;
        this.top_distance = Math.floor(Math.random() * 15 + 4);



        this.draw = (x1 ,y1) => {
            ctx.fillStyle = "#ffffff05";
            ctx.rect(0,0,canvas.width ,canvas.height);
            ctx.fill();
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(x1 ,y1 ,350 ,0 ,Math.PI * 2);
            ctx.fill();
        }

        this.movement = () => {
            requestAnimationFrame(this.movement);
            this.counter += .05;
            this.x+=this.x_add;
            // this.y += Math.cos(this.counter) * this.top_distance ;
            this.y += this.y_add;
            if(this.x >= canvas.width || this.x <= 0){
                this.x_add *= -1;
            }
            if(this.y >= canvas.height || this.y <= 0){
                this.y_add *= -1;
            }
            this.draw(this.x ,this.y);

        }

        this.movement();
    }


    new circle("#33229915" ,1);
    new circle("#99223315" ,-1);
    new circle("#33dd2215" ,1);
    new circle("#99991115" ,-1);

    new circle("#D4AC0D15" ,-1);
    new circle("#A569BD15" ,1);
    new circle("#A569BD15" ,-1);


</script>


<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fox-glass1-light f-glass1-cont-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{asset('dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{asset('dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel  d-flex">
                    <div class="image">
                        <img src="{{asset('dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">username</a>
                    </div>
                </div>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4 fox-glass1-light f-glass1-cont-light">
        <!-- Brand Logo -->
        <a href="#" style="height: 100px" class=" fox-glass2-light">
            <img src="{{asset('imgs/logo.png')}}" class=" m-auto d-flex " style="height: 60px;top: 2em; position: relative">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link d-home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                                {{--                                <span class="right badge badge-danger">New</span>--}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('pages.content')}}" class="nav-link d-pages">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Pages Content
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('projects')}}" class="nav-link d-projects">
                            <i class="nav-icon fa fa-building"></i>
                            <p>
                                projects
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('employees')}}" class="nav-link d-employees">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Employees
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{route('messages')}}" class="nav-link d-messages">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Messages
                            </p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper fox-glass1-light">

        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-light">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js//adminlte.min.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('js/jquery.mousewheel.js')}}"></script>
<script src="{{asset('js/raphael.min.js')}}"></script>
<script src="{{asset('js/jquery.mapael.min.js')}}"></script>
<script src="{{asset('js/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('js/Chart.min.js')}}"></script>

@yield('script')

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('js/dashboard2.js')}}"></script>--}}

</body>
</html>
