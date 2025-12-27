<?php $__env->startSection('title','Seller Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="multivendor-shop-bg">
    <div class="container">
        <div class="img-wrapper">
            <img src="<?php echo e(asset('uploads/sellers/'.$seller->banner)); ?>" alt="">
        </div>
    </div>
</div>
<!-- Shop List Start -->
<section class="shop-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="multivendors-filter">
                    <div class="follow">
                        <div class="img">
                            <img src="<?php echo e(asset('uploads/sellers/'.$seller->image)); ?>" alt="">
                        </div>
                        <div class="content">
                            <h5><?php echo e(__($seller->company_name)); ?></h5>
                            
                        </div>
                    </div>
                    <div class="page-tabs">
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home Page')); ?></a></li>
                            <li><a class="active" href="<?php echo e(route('seller.product',$seller->slug)); ?>"><?php echo e(__('All Products')); ?></a></li>
                            <li><a href="<?php echo e(route('seller.profile',$seller->slug)); ?>"><?php echo e(__('Profile')); ?></a></li>
                        </ul>
                    </div>
                    <div class="search-tabs">
                        
                        <div class="nav multi-vendors-shop-tab">
                            <a class="" href="#ShopGrid" data-bs-toggle="tab">
                                <i class="fa-solid fa-table-cells"></i>
                            </a>
                            <a href="#ShopList" data-bs-toggle="tab" class="active">
                                <i class="fa-solid fa-list"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="ShopGrid">
                        <div class="row auto-margin-3">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card4','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product-card4'); ?>
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
                    <div class="tab-pane fade" id="ShopList">
                        <div class="row auto-margin-3">
                            <div class="col-lg-12">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginal5d9b37d58b4fc322377df48fa54c686fcf1ccad0 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Frontend\ProductCard3::class, ['product' => $product]); ?>
<?php $component->withName('frontend.product-card3'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d9b37d58b4fc322377df48fa54c686fcf1ccad0)): ?>
<?php $component = $__componentOriginal5d9b37d58b4fc322377df48fa54c686fcf1ccad0; ?>
<?php unset($__componentOriginal5d9b37d58b4fc322377df48fa54c686fcf1ccad0); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginal0bdc63ce09123d4161cd13601bbf8dc766981fe3 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Frontend\PageNavigation::class, ['paginator' => $products]); ?>
<?php $component->withName('frontend.page-navigation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0bdc63ce09123d4161cd13601bbf8dc766981fe3)): ?>
<?php $component = $__componentOriginal0bdc63ce09123d4161cd13601bbf8dc766981fe3; ?>
<?php unset($__componentOriginal0bdc63ce09123d4161cd13601bbf8dc766981fe3); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Shop List End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u849325218/domains/chinabdhub.com/public_html/resources/views/frontend/seller/product.blade.php ENDPATH**/ ?>