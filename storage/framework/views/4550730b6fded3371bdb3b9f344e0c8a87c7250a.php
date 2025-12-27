<?php $__env->startSection('title','Announcements - '); ?>
<?php $__env->startPush('css'); ?>
    <?php echo $__env->make('backend.includes.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-body">
        <div class="container">
            <div class="main-content default-manu">
            <?php echo $__env->make('backend.pages.website_setting.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Tab Manu End  -->
                <!-- Tab Content Start -->
                <div class="tab-content default-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="pages" Area-labelledby="pages-tab">
                        <div class="row">
                            <div class="col">
                                <div class="float-md-end">
                                    <a href="<?php echo e(route('backend.announcements.create')); ?>">
                                        <button class="btn btn-warning pull-right"> <?php echo e(__('Add Announcements')); ?></button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="content-table">
                            <table id="mDataTable" class="table p-table">
                                <thead>
                                <tr>
                                    <th scope="col"><?php echo e(__('Id')); ?></th>
                                    <th scope="col"><?php echo e(__('title')); ?></th>
                                    <th scope="col"><?php echo e(__('Thumbnail')); ?></th>
                                    <th scope="col"><?php echo e(__('Description')); ?></th>
                                    <th scope="col"><?php echo e(__('Sale Price')); ?></th>
                                    <th scope="col"><?php echo e(__('Old Price')); ?></th>
                                    <th scope="col"><?php echo e(__('Expire At')); ?></th>
                                    <th scope="col"><?php echo e(__('Status')); ?></th>
                                    <th scope="col"><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- Tab Content End  -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo $__env->make('backend.includes.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function(){
            "use strict";
            // DataTable
            var table = $('#mDataTable');
            table.DataTable({
                ajax: "<?php echo e(route('backend.announcements.list')); ?>",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'thumbnail' },
                    { data: 'description' },
                    { data: 'sale_price' },
                    { data: 'old_price' },
                    { data: 'expire_at' },
                    { data: 'is_active' },
                    { data: 'action',searchable:false,sortable:false },
                ]
            });
            $(document).on('click', '#mDataTable .status', function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: public_path + '/admin/announcements/changeStatus',
                    data: {'status': status, 'id': id, 'field': 'is_active'},
                    success: function (data) {
                        notification('success', data.message);
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u849325218/domains/chinabdhub.com/public_html/resources/views/backend/pages/website_setting/announcements/index.blade.php ENDPATH**/ ?>