@extends('layouts.crm')
@section('content')
    <div class="dt-content-wrapper">

        <!-- Site Content -->
        <div class="dt-content">

            <!-- Page Header -->
            <div class="dt-page__header">
                <h1 class="dt-page__title">Dashboard - Server</h1>
            </div>
            <!-- /page header -->

            <!-- Entry Header -->
            <div class="dt-entry__header">

                <!-- Entry Heading -->
                <div class="dt-entry__heading">
                    <h3 class="dt-entry__title">Server &amp; Management</h3>
                </div>
                <!-- /entry heading -->
                <a href="/vpn/admin/ipsecall" class="btn btn-warning text-uppercase" style="float: right;color: white;">All Ipsec Reset</a>

            </div>
            <!-- /entry header -->


            <!-- Grid -->
            <div class="row mb-sm-8">

                <!-- Grid Item -->
                <!-- /grid item -->

                <!-- Grid Item -->
                <div class="col-md-12">

                    <!-- Card -->
                    <div class="dt-card dt-card__full-height">

                        <!-- Card Header -->
                        <div class="dt-card__header">

                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                                <h3 class="dt-card__title">Server &amp; Management                                                                 
                                    <a href="javascript:void(0)" class="badge badge-danger mb-1 mr-1" id="pageCron">Cronjob Working</a>
                                </h3>
                            </div>
                            <!-- /card heading -->

                        </div>
                        <!-- /card header -->

                        <!-- Card Body -->
                        <div class="dt-card__body pb-3">

                            <!-- Campaigns Widget -->
                            <div class="campaigns-widget">

                                <!-- Grid -->
                                <div class="row no-gutters pb-3 mb-1 border-bottom">

                                    <!-- Grid Item -->
                                    <div class="col-5 col-sm-6 text-truncate pr-2">
                                        Country Name
                                    </div>
                                    <!-- /grid item -->

                                    <!-- Grid Item -->
                                    <div class="col-7 col-sm-6">
                                        Leads & Conversion
                                    </div>
                                    <!-- /grid item -->

                                </div>
                                <!-- /grid -->

                                <!-- Widget -->
                                <div class="dt-widget dt-widget-hover-bg">

                                    <!-- Widget Item  foreach buradan -->
                                    @foreach($datas as $data)
                                        <div class="dt-widget__item">

                                            <!-- Grid -->
                                            <div class="row no-gutters">

                                                <!-- Grid Item -->
                                                <div class="col-6 col-sm-6 pr-2">
                                                    <div class="row">
                                                        <div class="col-6 col-sm-6">
                                                            @if($data->countstatus == '1')
                                                                <span class="d-inline-block text-success" style="font-size: 10px;">VISIBLE</span>

                                                            @else
                                                                <span class="d-inline-block text-danger" style="font-size: 10px;">HIDDEN</span>

                                                            @endif
                                                            <p class="dt-widget__title mb-0 text-truncate">{{$data->country}} {{$data->city}}
                                                                @if($data->type=='free')
                                                                    <span class="d-inline-block text-success">{{$data->type}}</span>
                                                                @else
                                                                    <span class="d-inline-block text-info">{{$data->type}}</span>
                                                                @endif
                                                            </p>
                                                            <span>{{$data->ip}} </span>
                                                        </div>

                                                        <div class="col-6 col-sm-6">
                                                            <span><div id="server_{{$data->serverid}}"></div></span>
                                                        </div>
                                                    </div>

                                            </div>
                                                <!-- /grid item -->

                                                <!-- Grid Item -->
                                                <div class="col-6 col-sm-6">
                                                    <div class="row no-gutters">
                                                        <div class="col-sm-6 col-7">
                                                                <span class="d-inline-block text-nowrap">
                                                                    <span class="text-dark">{{$data->status_sum}}</span> out of <span
                                                                            class="text-dark">{{$data->totalcount}}</span>
                                                                </span>
                                                        </div>
                                                        <div class="col-sm-2 col-2 text-center">

                                                            <?php $sum = number_format($data->status_sum*100/$data->totalcount); ?>
                                                            @if( $sum > 50)
                                                                <span class="d-inline-block text-danger">
                                                        @else
                                                                        <span class="d-inline-block text-success">
                                                        @endif
                                                                            {{number_format($data->status_sum*100/$data->totalcount),2}}%


                                                        </span>
                                                        </div>

                                                        <div class="col-sm-4 col-4 text-right">
                                                            <!-- Dropdown -->

                                                            <div class="dropdown d-inline-block">
                                                                <a class="dropdown-toggle no-arrow" href="#"
                                                                   data-toggle="dropdown"
                                                                   aria-haspopup="true" aria-expanded="false">
                                                                    <i class="icon icon-vertical-more icon-fw text-light-gray"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-right">

                                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                        Add User
                                                                    </button>
                                                                    <div class="dropdown-menu" x-placement="left-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-165px, 0px, 0px);">
                                                                        <a class="dropdown-item" href="#" id="addUser-confirm" data-id="{{$data->countid}}" data-usercount="100">100 user Add</a>
                                                                        <a class="dropdown-item" href="#" id="addUser-confirm" data-id="{{$data->countid}}" data-usercount="300">300 user Add</a>
                                                                        <a class="dropdown-item" href="#" id="addUser-confirm" data-id="{{$data->countid}}" data-usercount="500">500 user Add</a>
                                                                    </div>
                                                                    <a class="dropdown-item"
                                                                       href="#" id="reset-confirm" data-id="{{$data->countid}}">All User Reset</a>
                                                                    <a class="dropdown-item"
                                                                       href="/vpn/admin/changePaid/{{$data->countid}}/{{$data->type}}">Change Paid-Free</a>
                                                                    <a class="dropdown-item"
                                                                       href="/vpn/admin/serverEdit/{{$data->countid}}">Edit</a>
                                                                    <a class="dropdown-item"
                                                                       href="/vpn/admin/hideshow/{{$data->countid}}/{{$data->countstatus}}">Hide-Show In App</a>
                                                                    <a class="dropdown-item"
                                                                       href="/vpn/admin/deleteServer/{{$data->countid}}" id="delete-confirm" data-id="{{$data->countid}}">Delete</a>
                                                                </div>
                                                            </div>
                                                            <!-- /dropdown -->
                                                            <a href="/vpn/admin/ipsec/{{$data->countid}}" class="badge badge-danger mb-1 mr-1" id="">ipSec Restart</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /grid item -->

                                            </div>
                                            <!-- /grid -->

                                        </div>

                                        <?php

                                        $sub_datas = App\UserListModel::join('country_list','user_list.country_id','country_list.id')
                                            ->join('server_list','user_list.server_id','server_list.id')
                                            ->select('server_list.id as serverid','server_list.ip as ip','server_list.server_company','server_list.ust_server_id as ustserverid','country_list.id as countid','country_list.status as countstatus','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"), DB::raw('COALESCE(SUM(user_list.status), 1) AS status_sum'))
                                            ->where('ust_server_id',$data->serverid)
                                            ->groupBy('server_list.id')
                                            ->get();

                                        ?>
                                        @if(count($sub_datas)>0)
                                            @foreach($sub_datas as $sub_data)
                                                <div class="dt-widget__item">

                                                    <!-- Grid -->
                                                    <div class="row no-gutters">

                                                        <!-- Grid Item -->
                                                        <div class="col-6 col-sm-6 pr-2" style="left: 10%;" >
                                                            @if($sub_data->countstatus == '1')
                                                                <span class="d-inline-block text-success" style="font-size: 10px;">VISIBLE</span>

                                                            @else
                                                                <span class="d-inline-block text-danger" style="font-size: 10px;">HIDDEN</span>

                                                            @endif
                                                            <p class="dt-widget__title mb-0 text-truncate">
                                                                <span class="d-inline-block text-info">SUB SERVER</span>

                                                                @if($sub_data->type=='free')
                                                                    <span class="d-inline-block text-success">{{$sub_data->type}}</span>
                                                                @else
                                                                    <span class="d-inline-block text-info">{{$sub_data->type}}</span>
                                                                @endif

                                                            </p>
                                                            <span>{{$sub_data->ip}}  <div id="server_{{$sub_data->serverid}}"></div> </span>

                                                        </div>
                                                        <!-- /grid item -->

                                                        <!-- Grid Item -->
                                                        <div class="col-6 col-sm-6">
                                                            <div class="row no-gutters">
                                                                <div class="col-sm-6 col-7">
                                                                <span class="d-inline-block text-nowrap">
                                                                    <span class="text-dark">{{$sub_data->status_sum}}</span> out of <span
                                                                            class="text-dark">{{$sub_data->totalcount}}</span>
                                                                </span>
                                                                </div>
                                                                <div class="col-sm-4 col-4 text-center">

                                                                    <?php $sum = number_format($sub_data->status_sum*100/$sub_data->totalcount); ?>
                                                                    @if( $sum > 50)
                                                                        <span class="d-inline-block text-danger">
                                                        @else
                                                                                <span class="d-inline-block text-success">
                                                        @endif
                                                                                    {{number_format($sub_data->status_sum*100/$sub_data->totalcount),2}}%


                                                        </span>
                                                                </div>
                                                                <div class="col-sm-2 col-1 text-right">
                                                                    <!-- Dropdown -->
                                                                    <div class="dropdown d-inline-block">
                                                                        <a class="dropdown-toggle no-arrow" href="#"
                                                                           data-toggle="dropdown"
                                                                           aria-haspopup="true" aria-expanded="false">
                                                                            <i class="icon icon-vertical-more icon-fw text-light-gray"></i>
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-right">


                                                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                Add User
                                                                            </button>
                                                                            <div class="dropdown-menu" x-placement="left-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-165px, 0px, 0px);">
                                                                                <a class="dropdown-item" href="#" id="addUser-confirm-sub" data-id="{{$sub_data->serverid}}" data-usercount="100">100 user Add</a>
                                                                                <a class="dropdown-item" href="#" id="addUser-confirm-sub" data-id="{{$sub_data->serverid}}" data-usercount="300">300 user Add</a>
                                                                                <a class="dropdown-item" href="#" id="addUser-confirm-sub" data-id="{{$sub_data->serverid}}" data-usercount="500">500 user Add</a>
                                                                            </div>

                                                                            <a class="dropdown-item" href="#" id="reset-confirm-sub" data-id="{{$sub_data->serverid}}">All User Reset</a>
                                                                            <a class="dropdown-item" href="#" id="delete-confirm-sub" data-id="{{$sub_data->serverid}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /dropdown -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /grid item -->

                                                    </div>
                                                    <!-- /grid -->

                                                </div>
                                            @endforeach
                                        @else
                                        @endif
                                        <hr>
                                @endforeach

                                <!-- /widgets item -->


                                </div>
                                <!-- /widget -->

                            </div>
                            <!-- /campaigns widget -->

                        </div>
                        <!-- /card body -->

                    </div>
                    <!-- /card -->

                </div>
                <!-- /grid item -->

                <!-- Grid Item -->
                <!-- /grid item -->

            </div>
            <!-- /grid -->



        </div>
        <!-- /site content -->
    </div>
    <!-- /site content wrapper -->
@endsection