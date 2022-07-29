@extends('layouts.crm')
@section('content')

    <div class="dt-content-wrapper">

        <!-- Site Content -->
        <div class="dt-content">

            <!-- Grid -->
            <div class="row">

                <!-- Grid Item -->
                <div class="col-xl-12">

                    <!-- Module -->
                    <div class="dt-module" style="height: 424px;">

                        <!-- Module Sidebar -->
                        <div class="dt-module__sidebar">

                            <!-- Sidebar Header -->
                            <div class="dt-module__sidebar-header">

                                <!-- App Quick Menu -->
                                <div class="quick-menu-list">

                                    <!-- Search Box -->
                                    <form class="search-box d-md-none">
                                        <input class="form-control" type="search" id="address" name="address" placeholder="Search in app...">
                                        <button type="submit" class="search-icon"><i class="icon icon-search icon-lg"></i></button>
                                    </form>
                                    <!-- /search box -->

                                    <a href="javascript:void(0)" class="quick-menu d-none d-md-block" data-toggle="mdrawer" data-target="#drawer-search-bar"><i class="icon icon-search"></i></a>
                                    <a href="javascript:void(0)" class="quick-menu" data-toggle="mdrawer" data-target="#drawer-notifications"><i class="icon icon-notification2"></i></a>
                                    <!-- Dropdown -->

                                    <!-- /dropdown -->
                                </div>
                                <!-- /app quick menu -->

                            </div>
                            <!-- /sidebar header -->

                            <!-- Sidebar Menu -->
                            <div class="dt-module__sidebar-content pt-md-7 ps-custom-scrollbar ps" style="height: 220px;">

                                <!-- Sidebar Navigation -->
                                <ul class="dt-module-side-nav">

                                    <!-- Menu Header -->
                                    <li class="dt-module-side-nav__header">
                                        <span class="dt-module-side-nav__text">QUICK MENU</span>
                                    </li>
                                    <!-- /menu header -->

                                    <!-- Menu Item -->
                                    <li class="dt-module-side-nav__item active">
                                        <a href="javascript:void(0)" class="dt-module-side-nav__link">
                                            <i class="icon icon-dashboard icon-fw icon-lg"></i>
                                            <span class="dt-module-side-nav__text">Dashboard</span> </a>
                                    </li>
                                    <!-- /menu item -->

                                    <!-- Menu Item -->
                                    <li class="dt-module-side-nav__item">
                                        <a href="javascript:void(0)" class="dt-module-side-nav__link">
                                            <i class="icon icon-description icon-fw icon-lg"></i>
                                            <span class="dt-module-side-nav__text">My Tasks</span> </a>
                                    </li>
                                    <!-- /menu item -->

                                    <!-- Menu Item -->
                                    <li class="dt-module-side-nav__item">
                                        <a href="javascript:void(0)" class="dt-module-side-nav__link">
                                            <i class="icon icon-users icon-fw icon-lg"></i>
                                            <span class="dt-module-side-nav__text">My Watchlist</span> </a>
                                    </li>
                                    <!-- /menu item -->

                                </ul>
                                <!-- /sidebar navigation -->

                                <!-- Contacts -->
                                <!-- contacts -->

                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                            <!-- /sidebar Menu -->

                        </div>
                        <!-- /module sidebar -->

                        <!-- Module Container -->
                        <div class="dt-module__container">

                            <!-- Module Header -->
                            <div class="dt-module__header">


                                <!-- Title -->
                                <div class="mx-auto text-center">
                                    <h3 class="dt-module__title">Logs</h3>
                                    <i class="icon icon-horizontal-more icon-xl"></i>
                                </div>
                                <!-- Title -->

                                <!-- Filter -->
                                <a class="dt-module__filter text-dark" href="javascript:void(0)">
                                    <i class="icon icon-filter-new icon-xl"></i> </a>
                                <!-- /filter -->

                            </div>
                            <!-- /module header -->

                            <!-- Module Content -->
                            <div class="dt-module__content ps-custom-scrollbar ps ps--active-y" style="height: 37.3594px;">

                                <!-- Module Content Inner -->
                                <div class="dt-module__content-inner">

                                    <!-- Module List -->
                                    <div class="dt-module__list">

                                        <!-- Module Heading -->
                                        <h5 class="text-light-gray mb-2">Logs</h5>
                                        <!-- /module heading -->

                                        @foreach($logs as $log)
                                        <!-- Module Item -->
                                            <div class="dt-module__list-item">

                                                <!-- Checkbox Icon -->
                                                <span class="dt-checkbox dt-checkbox-icon dt-checkbox-only mr-4">
                                                  <input id="icon-checkbox-1" type="checkbox">
                                                  <label class="font-weight-light dt-checkbox-content" for="icon-checkbox-1">
                                                    <span class="unchecked">
                                                      <i class="icon icon-circle-check-o icon-fw icon-1x text-light-gray"></i>
                                                    </span>
                                                    <span class="checked">
                                                      <i class="icon icon-circle-check-o icon-fw icon-1x text-success"></i>
                                                    </span>
                                                  </label>
                                                </span>
                                                <!-- /checkbox icon -->

                                                <!-- Module Content -->
                                                <a href="#" class="dt-module__list-item-content"> {{$log->process_descp}} </a>
                                                <!-- /module content -->

                                                <!-- Module Info -->
                                                <div class="dt-module__list-item-info">
                                                    <div class="badge-group">
                                                        <span class="badge bg-dark-blue text-white">{{$log->process_name}}</span>
                                                        <span class="badge badge-danger">{{$log->ip}}</span>
                                                    </div>
                                                    <?php $createdtime = strtotime($log->created_at)+3*60*60;  $newdate = date('d-m-y H:i', $createdtime);?>
                                                    <span>{{$newdate}}</span>
                                                </div>
                                                <!-- /module info -->
                                            </div>
                                            <!-- /module item -->
                                        @endforeach


                                    </div>
                                    <!-- /module list -->


                                </div>
                                <!-- /module content inner -->

                                <div class="ps__rail-x" style="left: 0px; bottom: -133px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 133px; right: 0px; height: 415px;"><div class="ps__thumb-y" tabindex="0" style="top: 101px; height: 314px;"></div></div></div>
                            <!-- /module content -->

                        </div>
                        <!-- /module container -->

                        <!-- Module Drawer -->
                        <!-- /module drawer -->

                    </div>
                    <!-- /module -->

                </div>
                <!-- /grid item -->

            </div>
            <!-- /grid -->

        </div>
        <!-- /site content -->

    </div>

@endsection