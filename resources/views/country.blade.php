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
                    <h3 class="dt-entry__title">Digital Ocean Server &amp; Creeate</h3>
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
                            <h3 class="dt-card__title">Digital Ocean Server Create</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->
                        <form action="/vpn/admin/country/post" method="post" id="myForm" class="myForm">
                            {!! csrf_field()  !!}
                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="email-1">Country Name</label>
                                <input type="text" class="form-control" id="email-1" name="country" aria-describedby="emailHelp1" placeholder="Enter Country name">
                                <!--  <small id="emailHelp1" class="form-text">Note: We will never share your
                                     email address with anyone.
                                 </small>-->
                             </div>

                            <div class="form-group">
                                <label for="email-1">Region Name</label>
                                <select class="form-control" name="regions" id="simple-select">
                                    <option>Select Region</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->slug}}">{{$region->name}} - {{$region->slug}} -@if($region->available == 1) Available @else not available!! No Select!!  @endif</option>
                                    @endforeach
                                </select>
                                <small id="emailHelp1" class="form-text">Note: <a href="#">Digital Ocean Availability Region List.</a> Example: fra1,lon1,tor1,NYC1 .. vs
                                 </small>
                            </div>
                             <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="password-1">City Name</label>
                                <input type="text" class="form-control" id="password-1" name="city" placeholder="Enter City">
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="password-1">Country Code</label>
                                <input type="text" class="form-control" id="password-1" name="code" placeholder="Country Code">
                            </div>
                            <!-- /form group -->


                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="serverpaid" id="inlineRadio1" value="paid">
                                    <label class="form-check-label" for="inlineRadio1">Server Paid</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="serverpaid" id="inlineRadio1" value="free">
                                    <label class="form-check-label" for="inlineRadio1">Server Free</label>
                                </div>
                            </div>




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

            <div class="col-xl-6">

                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Digital Ocean Token</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->
                        <form action="/vpn/admin/country/token" method="post" id="myForm" class="myForm">
                        {!! csrf_field()  !!}
                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="email-1">Token Digital Ocean</label>
                                <textarea class="form-control" name="token_digital">{{$digital->token}}</textarea>
                                <input type="submit" value="Update" class="form-control">
                            </div>



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