@extends('layouts.crm')
@section('content')



        <!-- /sidebar -->
        <!-- Site Content Wrapper -->
        <div class="dt-content-wrapper">

            <!-- Site Content -->
            <div class="dt-content">

                <!-- Page Header -->
                <div class="dt-page__header">
                    <h1 class="dt-page__title">Dashboard - VPN APP</h1>
                </div>
                <!-- /page header -->

                <!-- Entry Header -->
                <div class="dt-entry__header">

                    <!-- Entry Heading -->
                    <div class="dt-entry__heading">
                        <h3 class="dt-entry__title">STATISTICS &amp; Manage</h3>
                    </div>
                    <!-- /entry heading -->

                </div>
                <!-- /entry header -->

                <!-- Grid -->
                <div class="row mb-sm-8">

                    <!-- Grid Item -->
                    <div class="col-md-3 col-6">

                        <!-- Card -->
                        <div class="dt-card">

                            <!-- Card Body -->
                            <div class="dt-card__body p-xl-8 py-sm-8 py-6 px-4">

                                <span class="badge badge-secondary badge-top-right">Users</span>

                                <!-- Media -->
                                <div class="media">

                                    <i class="icon icon-users2 icon-5x mr-xl-5 mr-3 align-self-center"></i>

                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <p class="mb-1 h1">{{$usercount}}</p>
                                        <span class="d-block text-light-gray">All</span>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->

                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <!-- Grid Item -->
                    <div class="col-md-3 col-6">

                        <!-- Card -->
                        <div class="dt-card">

                            <!-- Card Body -->
                            <div class="dt-card__body p-xl-8 py-sm-8 py-6 px-4">

                                <span class="badge badge-secondary badge-top-right">Users Multi</span>

                                <!-- Media -->
                                <div class="media">

                                    <i class="icon icon-customers icon-5x mr-xl-5 mr-3 align-self-center"></i>

                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <p class="mb-1 h1">{{$multiuser}}</p>
                                        <span class="d-block text-light-gray">All</span>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->

                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <!-- Grid Item -->
                    <div class="col-md-6 col-12">

                        <!-- Card -->
                        <div class="dt-card">

                            <!-- Card Body -->
                            <div class="dt-card__body p-xl-8 py-sm-8 py-6 px-4">

                                <span class="badge badge-secondary badge-top-right">Servers</span>

                                <!-- Media -->
                                <div class="media">

                                    <img src="https://img.icons8.com/color/45/000000/server.png" class="icon-5x mr-xl-5 mr-1 mr-sm-3 align-self-center">
                                    <!-- Media Body -->
                                    <div class="media-body">
                                        <ul class="invoice-list">
                                            <li class="invoice-list__item">
                                                <span class="invoice-list__number">{{count($servers)}}</span> <span
                                                        class="invoice-list__label">All</span>
                                            </li>
                                            <li class="invoice-list__item">
                                                <span class="invoice-list__number">{{count($servers->where('paid',1))}}</span> <span
                                                        class="dot-shape bg-success"></span>
                                                <span class="invoice-list__label">Paid</span>
                                            </li>
                                            <li class="invoice-list__item">
                                                <span class="invoice-list__number">{{count($servers->where('paid',0))}}</span> <span
                                                        class="dot-shape bg-info"></span>
                                                <span class="invoice-list__label">Free</span>
                                            </li>
                                            <li class="invoice-list__item">
                                                <span class="invoice-list__number">{{count($servers->where('ust_server_id', '!=' ,null))}}</span> <span
                                                        class="dot-shape bg-warning"></span>
                                                <span class="invoice-list__label">Sub Server</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /media body -->

                                </div>
                                <!-- /media -->

                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <!-- Grid Item -->
                    <div class="col-md-6">

                        <!-- Card -->
                        <div class="dt-card dt-card__full-height">

                            <!-- Card Header -->
                            <div class="dt-card__header">

                                <!-- Card Heading -->
                                <div class="dt-card__heading">
                                    <h3 class="dt-card__title">Free Server - New User Daily </h3>
                                </div>
                                <!-- /card heading -->

                                <!-- Card Tools -->
                                <div class="dt-card__tools">
                                    <a href="/admin/serverview" class="dt-card__more">See All</a>
                                </div>
                                <!-- /card tools -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                                <!-- Grid -->
                                <div class="row">

                                    <!-- Grid Item -->
                                    <div class="col-xl-4 col-md-12 col-sm-4">

                                        <!-- Chart -->
                                        <canvas class="mx-auto mb-5 mb-sm-0 mb-md-5 mb-xl-0"
                                                id="estimation-doughnut1" data-fill="{{$freeCountry['sumUsers']}}"
                                                height="110" width="110"></canvas>
                                        <!-- /chart -->

                                    </div>
                                    <!-- /grid item -->

                                    <!-- Grid Item -->
                                    <div class="col-xl-8 col-md-12 col-sm-8">

                                        <!-- List -->
                                        <ul class="dt-list dt-list-col-6">
                                            @if(isset($freeCountry['labels']))
                                                @foreach($freeCountry['labels'] as $k => $v)
                                                    <li class="dt-list__item">
                                                        <span class="dot-shape dot-shape-lg mr-2" style="background-color: {{$freeCountry['datasets'][0]['backgroundColor'][$k]}}"></span>
                                                        <span class="d-inline-block">{{$freeCountry['datasets'][0]['data'][$k]}} {{$v}}</span>
                                                    </li>
                                                @endforeach
                                            @else
                                            @endif
                                        </ul>
                                        <!-- /list -->

                                    </div>
                                    <!-- /grid item -->

                                </div>
                                <!-- /grid -->

                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <!-- Grid Item -->
                    <div class="col-md-6">

                        <!-- Card -->
                        <div class="dt-card dt-card__full-height">

                            <!-- Card Header -->
                            <div class="dt-card__header">

                                <!-- Card Heading -->
                                <div class="dt-card__heading">
                                    <h3 class="dt-card__title">Paid Server - New User Daily </h3>
                                </div>
                                <!-- /card heading -->

                                <!-- Card Tools -->
                                <div class="dt-card__tools">
                                    <a href="/admin/serverview" class="dt-card__more">See All</a>
                                </div>
                                <!-- /card tools -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                                <!-- Grid -->
                                <div class="row">

                                    <!-- Grid Item -->
                                    <div class="col-xl-4 col-md-12 col-sm-4">

                                        <!-- Chart -->
                                        <canvas class="mx-auto mb-5 mb-sm-0 mb-md-5 mb-xl-0" id="proposal-doughnut1"
                                                data-fill="{{$paidCountry['sumUsers']}}"
                                                height="110" width="110"></canvas>
                                        <!-- /chart -->

                                    </div>
                                    <!-- /grid item -->

                                    <!-- Grid Item -->
                                    <div class="col-xl-8 col-md-12 col-sm-8">

                                        <!-- List -->
                                        <ul class="dt-list dt-list-col-6">
                                            @if(isset($paidCountry['labels']))
                                            @foreach($paidCountry['labels'] as $k => $v)
                                                <li class="dt-list__item">
                                                    <span class="dot-shape dot-shape-lg mr-2" style="background-color: {{$paidCountry['datasets'][0]['backgroundColor'][$k]}}"></span>
                                                    <span class="d-inline-block">{{$paidCountry['datasets'][0]['data'][$k]}} {{$v}}</span>
                                                </li>
                                            @endforeach
                                                @else
                                            @endif
                                        </ul>
                                        <!-- /list -->

                                    </div>
                                    <!-- /grid item -->

                                </div>
                                <!-- /grid -->

                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <!-- Grid Item -->


                </div>
                <!-- /grid -->



                <!-- Entry Header -->
                <div class="dt-entry__header">

                    <!-- Entry Heading -->
                    <div class="dt-entry__heading">
                        <h3 class="dt-entry__title">Server &amp; Leads</h3>
                    </div>
                    <!-- /entry heading -->

                </div>
                <!-- /entry header -->

                <!-- Grid -->
                <div class="row mb-sm-8">

                    <!-- Grid Item -->
                    <div class="col-12">

                        <!-- Card -->
                        <div class="dt-card">

                            <!-- Card Header -->
                            <div class="dt-card__header">

                                <!-- Card Heading -->
                                <div class="dt-card__heading">
                                    <h3 class="dt-card__title">this year leads</h3>
                                </div>
                                <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">


                                <!-- Grid -->
                                <div class="row">

                                    <!-- Grid Item -->
                                    <div class="col-xl-4 col-md-6 mb-8 mb-xl-0">

                                        <div class="row no-gutters mb-5 border-bottom">
                                            <div class="col-6" id="canvas_chart">
                                                <!-- Chart -->
                                                <canvas id="chart-leads1" width="200" height="200"
                                                        class="ml-n5 mt-n4"></canvas>
                                                <!-- /chart -->
                                            </div>

                                            <div class="col-6 d-flex">
                                                <div class="d-flex flex-column justify-content-end align-items-end flex-fill">
                                                    <a href="javascript:void(0)" id="toggle-view"
                                                       class="dt-avatar bg-primary shadow-lg mb-10">
                                                        <i class="icon icon-company text-white"></i> </a>

                                                    <div class="text-dark display-3 font-weight-500 mb-5"><span
                                                                id="lead-number1">{{$yearTotalFree}}</span>
                                                        <span class="h3">Lead</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /grid item -->

                                    <!-- Grid Item -->
                                    <div class="col-xl-4 col-md-6 px-xl-10 pl-md-10 mb-8 mb-md-0">
                                        <div class="h4 mb-2">Top Countries</div>
                                        <p class="mb-sm-6 text-light-gray">List of countries with the best figure
                                            lead generation.</p>

                                        <ul class="dt-list flex-column">
                                            @foreach($capHighs as $capHigh)
                                            <li class="dt-list__item">
                                                <div class="d-flex align-items-center">
                                                    <span class="text-dark mr-1">{{$capHigh->country}}
                                                    @if($capHigh->type=='free')
                                                            <span class="badge badge-primary mb-1 mr-1">Free</span>
                                                    @else
                                                            <span class="badge badge-success mb-1 mr-1">Paid</span>
                                                    @endif

                                                    </span>
                                                    <span class="ml-auto">{{$capHigh->status_sum}}</span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /grid item -->

                                    <!-- Grid Item -->
                                    <div class="col-xl-4">
                                        <div class="h4 mb-2">Monthly Leads</div>
                                        <p class="mb-sm-6 text-light-gray">Bar chart based on monthly lead
                                            generation.</p>

                                        <!-- Chart -->
                                        <canvas id="monthly-leads-bar1"></canvas>
                                        <!-- /chart -->

                                    </div>
                                    <!-- /grid item -->

                                </div>
                                <!-- /grid -->


                            </div>
                            <!-- /card body -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                    <div class="col-12">

                        <!-- Card -->
                        <div class="dt-card">

                            <!-- Grid -->
                            <div class="row no-gutters">

                                <!-- Grid Item -->
                                <div class="col-md-6">
                                    <!-- Card Header -->
                                    <div class="dt-card__header mb-3">

                                        <!-- Card Heading -->
                                        <div class="dt-card__heading">
                                            <h3 class="dt-card__title">Live User</h3>
                                        </div>
                                        <!-- /card heading -->

                                    </div>
                                    <!-- /card header -->

                                    <!-- Card Body -->
                                    <div class="dt-card__body pb-0 pb-sm-8">
                                        <div class="embed-responsive embed-responsive-21by9">
                                            <div id="overview-map" class="embed-responsive-item"></div>
                                        </div>
                                    </div>
                                    <!-- /card body -->
                                </div>
                                <!-- /grid item -->

                                <!-- Grid Item -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="dt-card__body pl-md-0 pr-sm-0">
                                        <ul class="dt-indicator mt-xl-6">
                                            <li class="dt-indicator-item">
                                                <p class="dt-indicator-title">Europe</p>
                                                <div class="dt-indicator-item__info" data-fill="55" data-max="100"
                                                     data-percent="true">
                                                    <div class="dt-indicator-item__fill bg-info"></div>
                                                    <span class="dt-indicator-item__count ml-3">0</span>
                                                </div>
                                            </li>
                                            <li class="dt-indicator-item">
                                                <p class="dt-indicator-title">North America</p>
                                                <div class="dt-indicator-item__info" data-fill="40" data-max="100"
                                                     data-percent="true">
                                                    <div class="dt-indicator-item__fill bg-success"></div>
                                                    <span class="dt-indicator-item__count ml-3">0</span>
                                                </div>
                                            </li>
                                            <li class="dt-indicator-item">
                                                <p class="dt-indicator-title">Japan, South Koria</p>
                                                <div class="dt-indicator-item__info" data-fill="20" data-max="100"
                                                     data-percent="true">
                                                    <div class="dt-indicator-item__fill bg-yellow"></div>
                                                    <span class="dt-indicator-item__count ml-3">0</span>
                                                </div>
                                            </li>
                                            <li class="dt-indicator-item">
                                                <p class="dt-indicator-title">Other</p>
                                                <div class="dt-indicator-item__info" data-fill="10" data-max="100"
                                                     data-percent="true">
                                                    <div class="dt-indicator-item__fill bg-light"></div>
                                                    <span class="dt-indicator-item__count ml-3">0</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /grid item -->

                                <!-- Grid Item -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="dt-zone-stats">
                                        <div class="dt-zone-stats__content">
                                            <div class="h1 display-4 font-weight-600 mb-1">$25,890</div>
                                            <span>Total Revenue</span>
                                        </div>
                                        <div class="dt-zone-stats__content">

                                            <div class="row w-100">
                                                <div class="col-6 text-center border-right">
                                                    <div class="h1 mb-1 font-weight-500">23</div>
                                                    <span>Clients</span>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <div class="h1 mb-1 font-weight-500">07</div>
                                                    <span>Countries</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /grid item -->

                            </div>
                            <!-- /grid -->

                        </div>
                        <!-- /card -->

                    </div>
                    <!-- /grid item -->

                <!-- /grid -->


            </div>
            <!-- /site content -->

@endsection

@section('customjs')
     <script>


         $(window).on("load", function () {


         if ($('#estimation-doughnut1').length) {
             var free_data =  <?php echo json_encode($freeCountry ); ?>;
             new Chart(document.getElementById('estimation-doughnut1'), {
                 type: 'doughnut',
                 data: free_data,
                 options: {
                     cutoutPercentage: 90,
                     responsive: false,
                     legend: {
                         display: false
                     }
                 }
             });
         }

         if ($('#proposal-doughnut1').length) {
                 var proposal_data = <?php echo json_encode($paidCountry ); ?>;
                 new Chart(document.getElementById('proposal-doughnut1'), {
                     type: 'doughnut',
                     data: proposal_data,
                     options: {
                         cutoutPercentage: 80,
                         responsive: false,
                         legend: {
                             display: false
                         }
                     }
                 });
             }

             if ($('#monthly-leads-bar1').length) {
                 var monthly_leads_data = {
                     labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                     datasets: [<?php echo json_encode($userPerMonth); ?>]
                 };

                 new Chart(document.getElementById('monthly-leads-bar1'), {
                     type: 'bar',
                     data: monthly_leads_data,
                     options: {
                         responsive: true,
                         legend: {
                             display: false
                         },
                         layout: {
                             padding: {
                                 top: 0,
                                 left: 0,
                                 right: 0,
                                 bottom: 0
                             }
                         },
                         tooltips: {
                             callbacks: {
                                 title: function (tooltipItem, data) {
                                     var tindex = tooltipItem[0].index;
                                     return months[tindex];
                                 }
                             }
                         },
                         scales: {
                             xAxes: [{
                                 gridLines: {
                                     display: false
                                 },
                                 display: true,
                                 categoryPercentage: 1.0,
                                 barPercentage: 0.6
                             }],
                             yAxes: [{
                                 display: false
                             }]
                         }
                     }
                 });
             }


             if ($('#lead-number1').length) {
                 var mobileData = <?php echo json_encode($yearArrayFree); ?>;
                 var desktopData = <?php echo json_encode($yearArrayPaid); ?>;
                 var  currentScreen = 'mobile';
                 var $leadNumber = $('#lead-number1');

                 <?php if (count($yearArrayFree) > 0)   { ?>
                 var config = {
                     type: 'polarArea',
                     data: {
                         datasets: [{
                             data: mobileData,
                             backgroundColor: <?php echo json_encode($yearArrayFreeColor); ?>,
                             label: 'My dataset' // for legend
                         }],
                         labels: <?php echo json_encode($yearArrayFreeName); ?>
                     },
                     options: {
                         responsive: false,
                         legend: {
                             display: false
                         },
                         layout: {
                             padding: {
                                 top: 0,
                                 left: 0,
                                 right: 0,
                                 bottom: 0
                             }
                         },
                         scale: {
                             display: false
                         }
                     }
                 };
                <?php } ?>
                 var config1 = {
                     type: 'polarArea',
                     data: {
                         datasets: [{
                             data: desktopData,
                             backgroundColor: <?php echo json_encode($yearArrayPaidColor); ?>,
                             label: 'My dataset' // for legend
                         }],
                         labels: <?php echo json_encode($yearArrayPaidName); ?>
                     },
                     options: {
                         responsive: false,
                         legend: {
                             display: false
                         },
                         layout: {
                             padding: {
                                 top: 0,
                                 left: 0,
                                 right: 0,
                                 bottom: 0
                             }
                         },
                         scale: {
                             display: false
                         }
                     }
                 };


                 var randomScalingFactor = function () {
                     return Math.round(Math.random() * 100);
                 };

                var leadPolarArea = new Chart(document.getElementById('chart-leads1'), config);

                 $('#toggle-view').on('click', function () {
                     $(this).find('i').toggleClass('icon-company icon-revenue-new');
                     leadPolarArea.destroy();
                     console.log(leadPolarArea);
                        if(currentScreen == 'mobile'){
                             leadPolarArea = new Chart(document.getElementById('chart-leads1'), config1);
                        }else{
                            leadPolarArea = new Chart(document.getElementById('chart-leads1'), config);
                        }
                     config.data.datasets.forEach(function (piece, i) {
                         if (currentScreen == 'mobile') {
                             currentScreen = 'desktop';
                             $leadNumber.text('<?php echo json_encode($yearTotalPaid); ?>');
                             leadPolarArea.update()

                         } else {
                             currentScreen = 'mobile';
                             $leadNumber.text('<?php echo json_encode($yearTotalFree); ?>');
                             leadPolarArea.update()
                         }
                     });


                 });
             }
         });
     </script>
@endsection
