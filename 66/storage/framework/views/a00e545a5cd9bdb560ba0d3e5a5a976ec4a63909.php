<!-- Product Tab Start -->
<section class="product-tab">
    <div class="container">
        <div class="tab-title">
            <h4><?php echo e(__('Deal of the week')); ?></h4>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-item-tab" data-bs-toggle="tab" data-bs-target="#all-item" type="button" role="tab" Area-controls="all-item" Area-selected="true"><?php echo e(__('All item')); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="new-arrivals-tab" data-bs-toggle="tab" data-bs-target="#new-arrivals" type="button" role="tab" Area-controls="new-arrivals" Area-selected="false"><?php echo e(__('New Arrivals')); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="best-seller-tab" data-bs-toggle="tab" data-bs-target="#best-seller" type="button" role="tab" Area-controls="best-seller" Area-selected="false"><?php echo e(__('Best Seller')); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="our-featured-tab" data-bs-toggle="tab" data-bs-target="#our-featured" type="button" role="tab" Area-controls="our-featured" Area-selected="false"><?php echo e(__('Our Featured')); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="trends-tab" data-bs-toggle="tab" data-bs-target="#trends" type="button" role="tab" Area-controls="trends" Area-selected="false"><?php echo e(__('Trends')); ?></button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="all-item" role="tabpanel" Area-labelledby="all-item-tab">
                <div class="row auto-margin-3">
                    <?php if($allProducts->count() == 0): ?>
                        <div class="col-12">
                            <p class="text-center"><?php echo e(__('UPCOMING...')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $allProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card2','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="new-arrivals" role="tabpanel" Area-labelledby="new-arrivals-tab">
                <div class="row auto-margin-3">
                    <?php if($newArrivals->count() == 0): ?>
                        <div class="col-12">
                            <p class="text-center"><?php echo e(__('UPCOMING...')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $newArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card2','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="best-seller" role="tabpanel" Area-labelledby="best-seller-tab">
                <div class="row auto-margin-3">
                    <?php if($bestSellers->count() == 0): ?>
                        <div class="col-12">
                            <p class="text-center"><?php echo e(__('UPCOMING...')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card2','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="our-featured" role="tabpanel" Area-labelledby="our-featured-tab">
                <div class="row auto-margin-3">
                    <?php if($featureProducts->count() == 0): ?>
                        <div class="col-12">
                            <p class="text-center"><?php echo e(__('UPCOMING...')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $featureProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card2','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="trends" role="tabpanel" Area-labelledby="trends-tab">
                <div class="row auto-margin-3">
                    <?php if($trends->count() == 0): ?>
                        <div class="col-12">
                            <p class="text-center"><?php echo e(__('UPCOMING...')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $trends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card2','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Tab End -->
<?php /**PATH F:\xampp\htdocs\chinahub\resources\views/frontend/_product-tab.blade.php ENDPATH**/ ?>