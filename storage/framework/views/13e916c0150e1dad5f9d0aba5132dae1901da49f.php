<?php $__env->startSection('title','Language'); ?>





<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-6">
            <div class="content-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="add-category" role="tabpanel" Area-labelledby="add-category-tab">
                        <div class="container">
                            <form id="faqForm" method="post" action="<?php echo e(route('backend.notice.store')); ?>" class="add-brand-form">
                                <?php echo csrf_field(); ?>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input name="headline" type="text" class="form-control" placeholder="Notice title" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>lorem ipsum dolor sumit</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input name="published_at" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <select name="is_active" class="form-control" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="from-submit-btn">
                                        <button class="submit-btn" type="submit"><?php echo e(__('Save')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Tab Content End -->
            </div>
        </div>
        <div class="col-6">
            <div class="content-body">
                <div class="container">
                    <div class="content-tab-title">
                        <h4><?php echo e(__('Notices')); ?></h4>
                    </div>
                </div>
                <!-- Tab Content Start -->
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                <div class="list-group">
                    <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo e($notice->headline); ?></h5>
                                <small><?php echo e($notice->published_at->diffForHumans()); ?></small>
                            </div>
                            <p class="mb-1"><?php echo e($notice->description); ?></p>
                            <small><?php echo e($notice->is_active == 1 ? 'Active' : 'Inactive'); ?></small>
                            <form action="<?php echo e(route('backend.notice.destroy',$notice->id)); ?>" method="post" class="float-end">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <a href="#" onclick="deleteWithSweetAlert(event,parentNode)"><i class="fas fa-trash"></i></a>
                            </form>
                            <a href="<?php echo e(route('backend.notice.edit',$notice->id)); ?>" class="float-end px-2"><i class="fas fa-edit"></i></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- Tab Content End -->
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php if($errors->any()): ?>
        <script>
            swal ( "Oops" , "<?php echo e($errors->first('msg')); ?>" ,  "error" )
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/china_hub/resources/views/backend/notice/index.blade.php ENDPATH**/ ?>