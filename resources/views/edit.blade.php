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
                    <h3 class="dt-entry__title"> Server Edit</h3>
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
                            <h3 class="dt-card__title"> Server Edit</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->
                        <form action="/vpn/admin/serverEdit/post" method="post" id="myForm" class="myForm">
                        {!! csrf_field()  !!}
                        <!-- Form Group -->

                            <div class="form-group">
                                <label for="password-1">İp</label>
                                <input type="text" class="form-control" id="password-1" name="ip" value="{{$ip}}">
                            </div>

                            <div class="form-group">
                                <label for="password-1">Country</label>
                                <input type="text" class="form-control" id="password-1" name="country" value="{{$country->country}}">
                            </div>

                            <div class="form-group">
                                <label for="password-1">City</label>
                                <input type="text" class="form-control" id="password-1" name="city" value="{{$country->city}}">
                            </div>

                            <div class="form-group">
                                <label for="password-1">Country Code</label>
                                <input type="text" class="form-control" id="password-1" name="country_code" value="{{$country->country_code}}">
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" id="submitbutton" class="btn btn-primary text-uppercase">Edit Server</button>
                            </div>
                            <input type="hidden" name="countid" value="{{$country->id}}">
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

    <!-- /site content wrapper -->

@endsection