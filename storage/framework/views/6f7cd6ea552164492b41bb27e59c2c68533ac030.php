<?php $__env->startSection('title', 'Contact Infos List - '); ?>
<?php $__env->startSection('content'); ?>
<div class="content-body">
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="brand" role="tabpanel" Area-labelledby="brand-tab">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col">
                        <h5 class="py-2"><?php echo app('translator')->get('Contact Infos List'); ?></h5>
                    </div>
                    <div class="col-md-4 text-end align-self-center mt-2">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#contact-create-modal"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('Add new'); ?></a>
                    </div>
                </div>
                <div class="responsibe-table">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('#'); ?></th>
                                <th><?php echo app('translator')->get('Title'); ?></th>
                                <th><?php echo app('translator')->get('Number'); ?></th>
                                <th><?php echo app('translator')->get('Created At'); ?></th>
                                <th><?php echo app('translator')->get('Updated At'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->index+1); ?></td>
                                <td><?php echo e($info->value['title'] ?? ''); ?></td>
                                <td><?php echo e($info->value['number'] ?? ''); ?></td>
                                <td><?php echo e(date('d-m-Y H:i A', strtotime($info->created_at))); ?></td>
                                <td><?php echo e(date('d-m-Y H:i A', strtotime($info->updated_at))); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" data-url="<?php echo e(route('backend.contact-infos.update', $info->id)); ?>" data-title="<?php echo e($info->value['title'] ?? ''); ?>" data-number="<?php echo e($info->value['number'] ?? ''); ?>" class="btn text-warning btn-sm edit-commission"><i class="fas fa-edit"></i></a>
                                        <a class="action-confirm btn text-danger btn-sm" data-type="DELETE" data-action="<?php echo e(route('backend.contact-infos.destroy', $info->id)); ?>">
                                            <i class="fa fa-trash" Area-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php echo e($infos->links('vendor.pagination.bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab Content End -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('modal'); ?>
<div class="modal fade" id="contact-create-modal" tabindex="-1" Area-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="ajaxform_instant_reload" action="<?php echo e(route('backend.contact-infos.store')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create contact info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" Area-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Contact Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="number"><?php echo e(__('Contact Number')); ?></label>
                        <input type="text" class="form-control" name="number" id="number" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning submit-btn"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="contact-edit-modal" tabindex="-1" Area-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="contact-edit-form ajaxform_instant_reload" action="" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update commission rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" Area-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Contact Title</label>
                        <input type="text" class="form-control title" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="number"><?php echo e(__('Contact Number')); ?></label>
                        <input type="text" class="form-control number" name="number" id="number" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning submit-btn"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $('.edit-commission').on('click', function() {
            let url = $(this).data('url');
            let title = $(this).data('title');
            let number = $(this).data('number');
            $('.title').val(title);
            $('.number').val(number);
            $('.contact-edit-form').attr('action', url);
            $('#contact-edit-modal').modal('show');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/china_hub/resources/views/backend/pages/website_setting/contact-infos/index.blade.php ENDPATH**/ ?>