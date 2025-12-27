<?php $__env->startSection('title','Notifications - '); ?>
<?php $__env->startSection('content'); ?>
<div class="content-body">
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="brand" role="tabpanel" Area-labelledby="brand-tab">
            <div class="container">
                <h5 class="py-2"><?php echo app('translator')->get('All Notifications'); ?></h5>
                <div class="responsibe-table">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('#'); ?></th>
                                <th><?php echo app('translator')->get('Message'); ?></th>
                                <th><?php echo app('translator')->get('Created At'); ?></th>
                                <th><?php echo app('translator')->get('Read At'); ?></th>
                                <th><?php echo app('translator')->get('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->index+1); ?></td>
                                <td><?php echo e($notify->data['message'] ?? ''); ?></td>
                                <td><?php echo e(date('d-m-Y H:i A', strtotime($notify->created_at))); ?></td>
                                <td><?php echo e(date('d-m-Y H:i A', strtotime($notify->read_at))); ?></td>
                                <td>
                                    <a href="<?php echo e(route('backend.notifications.mtView', $notify->data['id'])); ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> <?php echo app('translator')->get('View'); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab Content End -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u849325218/domains/chinabdhub.com/public_html/resources/views/backend/pages/notifications/index.blade.php ENDPATH**/ ?>