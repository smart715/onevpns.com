<?php $__env->startSection('content'); ?>

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
                    <h3 class="dt-entry__title">Manuel Server &amp; Creeate</h3>
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
                            <h3 class="dt-card__title">Manuel Server Create</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->
                        <form action="/vpn/admin/servermanuel/post" method="post" id="myForm" class="myForm">
                        <?php echo csrf_field(); ?>

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
                            </div>

                            <div class="form-group">
                                <label for="password-1">IP</label>
                                <input type="text" class="form-control" id="password-1" name="ip" placeholder="Enter IP">
                            </div>

                            <div class="form-group">
                                <label for="password-1">SSH Username</label>
                                <input type="text" class="form-control" id="password-1" name="sshuser" placeholder="Enter Username">
                                <small id="emailHelp1" class="form-text">Note:Digital Ocean and VULTR Default "root", Amazon Cloud "ubuntu"  and Google Cloud Document Look Please Username</small>

                            </div>

                            <div class="form-group">
                                <label for="email-1">Country Name</label>
                                <input type="text" class="form-control" id="email-1" name="country" aria-describedby="emailHelp1" placeholder="Enter Country name">
                                <!--  <small id="emailHelp1" class="form-text">Note: We will never share your
                                     email address with anyone.
                                 </small>-->
                            </div>

                            <div class="form-group">
                                <label for="email-1">Region Name</label>
                                <input type="text" class="form-control" id="email-1" name="regions" aria-describedby="emailHelp1" placeholder="Enter Region name">

                                <small id="emailHelp1" class="form-text">Note: <a href="#"></a> Example: fra1,lon1,tor1,NYC1 .. vs
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
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">SSH KEY </h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">
                        <!-- Form -->

                        <div class="form-group">
                            <textarea class="form-control" rows="8" cols="100">ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDY5bJI8UxZC6lwZaQU3Z9DZEU5/KPiEouguNizdM+5fsPa3bZPlGDUcRzoO0GCVExe4TN/tWMs7VCqaads1EfA4pjs9IdY7SLLKMn/KYD4N8ZZEcxy6Fv1dwVZoYToWWbUhtwixkLrAbuIuy1U1QB9vUpEvRrjncwtWQx7rpwlxf6gyKBVKRDy5RS2rutG4yXCi+FnrZIAKEhAeyfgAWNoPIf5cyjKRfXAkQ8vTRj4c+rKjDXZGs+BO/fDAyADQVZSbosHXb8hRrDKVGvvpXDkZCcgGCY49ve+cF6ns2qzgJkm2RNX1Ikchh2UsG/NdweCeQarzWOT3GTqhGXaE4dH root@infallible-vaughan.143-244-169-107.plesk.page</textarea>
                        </div>

                    </div>
                    <!-- /card body -->

                </div>

            </div>

        </div>
        <!-- /site content -->

    <!-- /site content wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.crm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>