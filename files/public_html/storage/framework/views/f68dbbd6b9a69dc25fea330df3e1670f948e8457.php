<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('meta_title', $product->meta_title ?? $product->name); ?>

<?php $__env->startSection('meta_description', $product->meta_description ?? ''); ?>

<?php $__env->startSection('meta_image', $product->meta_image); ?>

<?php $__env->startSection('meta_url', url()->full()); ?>

<?php $__env->startSection('meta_price', currency($product->unit_price, 2)); ?>

<?php $__env->startSection('meta_color', 'Black'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb Start -->
    <nav class="breadcrumb-manu" Area-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(url('shop')); ?>"><?php echo e(__('Shop')); ?></a></li>
                <li class="breadcrumb-item active" Area-current="page"><?php echo e(__('Product')); ?></li>
            </ol>
        </div>
    </nav>
    <!-- Breadcrumb End -->
    <!-- Shop Details Start -->
    <section class="shop-details multivendor-shop-details-section">
        <div class="container">
            <div class="product-details-layout">
                <div class="layout-items">


                    <!-- Primary carousel image -->
                    <?php if($product->images->first()->image ?? false): ?>
                        <div class="show product-zoom-thumb" href="<?php echo e(asset('uploads/products/galleries/' . $product->images->first()->image ?? '')); ?>">
                            <img src="<?php echo e(asset('uploads/products/galleries/' . $product->images->first()->image ?? '')); ?>" id="show-img" alt="<?php echo e($product->name); ?>">
                        </div>
                    <?php endif; ?>

                    <!-- Secondary carousel image thumbnail gallery -->
                    <div class="small-img">
                        <div class="icon-left" id="prev-img"><i class="fas fa-chevron-left"></i></div>
                        <img src="images/next-icon.png" alt="" id="prev-img">
                        <div class="small-container">
                            <div id="small-img-roll">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e(asset('uploads/products/galleries/' . $image->image)); ?>" class="show-small-img" alt="product-thumbnail-sm">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="icon-right" id="next-img"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
                <div class="layout-items">
                    <div class="multiventors-details-middle new-product-detais">
                        <div class="title-area">
                            <h2>
                                <?php echo e($product->name); ?>

                                <?php if($product->video->video_link ?? false): ?>
                                    <a target="_blank" href="<?php echo e($product->video->video_link ?? ''); ?>" class="text-danger"><i class="fa-solid fa-circle-play"></i></a>
                                <?php endif; ?>
                            </h2>

                            <div class="multivendor-price" data-product-quantity="<?php echo e($product->quantity); ?>">
                                <?php if($product->quantity && $product->is_manage_stock): ?>
                                    <small class="m-2">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" rx="9.5" fill="#13E291" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0301 6.45179L8.44376 10.2687L6.97682 8.78573C6.64346 8.44873 6.09956 8.44725 5.76435 8.78244C5.43125 9.11552 5.43032 9.65528 5.76228 9.98953L8.44378 12.6896L13.2404 7.6623C13.5746 7.32807 13.5747 6.78613 13.2404 6.45189C12.9062 6.11764 12.3643 6.11759 12.0301 6.45179Z" fill="white" />
                                        </svg>
                                        <?php echo e(__('In Stock')); ?>

                                    </small>
                                <?php else: ?>
                                    <small class="m-2">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" rx="9.5" fill="red" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0301 6.45179L8.44376 10.2687L6.97682 8.78573C6.64346 8.44873 6.09956 8.44725 5.76435 8.78244C5.43125 9.11552 5.43032 9.65528 5.76228 9.98953L8.44378 12.6896L13.2404 7.6623C13.5746 7.32807 13.5747 6.78613 13.2404 6.45189C12.9062 6.11764 12.3643 6.11759 12.0301 6.45179ZM5.76228 6.45179L12.0301 12.7196M5.76228 12.7196L12.0301 6.45179" stroke="white" stroke-width="1.5" />
                                        </svg>

                                        <?php echo e(__('Sold Out')); ?>

                                    </small>
                                <?php endif; ?>

                                <div class="sku-text m-2"><?php echo e(__('Code:')); ?> <?php echo e($product->sku); ?></div>
                                <?php if($product->details->is_show_stock_quantity): ?>
                                    <div class=" m-2"><?php echo e(__('Stock Qty:')); ?> <?php echo e($product->quantity); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="new-price-wrapper">
                            <div class="new-product-details-button-group">
                                <?php $__currentLoopData = $wholesales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wholesale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="product-qty-btn"><span class="product-min-qty"><?php echo e($wholesale->min_range); ?> </span><?php echo e(__('-')); ?><span class="product-max-qty"><?php echo e($wholesale->max_range); ?> </span><span> <?php echo e(__('pcs :')); ?></span> <strong><?php echo e(userCurrency('symbol')); ?> <span class="product-price-all"><?php echo e(userCurrency('exchange_rate') * $wholesale->price); ?> </span> </strong></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="price">
                                <small>Price: </small>

                                <span><?php echo e(userCurrency('symbol')); ?>

                                    <?php if(hasPromotion($product->id)): ?>
                                        <span id="current_price"><?php echo e(promotionPrice($product->id)); ?></span> <del><?php echo e(currency($product->unit_price)); ?></del>

                                        <small class="offer-percent"><?php echo e(__('-')); ?><?php echo e(round((($product->unit_price - promotionPrice($product->id)) / $product->unit_price) * 100)); ?> <?php echo e(__('%')); ?></small>
                                    <?php else: ?>
                                        <span id="current_price"><?php echo e(userCurrency('exchange_rate') * $product->sale_price); ?></span>
                                        <?php if($product->discount > 0): ?>
                                            <del><?php echo e(currency($product->unit_price)); ?></del>

                                            <small class="offer-percent"><?php echo e(__('-')); ?><?php echo e(round((($product->unit_price - $product->sale_price) / $product->unit_price) * 100)); ?> <?php echo e(__('%')); ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </span>
                            </div>
                        </div>

                        <?php if($product->productstock->count() > 0): ?>
                            <?php if($product->productstock[0]->color ?? false): ?>
                                <div class="product-size-wrap product-size-v2">
                                    <h6>Color:</h6>
                                    <ul>
                                        <?php $__currentLoopData = $product->productstock ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productstock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($productstock->color->name ?? false): ?>
                                                <li>
                                                    <label class="product-size">
                                                        <input name="color"  value="<?php echo e($productstock->color->name); ?>" type="radio" data-color_id="<?php echo e($productstock->color->id); ?>" class="color-vAreation" data-variantimage="<?php echo e($productstock->variant_image); ?>">
                                                        <span class="checkmark product-color" style="background-color: <?php echo e($productstock->color->hex); ?>"></span>
                                                    </label>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if($product->productstock[0]->size ?? false): ?>
                                <div class="product-size-wrap product-size-v2">
                                    <h6>Size:</h6>
                                    <ul>
                                        <?php $__currentLoopData = $product->productstock ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productstock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($productstock->size->name ?? false): ?>
                                                <li>
                                                    <label class="product-size">
                                                        <input type="radio"  name="size" value="<?php echo e($productstock->size->name ?? ''); ?>" data-size_id="<?php echo e($productstock->size->id); ?>" class="size-vAreation">
                                                        <span class="checkmark"><?php echo e($productstock->size->name ?? ''); ?></span>
                                                    </label>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="new-quantity-area">
                            
                            <div class="new-quantity-item">
                                <h5><?php echo e(__('Total Price:')); ?></h5>
                                <h5><?php echo e(userCurrency('symbol')); ?><span id="total_price">
                                        <?php if(hasPromotion($product->id)): ?>
                                            <?php echo e(promotionPrice($product->id)); ?>

                                        <?php else: ?>
                                            <?php echo e(number_format(userCurrency('exchange_rate') * $product->sale_price)); ?>

                                        <?php endif; ?>
                                    </span></h5>
                                <small><?php echo e($product->unit); ?></small>
                            </div>
                        </div>
                        <div class="new-quantity-area">
                            <div class="new-quantity-item">
                                <h5><?php echo e(__('Quantity:')); ?></h5>
                                <div class="product-quantity multivents-number">
                                    <form>
                                        <div class="quantity">
                                            <button type="button" class="minus" id="whole_minus" data-key="<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>"><i class="fal fa-minus"></i></button>
                                            <input type="number" class="input-number" min="1" name="quantity" value="1" data-id="<?php echo e($product->id); ?>" <?php if (! ($product->quantity && $product->is_manage_stock)): ?> readonly <?php endif; ?>>
                                            <button type="button" class="plus" id="whole_plus" data-id="<?php echo e($product->id); ?>" <?php if (! ($product->quantity && $product->is_manage_stock)): ?> disabled <?php endif; ?>><i class="fal fa-plus"></i></button>
                                        </div>

                                    </form>
                                </div>
                                <?php if (! ($product->quantity && $product->is_manage_stock)): ?>
                                    <strong><span class="text-danger">Out of stock</span></strong>
                                <?php endif; ?>

                            </div>

                        </div>
                        <div class="cart-button-wrapper">
                            
                            <a href="javascript:addToCart(<?php echo e($product->id); ?>)" class="btn maan-cartbtn m-2 <?php if (! ($product->quantity && $product->is_manage_stock)): ?> disabled <?php endif; ?>"><?php echo e(__('Add to Cart')); ?></a>
                            <a href="javascript:void(0)" data-buynow-url="<?php echo e(route('buynow.index', ['product_id' => $product->id])); ?>" class="btn buynow-btn m-2 <?php if (! ($product->quantity && $product->is_manage_stock)): ?> disabled <?php endif; ?>"><?php echo e(__('Buy Now')); ?></a>
                            <a href="javascript:addToWishlist(<?php echo e($product->id); ?>)" class="maan-wishlist-btn m-2">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="layout-items">
                    <div class="multivendors-social mt-0 mb-2">
                        <div class="socialsharea">
                            <small><?php echo e(__('Share')); ?>: </small>
                            <ul>
                                <li>
                                    <div data-href="<?php echo e(url()->full()); ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->full()); ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa-brands fa-facebook-f"></i></a></div>
                                </li>
                                <li><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo e(url()->full()); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(route('product', $product->slug)); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="https://www.pinterest.com/pin/create/button?url=<?php echo e(route('product', $product->slug)); ?>&media=<?php echo e(asset('uploads/products/galleries')); ?>/<?php echo e(optional($product->images)->first()->image ?? ''); ?>&description=<?php echo e($product->name); ?>" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="contact-infos my-3">
                        <?php $__currentLoopData = getContactsInfos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-item">
                                <h6 class="d-inline-block my-1"><?php echo e($item->value['number'] ?? ''); ?></h6> <small class="d-inline-block ms-2"><?php echo e($item->value['title'] ?? ''); ?></small>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if($product->seller): ?>
                        <div class="product-details-wedget">
                            <div class="wedget-items">
                                <div class="details-meta-items">
                                    <div class="wrapper">
                                        <i class="fa-solid fa-store"></i>
                                        <p> <?php echo e(__('Sold By: ')); ?> <?php echo e(optional($product->seller)->company_name ?? optional($product->seller)->first_name); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if(optional($product->seller)->slug): ?>
                                <a href="<?php echo e(route('seller.product', optional($product->seller)->slug)); ?>" class="store-visite-btn"><?php echo e(__('Visit Store')); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="tab-info">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" Area-controls="specifications" Area-selected="false"><?php echo e(__('Specifications')); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" Area-controls="description" Area-selected="false"><?php echo e(__('Description')); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" Area-controls="reviews" Area-selected="false">
                            <?php echo e(__('Reviews')); ?> (<?php echo e($product->reviews->count()); ?>)</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="specifications" role="tabpanel" Area-labelledby="specifications-tab">
                        <?php if($product->pdf_specification): ?>
                            <div class="row">
                                <div class="col-12">
                                    <embed src="<?php echo e(URL::to('uploads/products/pdf') . '/' . $product->pdf_specification ?? ''); ?>" type="application/pdf" width="100%" height="350">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="tab-pane fade" id="description" role="tabpanel" Area-labelledby="description-tab">
                        <?php echo e($product->description); ?>

                    </div>

                    <div class="tab-pane fade" id="reviews" role="tabpanel" Area-labelledby="reviews-tab">
                        <?php if($product->reviews->count() == 0): ?>
                            <p class="woocommerce-noreviews"><?php echo e(__('There are no reviews yet.')); ?></p>
                        <?php endif; ?>
                        <div class="star-rating">
                            <div class="rateit" data-rateit-value="<?php echo e(productRating($product->reviews)); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        </div>
                        <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <b><?php echo e($review->user->first_name); ?></b>
                            <div class="rateit" data-rateit-value="<?php echo e($review->review_point); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                            <p><?php echo e($review->review_note); ?></p>
                            <hr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(auth('customer')->check()): ?>
                            <?php if(canReview(auth('customer')->id(), $product->id)): ?>
                                <form class="contact-form ajaxform_instant_reload" action="<?php echo e(route('customer.review')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-2">
                                        <!-- Product Rating -->
                                        <input type="range" name="review_point" value="5" step="1" id="backing5" required>
                                        <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false" data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                        <div class="col-12">
                                            <div class="input-group mb-1">
                                                <textarea class="form-control" name="review_note" required></textarea>
                                                <span class="label"><?php echo e(__('Please write your experience here')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-anime submit-btn mt-2"><?php echo e(__('Submit')); ?></button>
                                </form>
                            <?php elseif($pendingReview): ?>
                                <b><?php echo e(__('Your review is pending')); ?></b>
                            <?php else: ?>
                                <p><?php echo e(__('You are not eligible to review this product')); ?></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p><?php echo e(__('Login to review this product')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details End -->
    <!-- Similar Product Start -->
    <section class="similar-product pt-5">
        <div class="container">
            <div class="title-center">
                <h4><?php echo e(__('Similar Products')); ?></h4>
                <p><?php echo e(__('The Standard chunk of lorem ipsum reproduced below those interested.')); ?></p>
            </div>
            <div class="row auto-margin-3">
                <?php $__currentLoopData = $similarProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-lg-2 col-md-4 col-6">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-card4','data' => ['product' => $similar]]); ?>
<?php $component->withName('frontend.product-card4'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($similar)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!-- Similar Product End -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $('.color-vAreation').click(function(e) {
                let color = $(this).data('variantimage');
                let path = `<?php echo e(asset('/uploads/products/galleries/${color}')); ?>`
                $('#show-img').attr('src', path);
                $('#big-img').attr('src', path)
            });
        })
        $('.buynow-btn').on('click', function() {
            let size = $('.size-vAreation').val();
            let size_id = $('.size-vAreation').data('size_id');
            let color = $('.color-vAreation').val();
            let color_id = $('.color-vAreation').data('color_id');
            let buynow_qty = $('.input-number').val();
            let buynow_url = $(this).data('buynow-url');
            let area = $('[name="delivery_charge"]:checked').val();
            if (color) {
                if ($("input[name='color']:checked").length == 0) {
                    swal("<?php echo e(__('Please select a color')); ?>");
                    return false;
                }
            }
            if (size) {
                if ($("input[name='size']:checked").length == 0) {
                    swal("<?php echo e(__('Please select a size')); ?>");
                    return false;
                }
            }
            /* if($("input[name='delivery_charge']:checked").length == 0){
                    swal("<?php echo e(__('Please select delivery charge')); ?>");
                return false;
            } */

            let url = buynow_url + '&qty=' + buynow_qty + '&area=' + area + '&color_id=' + color_id + '&color=' + color + '&size_id=' + size_id + '&size=' + size;
            window.location.href = url;
        });
        $('.maan-cartbtn').on('click', function() {

            let size = $('.size-vAreation').val();
            let color = $('.color-vAreation').val();
            if (color) {
                if ($("input[name='color']:checked").length == 0) {
                    swal("<?php echo e(__(' Please select a color')); ?>");
                    return false;
                }
            }
            if (size) {
                if ($("input[name='size']:checked").length == 0) {
                    swal("<?php echo e(__(' Please select a size')); ?>");
                    return false;
                }
            }
            /*if($("input[name='delivery_charge']:checked").length == 0){
                swal("<?php echo e(__('Please select delivery charge')); ?>");
                return false;
            }*/

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Works\projects\China Hub\final_update\public_html\resources\views/frontend/pages/product-details-2.blade.php ENDPATH**/ ?>