<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard | NPHKK</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{asset('backend')}}/dist-assets/css/themes/lite-purple.min.css" rel="stylesheet" />
    <link href="{{asset('backend')}}/dist-assets/css/plugins/perfect-scrollbar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend')}}/dist-assets/css/plugins/toastr.css"/>
    <link rel="stylesheet" href="{{asset('backend')}}/dist-assets/css/plugins/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@anuz-pandey/nepali-date-picker/dist/nepali-date-picker.min.css">
</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large">
    <div class="main-header">
        <div class="logo">
            <img src="https://nph.nepalpolice.gov.np/static/assets/images/logo%201.png" alt="">
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div style="margin: auto"></div>
        <div class="header-part-right">
            <!-- Full screen toggle -->
            <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
            <!-- User avatar dropdown -->
            <div class="dropdown">
                <div class="user col align-self-end">
                    <img src="https://membership.nesog.org.np/backend/dist-assets/images/logout.png" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i>{{auth()->user()->name}}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item ai-icon" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <svg class="logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fd5353" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ms-2 text-danger">Logout </span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side-content-wrap">
        <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <ul class="navigation-left">
{{--                @if(auth()->user())--}}
{{--                    @foreach(auth()->user()->role as $role)--}}
{{--                        @if($role->name == 'Super Admin')--}}
                                            <li class="nav-item" data-item="maghFaram"><a class="nav-item-hold" href="#"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Magh Faram</span></a>
                                                <div class="triangle"></div>
                                            </li>
                            <li class="nav-item"><a class="nav-item-hold" href="{{route('fiscalYear.index')}}"><i class="nav-icon i-Calendar-2"></i><span class="nav-text">Fiscal Year</span></a>
                                <div class="triangle"></div>
                            </li>
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endif--}}
            </ul>
        </div>
        <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
            <!-- Submenu Dashboards-->
            <ul class="childNav" data-parent="maghFaram">
                <li class="nav-item"><a href="{{route('maghFaram.create')}}"><i class="nav-icon i-Clock-3"></i><span class="item-name">Create</span></a></li>
                <li class="nav-item"><a href="{{route('maghFaram.index')}}"><i class="nav-icon i-Clock-3"></i><span class="item-name">List</span></a></li>
            </ul>
        </div>
        <div class="sidebar-overlay"></div>
    </div>
    <!-- =============== Left side End ================-->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <!-- ============ Body content start ============= -->
        <div class="main-content">


            @yield('content')


        </div><!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <div class="app-footer">
            <div class="row">
                <div class="col-md-9">
                    <p><strong>नेपाल प्रहरी अस्पताल कल्याण कोष</strong></p>
                </div>
            </div>
            <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                <span class="flex-grow-1"></span>
                <div class="d-flex align-items-center">
                    <img class="logo" src="https://omwaytechnologies.com/frontend/assets/img/omway.png" alt="">
                    <div>
                        <p class="m-0">&copy; <?php echo date("Y"); ?> Omway Technologies</p>
                        <p class="m-0">All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- fotter end -->
    </div>
</div>

<script src="{{asset('backend')}}/dist-assets/js/plugins/jquery-3.3.1.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/plugins/bootstrap.bundle.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/sidebar.large.script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/plugins/echarts.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/echart.options.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/dashboard.v1.script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/customizer.script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/plugins/datatables.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/datatables.script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/form.validation.script.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/plugins/toastr.min.js"></script>
<script src="{{asset('backend')}}/dist-assets/js/scripts/toastr.script.min.js"></script>

@if(Session::has('status'))
    <script>
        toastr.success("{!! Session::get('status') !!}");
    </script>
@endif
@if(Session::has('delete'))
    <script>
        toastr.error("{!! Session::get('delete') !!}");
    </script>
@endif


<!-- Footer or bottom of body -->
<script src="https://cdn.jsdelivr.net/npm/@anuz-pandey/nepali-date-picker/dist/nepali-date-picker.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nepaliInput = document.getElementById("nepaliDate");
        const englishInput = document.getElementById("englishDate");

        // Initialize picker
        const picker = new NepaliDatePicker('#nepaliDate', {
            onChange: ({ bsDate, adDate }) => {
                const englishInput = document.getElementById("englishDate");
                const formattedAd = adDate.toISOString().split('T')[0]; // YYYY-MM-DD
                englishInput.value = formattedAd;
            }
        });
    });
</script>

</body>

</html>
