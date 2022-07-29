<?php $__env->startSection('content'); ?>

    <div class="dt-content-wrapper">

        <!-- Site Content -->
        <div class="dt-content">

            <!-- Page Header -->
            <div class="dt-page__header">
                <h1 class="dt-page__title">Settings</h1>
            </div>
            <!-- /page header -->

            <!-- Grid -->
            <div class="row dt-masonry" style="position: relative; height: 1991.64px;">


                <!-- Grid Item -->
                <div class="col-md-8 dt-masonry__item" style="position: absolute; left: 0%; top: 360px;">

                    <!-- Card -->
                    <div class="dt-card">

                        <!-- Card Header -->
                        <div class="dt-card__header">

                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                                <h3 class="dt-card__title">Settings Page</h3>
                            </div>
                            <!-- /card heading -->

                        </div>
                        <!-- /card header -->

                        <!-- Card Body -->
                        <div class="dt-card__body tabs-container">

                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#cronjob" role="tab" aria-controls="cronjob" aria-selected="true">Cronjob</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#subserver" role="tab" aria-controls="subserver" aria-selected="true">Sub Server</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#digital" role="tab" aria-controls="digital" aria-selected="true">DigitalOcaen Token</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#bundle" role="tab" aria-controls="bundle" aria-selected="true">Bundle ID</a>
                                </li>
                            </ul>
                            <!-- /tab navigation -->
                            <style>
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 60px;
                                    height: 34px;
                                    margin-top: 5px;
                                }

                                .switch input {
                                    opacity: 0;
                                    width: 0;
                                    height: 0;
                                }

                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #ccc;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 22px;
                                    width: 22px;
                                    left: 4px;
                                    bottom: 1px;
                                    background-color: white;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                }

                                input:checked + .slider {
                                    background-color: #2196F3;
                                }

                                input:focus + .slider {
                                    box-shadow: 0 0 1px #2196F3;
                                }

                                input:checked + .slider:before {
                                    -webkit-transform: translateX(26px);
                                    -ms-transform: translateX(26px);
                                    transform: translateX(26px);
                                }

                                /* Rounded sliders */
                                .slider.round {
                                    border-radius: 34px;
                                }

                                .slider.round:before {
                                    border-radius: 50%;
                                }
                            </style>
                            <!-- Tab Content -->
                            <div class="tab-content">

                                <!-- Tab Pane -->
                                <div id="cronjob" class="tab-pane active">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>Auto Server Add User</strong>
                                            If active, it automatically increases the server capacity after the limit you set.
                                        </p>
                                        <form method="post" action="/vpn/admin/settings/post/cron" id="myForm" class="myForm">
                                            <?php echo csrf_field(); ?>


                                            <div class="form-group">
                                                <label class="switch">
                                                    <input type="checkbox" id="switchCron" name="switchCron" <?php if($setting->cronjob == 1): ?> checked <?php else: ?> <?php endif; ?>>
                                                    <span class="slider round"></span>
                                                </label>

                                            </div>
                                            <div class="form-group">
                                                <label for="password-1">Cronjob Capacity</label>
                                                <input type="text" class="form-control" id="password-1" name="total" value="<?php echo e($setting->total); ?>">
                                            </div>
                                            <input type="hidden" name="islem" value="cron">
                                            <div class="form-group mb-0">
                                                <input type="submit" id="submitbutton" class="btn btn-primary text-uppercase" value="Edit Cronjob">
                                                <a href="/vpn/admin/setting/cron" style="float: right;color: white;" class="btn btn-warning text-uppercase" >Cron Reset</a>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <!-- /tab pane-->

                                <!-- Tab Pane -->
                                <div id="subserver" class="tab-pane">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>Sub Server Create</strong> If active, it automatically gives user information from the backup server after the limit you set.
                                        </p>

                                        <form method="POST" action="/vpn/admin/settings/post/sub" id="myForm" class="myForm">
                                            <?php echo csrf_field(); ?>


                                            <div class="form-group">
                                                <label class="switch">
                                                    <input type="checkbox" id="switchSub" name="switchSub" <?php if($setting->alternative_server == 1): ?> checked <?php else: ?> <?php endif; ?>>
                                                    <span class="slider round"></span>
                                                </label>

                                            </div>
                                            <div class="form-group">
                                                <label for="password-1">Cronjob Capacity</label>
                                                <input type="text" class="form-control" id="password-1" name="server_cap" value="<?php echo e($setting->server_cap); ?>">
                                            </div>
                                            <input type="hidden" name="islem" value="sub">
                                            <div class="form-group mb-0">
                                                <button type="submit" id="submitbutton" class="btn btn-primary text-uppercase">Edit SubServer</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                                <!-- /tab pane-->
                                <!-- Tab Pane -->
                                <div id="digital" class="tab-pane">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>Digitalocean Token</strong>
                                        </p>

                                        <form method="POST" action="/vpn/admin/country/token" id="myForm" class="myForm">
                                            <?php echo csrf_field(); ?>

                                            <div class="form-group">
                                                <label for="password-1">Token Digital</label>
                                                <input type="text" class="form-control" id="password-1" name="token_digital" value="<?php echo e($token->token); ?>">
                                            </div>
                                            <div class="form-group mb-0">
                                                <button type="submit" id="submitbutton" class="btn btn-primary text-uppercase">Edit Token</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <!-- /tab pane-->

                                <div id="bundle" class="tab-pane">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <strong>BUNDLE ID Please Multi Vpn Apps "," using Example:com.net.vpn,com.vpn.halper</strong>
                                        </p>

                                        <form method="POST" action="/vpn/admin/settings/post/bundle" id="myForm" class="myForm">
                                            <?php echo csrf_field(); ?>

                                            <div class="form-group">
                                                <label for="password-1">BUNDLE ID</label>
                                                <input type="text" class="form-control" id="password-1" name="bundleid" value="<?php echo e($setting->bundleid); ?>">
                                            </div>
                                            <div class="form-group mb-0">
                                                <button type="submit" id="submitbutton"  class="btn btn-primary text-uppercase">Edit Bundle ID</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <!-- /tab pane-->
                            </div>
                            <!-- /tab content -->

                        </div>
                        <!-- /card body -->

                    </div>
                    <!-- /card -->

                </div>
                <!-- /grid item -->



            </div>
            <!-- /grid -->

        </div>
        <!-- /site content -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>