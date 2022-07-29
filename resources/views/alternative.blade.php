@extends('layouts.crm')
@section('content')

    <div class="dt-content-wrapper">



        <!-- Site Content -->
        <div class="dt-content">

            <!-- Page Header -->
            <div class="dt-page__header">
                <h1 class="dt-page__title">Server Managent</h1>
            </div>
            <!-- /page header -->

            <!-- Entry Header -->
            <div class="dt-entry__header">

                <!-- Entry Heading -->
                <div class="dt-entry__heading">
                    <h3 class="dt-entry__title">Sub &amp; Creeate</h3>
                </div>
                <!-- /entry heading -->

            </div>
            <!-- /entry header -->


            <div class="col-xl-6">

                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Sub Server Create</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->
                        <form action="/vpn/admin/alternative/manuel/post" method="post" id="myForm" class="myForm">
                        {!! csrf_field()  !!}
                        <!-- Form Group -->
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="company" id="inlineRadio1" value="Google">
                                    <label class="form-check-label" for="inlineRadio1">Google</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="company" id="inlineRadio1" value="Vultr">
                                    <label class="form-check-label" for="inlineRadio1">Vultr</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="company" id="inlineRadio1" value="Amazon">
                                    <label class="form-check-label" for="inlineRadio1">Amazon</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="company" id="inlineRadio1" value="Digitalocean" checked>
                                    <label class="form-check-label" for="inlineRadio1">DigitalOcean</label>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="email-1">Main Server</label>
                                <select class="form-control" name="mainserver" id="simple-select">
                                    <option>Select Main Server</option>
                                    @foreach($servers as $server)
                                        <option value="{{$server->serverid}}">{{$server->country}} - {{$server->city}} - {{$server->type}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="ip_input">
                                <label for="password-1">IP</label>
                                <input type="text" class="form-control" id="password-1" name="ip" placeholder="Enter IP">
                            </div>

                            <div class="form-group" id="ssh_input">
                                <label for="password-1">SSH Username</label>
                                <input type="text" class="form-control" id="password-1" name="sshuser" placeholder="Enter Username">
                                <small id="emailHelp1" class="form-text">Note:Digital Ocean and VULTR Default "root", Amazon Cloud "ubuntu"  and Google Cloud Document Look Please Username</small>

                            </div>


                            <!--
                                                        <div class="form-group" id="manuel_region">
                                                            <label for="email-1">Region Name</label>
                                                            <input type="text" class="form-control" id="email-1" name="regions" aria-describedby="emailHelp1" placeholder="Enter Region name">

                                                            <small id="emailHelp1" class="form-text">Note: <a href="#"></a> Example: fra1,lon1,tor1,NYC1 .. vs
                                                            </small>
                                                        </div>
                                                         /form group

                            <div class="form-group" id="digital_region">
                                <label for="email-1">Region Name</label>
                                <select class="form-control" name="regions" id="simple-select">
                                    <option>Select Region</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->slug}}">{{$region->name}} - {{$region->slug}} -@if($region->available == 1) Available @else not available!! No Select!!  @endif</option>
                                    @endforeach
                                </select>
                                <small id="emailHelp1" class="form-text">Note: <a href="#">Digital Ocean Availability Region List.</a> Example: fra1,lon1,tor1,NYC1 .. vs
                                </small>
                            </div>-->

                            <a href="javascript:void(0)" class="badge badge-danger mb-1 mr-1" id="pageCron">Cronjob Working</a>


                            <!-- Form Group -->
                            <div class="form-group mb-0">
                                <button type="submit" id="submitbutton" class="btn btn-primary text-uppercase">Create Server</button>
                            </div>
                            <!-- /form group -->
                            <div class="loader" id="loader_post" style="display: none;"></div>


                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>

        </div>
        <!-- /site content -->

    </div>
    <!-- /site content wrapper -->

@endsection