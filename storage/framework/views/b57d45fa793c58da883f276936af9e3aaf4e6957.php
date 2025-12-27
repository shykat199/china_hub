<?php $__env->startSection('title','Language'); ?>





<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-6">
            <div class="content-body">
                <!-- Tab Content Start -->
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="add-category" role="tabpanel" Area-labelledby="add-category-tab">
                        <div class="container">
                            <form id="faqForm" method="post" action="<?php echo e(route('backend.language.default')); ?>" class="add-brand-form">
                                <?php echo csrf_field(); ?>
                                <div>
                                    <p><?php echo e(__('Set the default language for website')); ?></p>
                                </div>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <select name="id" class="form-select category form-control<?php echo e($errors->has('faq_category_id') ? ' is-invalid' : ''); ?>" required id="type">
                                            <option value=""><?php echo e(__('Select Language')); ?></option>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        <?php if($errors->has('type')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('type')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-7 offset-3">
                                    <div class="from-submit-btn">
                                        <button class="submit-btn" type="submit"><?php echo e(__('Set Default')); ?></button>
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
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="add-category" role="tabpanel" Area-labelledby="add-category-tab">
                        <div class="container">
                            <form id="faqForm" method="post" action="<?php echo e(route('backend.language.store')); ?>" class="add-brand-form">
                                <?php echo csrf_field(); ?>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input name="name" type="text" class="form-control" placeholder="Language Name. Ex: English, Arabic">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <select name="direction" id="direction" class="form-select category form-control">
                                            <option value="ltr"><?php echo e(__('Left to Right (LTR)')); ?></option>
                                            <option value="rtl"><?php echo e(__('Right to Left (RTL)')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input name="alias" type="text" class="form-control" placeholder="en, bn or eu etc">
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
    </div>

    <div class="content-body">
        <div class="container">
            <div class="content-tab-title">
                <h4><?php echo e(__('Language List')); ?></h4>
            </div>
        </div>
        <!-- Tab Content Start -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="questions-and-answer" role="tabpanel"
                 Area-labelledby="questions-and-answer-tab">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="float-md-end">
                                <label for="q"><?php echo e(__('Search')); ?></label>
                                <input type="text" name="search" class="form-control" id="search">
                            </div>
                        </div>
                    </div>
                    <div class="content-table">
                        <table class="table p-table">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('Id')); ?></th>
                                <th scope="col"><?php echo e(__('Name')); ?></th>
                                <th scope="col"><?php echo e(__('Direction')); ?></th>
                                <th scope="col"><?php echo e(__('Alias')); ?></th>
                                <th scope="col"><?php echo e(__('Is Default')); ?></th>
                                <th scope="col"><?php echo e(__('Is Active')); ?></th>
                                <th scope="col"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody id="coupon-list">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($language->id); ?></td>
                                    <td><?php echo e($language->name); ?></td>
                                    <td><?php echo e($language->direction); ?></td>
                                    <td><?php echo e($language->alias); ?></td>
                                    <td>
                                        <?php echo e($language->default); ?>

                                    </td>
                                    <td>
                                        <?php echo e($language->is_active); ?>

                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a class="p-0 action" href="<?php echo e(route('backend.language.translation',$language->id)); ?>">
                                                    <button title="Translate">
                                                        <i class="fa-solid fa-language"></i>
                                                    </button>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="p-0 action" href="#" data-bs-toggle="modal" data-bs-target="#editModal" onclick="langEdit(<?php echo e($language->id); ?>)">
                                                    <button title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                            </li>
                                            <li>
                                                <form user="deleteForm" method="POST" action="<?php echo e(route('backend.language.destroy', $language->id)); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?>
                                                    <a class="p-0 action" href="javascript:void(0);"
                                                       onclick="deleteWithSweetAlert(event,parentNode);">
                                                        <button title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
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

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" Area-labelledby="editModalLabel" Area-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><?php echo e(__('Edit Language')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" Area-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
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

    <script>
        function langEdit(id){
            var csrf = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                url: "<?php echo e(route('backend.language.edit')); ?>",
                data: {_token:csrf,id:id},
                method: "post"
            }).done(function(e){
                $("#modal-body").html(e);
            })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u849325218/domains/chinabdhub.com/public_html/resources/views/backend/pages/language/index.blade.php ENDPATH**/ ?>