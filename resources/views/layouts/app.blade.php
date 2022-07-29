<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Drift - A fully responsive, HTML5 based admin template">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
    <!-- /meta tags -->
    <title>NET VPN - Admin </title>

    <!-- Site favicon -->
    <link rel="shortcut icon" href="/vpn/tema/assets/images/favicon.ico" type="image/x-icon">
    <!-- /site favicon -->

    <!-- Font Icon Styles -->
    <link rel="stylesheet" href="https://drift-admin.g-axon.work/plugins/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/vpn/tema/vendors/gaxon-icon/styles.css">
    <!-- /font icon Styles -->

    <!-- Perfect Scrollbar stylesheet -->
    <link rel="stylesheet" href="https://drift-admin.g-axon.work/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <!-- /perfect scrollbar stylesheet -->

    <!-- Load Styles -->    <link rel="stylesheet" href="/vpn/tema/assets/css/semidark-style-1.min.css">

    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-bottom: 16px solid blue;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!-- /load styles -->

</head>
<body class="dt-sidebar--fixed dt-header--fixed">

<!-- Loader -->
<div class="dt-loader-container">
    <div class="dt-loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
</div>
<!-- /loader -->
<!-- Root -->
<div class="dt-root">
    <div class="dt-root__inner">
        <!-- Header -->
        <header class="dt-header">

            <!-- Header container -->
            <div class="dt-header__container">

                <!-- Brand -->
                <div class="dt-brand">

                    <!-- Brand tool -->
                    <div class="dt-brand__tool" data-toggle="main-sidebar">
                        <div class="hamburger-inner"></div>
                    </div>
                    <!-- /brand tool -->

                    <!-- Brand logo -->
                   <!-- /brand logo -->

                </div>
                <!-- /brand -->

                <!-- Header toolbar-->
                <div class="dt-nav-wrapper">
                    <!-- Header Menu -->
                    <ul class="dt-nav d-lg-none">
                        <li class="dt-nav__item dt-notification-search dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon icon-search icon-fw icon-lg"></i> </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu">

                                <!-- Search Box -->
                                <form class="search-box right-side-icon">
                                    <input class="form-control form-control-lg" type="search" placeholder="Search in app...">
                                    <button type="submit" class="search-icon"><i class="icon icon-search icon-lg"></i></button>
                                </form>
                                <!-- /search box -->

                            </div>
                            <!-- /dropdown option -->

                        </li>
                    </ul>

                    <!-- /header menu -->
                </div>
                <!-- /header toolbar -->

            </div>
            <!-- /header container -->

        </header>
        <!-- /header -->
        <!-- Site Main -->
        <main class="dt-main">
            <!-- Sidebar -->
            <aside id="main-sidebar" class="dt-sidebar">
                <div class="dt-sidebar__container">

                    <!-- Sidebar Navigation -->
                    <ul class="dt-side-nav">

                        <!-- Menu Header -->
                        <li class="dt-side-nav__item dt-side-nav__header">
                            <span class="dt-side-nav__text">main</span>
                        </li>
                        <!-- /menu header -->

                        <!-- Menu Item -->
                        <li class="dt-side-nav__item open">
                            <a href="/vpn/admin" class="dt-side-nav__link dt-side-nav__arrow" title="Dashboard">
                                <i class="icon icon-dashboard icon-fw icon-lg"></i>
                                <span class="dt-side-nav__text">Dashboard</span>
                            </a>


                            <!-- /sub-menu -->
                        </li>


                        <li class="dt-side-nav__item open">
                            <a href="/vpn/admin/country" class="dt-side-nav__link dt-side-nav__arrow" title="Server Country Add">
                                <i class="icon icon-dashboard icon-fw icon-lg"></i>
                                <span class="dt-side-nav__text">Digital Ocean Server Create</span>
                            </a>


                            <!-- /sub-menu -->
                        </li>

                        <li class="dt-side-nav__item open">
                            <a href="/vpn/admin/servermanuel" class="dt-side-nav__link dt-side-nav__arrow" title="Server Country Add">
                                <i class="icon icon-dashboard icon-fw icon-lg"></i>
                                <span class="dt-side-nav__text">Manuel Server Create</span>
                            </a>


                            <!-- /sub-menu -->
                        </li>

                        <li class="dt-side-nav__item">
                            <a href="/vpn/admin/alternative/manuel" class="dt-side-nav__link dt-side-nav__arrow" title="Server Country Add">
                                <i class="icon icon-dashboard icon-fw icon-lg"></i>
                                <span class="dt-side-nav__text">Sub Server Create</span>
                            </a>


                            <!-- /sub-menu -->
                        </li>









                    </ul>
                    <!-- /sidebar navigation -->

                </div>
            </aside>
            @yield('content')

    <!-- /site content wrapper -->

    <!-- Theme Chooser -->

    <!-- /theme chooser -->

    <!-- Customizer Sidebar -->
    <aside class="dt-customizer dt-drawer position-right">
        <div class="dt-customizer__inner">

            <!-- Customizer Header -->
            <div class="dt-customizer__header">

                <!-- Customizer Title -->
                <div class="dt-customizer__title">
                    <h3 class="mb-0">Theme Settings</h3>
                </div>
                <!-- /customizer title -->

                <!-- Close Button -->
                <button type="button" class="close" data-toggle="customizer">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- /close button -->

            </div>
            <!-- /customizer header -->

            <!-- Customizer Body -->
            <div class="dt-customizer__body ps-custom-scrollbar">
                <!-- Customizer Body Inner  -->
                <div class="dt-customizer__body-inner">

                    <!-- Section -->
                    <section>
                        <h4>Theme</h4>

                        <!-- List -->
                        <ul class="dt-list dt-list-sm" id="theme-chooser">
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-theme="light">
                                        <img src="/vpn/tema/assets/images/customizer-icons/theme-light.png" alt="Light">
                                    </a>
                                    <span class="choose-option__name">Light</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-theme="semidark">
                                        <img src="/vpn/tema/assets/images/customizer-icons/theme-normal.png" alt="Normal">
                                    </a>
                                    <span class="choose-option__name">Semi-dark</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-theme="dark">
                                        <img src="/vpn/tema/assets/images/customizer-icons/theme-dark.png" alt="Dark">
                                    </a>
                                    <span class="choose-option__name">Dark</span>
                                </div>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                    <!-- Section -->
                    <section>
                        <h4>Style</h4>

                        <!-- List -->
                        <ul class="dt-list dt-list-sm">
                            <li class="dt-list__item d-none d-lg-block">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" id="toggle-fixed-sidebar" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/fix-sidebar.png" alt="Fix Sidebar">
                                    </a>
                                    <span class="choose-option__name">Fix Sidebar</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" id="toggle-fixed-header" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/fix-header.png" alt="Fix Header">
                                    </a>
                                    <span class="choose-option__name">Fix Header</span>
                                </div>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                    <!-- Section -->
                    <section id="theme-style-chooser">
                        <h4>Color</h4>

                        <!-- List -->
                        <ul class="dt-list dt-list-sm dt-color-options">
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-1"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-2"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-3"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-4"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-5"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-6"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-7"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-8"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-9"></span>
                            </li>
                            <li class="dt-list__item">
                                <span class="dt-color-option" data-style="style-10"></span>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                    <!-- Section -->
                    <section class="d-none d-lg-block" id="sidebar-layout">
                        <h4>Sidebar Layout</h4>

                        <!-- List -->
                        <ul class="dt-list dt-list-sm">
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" id="sl-option1" data-value="folded">
                                        <img src="/vpn/tema/assets/images/customizer-icons/folded.png" alt="Folded">
                                    </a>
                                    <span class="choose-option__name">Folded</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" id="sl-option2" data-value="default">
                                        <img src="/vpn/tema/assets/images/customizer-icons/default.png" alt="Default">
                                    </a>
                                    <span class="choose-option__name">Default</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" id="sl-option3" data-value="drawer">
                                        <img src="/vpn/tema/assets/images/customizer-icons/drawer.png" alt="Drawer">
                                    </a>
                                    <span class="choose-option__name">Drawer</span>
                                </div>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                    <!-- Section -->
                    <section class="d-none d-lg-block" id="layout-chooser">
                        <h4>Layout</h4>

                        <!-- List -->
                        <ul class="dt-list dt-list-sm">
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-layout="framed">
                                        <img src="/vpn/tema/assets/images/customizer-icons/framed.png" alt="Framed">
                                    </a>
                                    <span class="choose-option__name">Framed</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-layout="full-width">
                                        <img src="/vpn/tema/assets/images/customizer-icons/full-width.png" alt="Full Width">
                                    </a>
                                    <span class="choose-option__name">Full Width</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="javascript:void(0)" class="choose-option__icon" data-layout="boxed">
                                        <img src="/vpn/tema/assets/images/customizer-icons/boxed.png" alt="Boxed">
                                    </a>
                                    <span class="choose-option__name">Boxed</span>
                                </div>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                    <!-- Section -->
                    <section>
                        <h4>Nav Style</h4>

                        <!-- List -->
                        <ul class="dt-list">
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/default" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-default.png" alt="Layout Default">
                                    </a>
                                    <span class="choose-option__name">Default</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/saas" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-saas.png" alt="Layout SAAS">
                                    </a>
                                    <span class="choose-option__name">SAAS Layout</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/listing" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-listing.png" alt="Layout listing">
                                    </a>
                                    <span class="choose-option__name">Listing</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/intranet" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-intranet.png" alt="Layout Intranet">
                                    </a>
                                    <span class="choose-option__name">Intranet</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/back-office" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-back-office.png" alt="Layout Back Office">
                                    </a>
                                    <span class="choose-option__name">Back Office</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/back-office-mini" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-back-office-mini.png"
                                             alt="Layout Back Office Minimal">
                                    </a>
                                    <span class="choose-option__name">Back Office Minimal</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/modern" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-modern.png" alt="Layout Modern">
                                    </a>
                                    <span class="choose-option__name">Modern</span>
                                </div>
                            </li>
                            <li class="dt-list__item">
                                <div class="choose-option">
                                    <a href="http://drift.g-axon.work/html-bs4/crm" target="_blank" class="choose-option__icon">
                                        <img src="/vpn/tema/assets/images/customizer-icons/layout-crm.png" alt="Layout CRM">
                                    </a>
                                    <span class="choose-option__name">CRM</span>
                                </div>
                            </li>
                        </ul>
                        <!-- /list -->

                    </section>
                    <!-- /section -->

                </div>
                <!-- /customizer body inner -->
            </div>
            <!-- /customizer body -->

        </div>
    </aside>
    <!-- /customizer sidebar -->
    </main>
</div>
</div>
<!-- /root -->


<!-- Optional JavaScript -->
<script src="https://drift-admin.g-axon.work/plugins/jquery/js/jquery.min.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/moment/js/moment.min.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Perfect Scrollbar jQuery -->
<script src="https://drift-admin.g-axon.work/plugins/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
<!-- /perfect scrollbar jQuery -->

<!-- masonry script -->
<script src="https://drift-admin.g-axon.work/plugins/masonry-layout/js/masonry.pkgd.min.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/sweetalert2/js/sweetalert2.js"></script>
<script src="/vpn/tema/assets/js/functions.js"></script>
<script src="/vpn/tema/assets/js/customizer.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/chart.js/js/Chart.min.js"></script>

<!-- Resources -->
<script src="https://drift-admin.g-axon.work/plugins/ammap3/js/ammap.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/ammap3/js/continentsLow.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/ammap3/js/light.js"></script>

<script src="https://drift-admin.g-axon.work/plugins/amcharts3/js/amcharts.js"></script>
<script src="https://drift-admin.g-axon.work/plugins/amcharts3/js/gauge.js"></script>

<script src="/vpn/tema/assets/js/custom/charts/dashboard-default.js"></script>
<!-- Custom JavaScript -->
<script src="/vpn/tema/assets/js/script.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#submitbutton').click(function() {
            $(".dt-loader-container").css("display", "block");
        });


        function callAjax(){
            $.ajax({
                type : 'get',
                url : '/vpn/admin/liveuser',
                success:function(data){
                    $.each(data.actives, function (index, value) {
                        $('#server_'+value.id).html('');
                        $('#server_'+value.id).append('Live User:'+value.activeuser);
                    });
                }
            });
        }

        setInterval(callAjax, 5000 );


    });
</script>
@include('sweet::alert')

<script>
    $(document).on('click', '#delete-confirm', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/deleteServer/'+id,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");

                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });
    $(document).on('click', '#delete-confirm-sub', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/deleteServersub/'+id,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");

                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });
    $(document).on('click', '#addUser-confirm', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var usercount = $(this).data('usercount');
        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/adduser/'+id+'/'+usercount,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");
                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });
    $(document).on('click', '#addUser-confirm-sub', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var usercount = $(this).data('usercount');
        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/addusersub/'+id+'/'+usercount,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");
                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });
    $(document).on('click', '#reset-confirm', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/reset/'+id,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");
                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });

    $(document).on('click', '#reset-confirm-sub', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $(".dt-loader-container").css("display", "block");

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '/vpn/admin/resetsub/'+id,
                    success: function (data) {
                        $(".dt-loader-container").css("display", "none");
                    },
                    error: function() {
                    }
                });
            } else {
                $(".dt-loader-container").css("display", "none");
            }
        })
    });

    $('#ip_input').hide();
    $('#ssh_input').hide();
    $('#manuel_region').hide();
    $('#digital_region').show();

    $('input[type=radio][name=company]').change(function() {
        if (this.value == 'Digitalocean') {
            
            $('#ip_input').hide();
            $('#ssh_input').hide();
            $('#manuel_region').hide();
            $('#digital_region').show();
        }else{
            $('#ip_input').show();
            $('#ssh_input').show();
            $('#manuel_region').show();
            $('#digital_region').hide();

        }

    });




</script>



</body>

</html>

