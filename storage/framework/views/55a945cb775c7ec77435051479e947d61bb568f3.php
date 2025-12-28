<?php $__env->startSection('title', 'Website Header - '); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-body">
        <div class="container">
            <div class="main-content default-manu">
                <?php echo $__env->make('backend.pages.website_setting.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- Tab Manu End  -->
                <!-- Tab Content Start -->
                <div class="tab-content default-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="header" Area-labelledby="header-tab">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="check-toggle-btn input-group">
                                    <label for="show-lang-btn"><?php echo e(__('Show Language Switcher?')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input show_language" <?php if($header->show_language): ?> checked <?php endif; ?> type="checkbox">
                                    </div>
                                </div>
                                <div class="check-toggle-btn input-group">
                                    <label for="show-cur-btn"><?php echo e(__('Show Currency Switcher?')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input show_currency" <?php if($header->show_currency): ?> checked <?php endif; ?> type="checkbox">
                                    </div>
                                </div>
                                <div class="check-toggle-btn">
                                    <label for="stikcy-head-btn"><?php echo e(__('Enable Sticky Header?')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input enable_stikcy_header" <?php if($header->enable_sticky_header): ?> checked <?php endif; ?> type="checkbox">
                                    </div>

                                </div>
                                <div class="check-toggle-btn">
                                    <label for="tracking-o-btn"><?php echo e(__('Tracking Order')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input enable_tracking_order" <?php if($header->enable_tracking_order): ?> checked <?php endif; ?> type="checkbox">
                                    </div>

                                </div>
                                <div class="check-toggle-btn">
                                    <label for="help-btn"><?php echo e(__('Help')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input show_help" <?php if($header->show_help): ?> checked <?php endif; ?> type="checkbox">
                                    </div>

                                </div>
                                <div class="check-toggle-btn">
                                    <label for="cart-btn"><?php echo e(__('Show Bangla Cart Button')); ?></label>
                                    <div class="form-switch">
                                        <input class="form-check-input show_cart_btn" <?php if($btn_status->status == 1): ?> checked <?php endif; ?> type="checkbox">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Content End  -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(function() {

            "use strict";
            $(document).on('click', '#header .show_language', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'status': status,
                        'field': 'show_language'
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });
            $(document).on('click', '#header .show_currency', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'status': status,
                        'field': 'show_currency'
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });
            $(document).on('click', '#header .enable_stikcy_header', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'status': status,
                        'field': 'enable_sticky_header'
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });
            $(document).on('click', '#header .enable_tracking_order', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'status': status,
                        'field': 'enable_tracking_order'
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });
            $(document).on('click', '#header .show_help', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'status': status,
                        'field': 'show_help'
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });

            $(document).on('click', '#header .show_cart_btn', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/website_setting/changeStatus',
                    data: {
                        'btn_status': status,
                    },
                    success: function(data) {
                        notification('success', data.message);
                    }
                });
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/china_hub/resources/views/backend/pages/website_setting/header.blade.php ENDPATH**/ ?>