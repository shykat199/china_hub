<?php $__env->startSection('title', 'Page Title'); ?>

<?php $__env->startSection('content'); ?>

<div class="maan-blog-section maan-section py-5">
        <div class="container">
            <div class="maan-blog-wraper">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="maan-card-area">
                            <div class="row">
                                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="blog-card wow fadeInUp">
                                        <a href="<?php echo e(route('frontend.blog.details',$blog->slug)); ?>" class="card-thumb">
                                            <img src="<?php echo e(asset('/uploads/blogs/'.$blog->image)); ?>" alt="">
                                            <span class="maan-category-btn maan-btn"><?php echo e($blog->category->name); ?></span>
                                        </a>
                                        <div class="card-description">
                                            <div class="author-date">
                                                <a href="/blog-details" class="date"><span><img src="/public/frontend/img/icons/calendar.svg" alt=""></span> <?php echo e($blog->created_at->translatedFormat(' F j, Y')); ?></a>
                                                <a href="#" class="author"><span><img src="<?php echo e(asset('uploads/users/'.$blog->user->avatar)); ?>" alt=""></span><?php echo e(__('by ')); ?><?php echo e($blog->user->name); ?></a>
                                            </div>
                                            <a href="<?php echo e(route('frontend.blog.details',$blog->slug)); ?>" class="post-title"><?php echo e($blog->title); ?></a>
                                            <a href="<?php echo e(route('frontend.blog.details',$blog->slug)); ?>" class="link"><i class="fal fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <nav class="maan-pagination wow fadeInUp">
                                <ul class="pagination">
                                  <?php echo e($blogs->links()); ?>


                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="maan-wedgets-area">
                            <div class="maan-wedgets wow fadeInUp" data-wow-delay="0.1s">
                                <h2 class="wedgets-title"><?php echo e(__('Search')); ?></h2>

                                    <div class="maan-input-group">
                                        <input type="text" placeholder="Search keywords">
                                        <button class="maan-btn"><i class="fal fa-search"></i></button>
                                    </div>

                            </div>
                            <div class="maan-wedgets wow fadeInUp" data-wow-delay="0.4s">
                                <h2 class="wedgets-title"><?php echo e(__('Categories')); ?> </h2>
                                <ul class="categories">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="/blog-details"><?php echo e($category->name); ?><span><?php echo e($category->blogs->count()); ?></span></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                            <div class="maan-wedgets wow fadeInUp" data-wow-delay="0.7s">
                                <h2 class="wedgets-title"><?php echo e(__('Recent Post')); ?></h2>
                                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->iteration<6): ?>

                                <div class="blog-post-categories">
                                    <a href="<?php echo e(route('frontend.blog.details',$recentpost->slug)); ?>" class="post-thumb"><img src="<?php echo e(asset('/uploads/blogs/'.$recentpost->image)); ?>" alt=""></a>
                                    <div class="post-content">
                                        <a href="<?php echo e(route('frontend.blog.details',$recentpost->slug)); ?>" class="post-title"><?php echo e($recentpost->title); ?></a>
                                        <a href="#" class="post-date"><?php echo e($recentpost->created_at->translatedFormat(' F j, Y')); ?></a>
                                    </div>
                                </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <div class="maan-wedgets wow fadeInUp" data-wow-delay="1s">
                                <h2 class="wedgets-title">Instagram Post</h2>
                                <div class="instagram-post">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/04.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/05.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/06.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/07.png" alt="">
                                                <a href="" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/08.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/09.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/10.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/11.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="instagram-thumb">
                                                <img src="/public/frontend/img/blog/12.png" alt="">
                                                <a href="/blog-details" class="link"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="maan-wedgets wow fadeInUp mb-0" data-wow-delay="1.3s">
                                <h2 class="wedgets-title">Populer Tags</h2>
                                <ul class="maan-popular-tags">
                                    <li><a href="/blog-details" class="maan-btn">web design</a></li>
                                    <li><a href="/blog-details" class="maan-btn">ui/ux design</a></li>
                                    <li><a href="/blog-details" class="maan-btn">graphics</a></li>
                                    <li><a href="/blog-details" class="maan-btn">design</a></li>
                                    <li><a href="/blog-details" class="maan-btn">icon</a></li>
                                    <li><a href="/blog-details" class="maan-btn">graphics design</a></li>
                                    <li><a href="/blog-details" class="maan-btn">branding</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u849325218/domains/chinabdhub.com/public_html/resources/views/frontend/pages/blogs/blog.blade.php ENDPATH**/ ?>