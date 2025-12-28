<?php $__env->startSection('title','Website Appearance - '); ?>
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
                    <div class="tab-pane fade show active" id="appearance" Area-labelledby="appearance-tab">
                        <div class="container content-title">
                            <h4><?php echo e(__('Appearance Information')); ?></h4>
                        </div>
                        <div class="container">
                            <form id="appearanceForm" method="post"
                                  action="<?php echo e(route('backend.website_setting.appearance.update',$appearance->id)); ?>"
                                  enctype="multipart/form-data" class="add-brand-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Frontend website Name')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="website_name" required
                                                               class="form-control <?php $__errorArgs = ['website_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->website_name): ?><?php echo e($appearance->website_name); ?><?php else: ?><?php echo e(old('website_name')); ?><?php endif; ?>"
                                                               placeholder="Maan ecommerce">
                                                        <?php $__errorArgs = ['website_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="website_name-error"
                                                               for="website_name"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Website Logo')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <img id="logo" src="<?php echo e(URL::to('uploads/'.$appearance->logo)); ?>"
                                                         alt="logo" width="150">
                                                    <div class="input-group">
                                                        <input type="file" name="logo" accept="image/*"
                                                               type="file"
                                                               onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])"
                                                               class="form-control <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->logo): ?><?php echo e($appearance->logo); ?><?php else: ?><?php echo e(old('logo')); ?><?php endif; ?>">
                                                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="logo-error"
                                                               for="logo"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Website Favicon')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <img id="favicon" src="<?php echo e(URL::to('uploads/'.$appearance->favicon)); ?>"
                                                         alt="favicon" width="100">
                                                    <div class="input-group">
                                                        <input type="file" name="favicon" accept="image/*"
                                                               type="file"
                                                               onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])"
                                                               class="form-control <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->favicon): ?><?php echo e($appearance->favicon); ?><?php else: ?><?php echo e(old('favicon')); ?><?php endif; ?>">
                                                        <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="favicon-error"
                                                               for="favicon"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Backend Logo')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <img id="backend_logo" src="<?php echo e(URL::to('uploads/'.$appearance->backend_logo)); ?>"
                                                         alt="backend_logo" width="150">
                                                    <div class="input-group">
                                                        <input type="file" name="backend_logo" accept="image/*"
                                                               onchange="document.getElementById('backend_logo').src = window.URL.createObjectURL(this.files[0])"
                                                               class="form-control <?php $__errorArgs = ['backend_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->backend_logo): ?><?php echo e($appearance->backend_logo); ?><?php else: ?><?php echo e(old('backend_logo')); ?><?php endif; ?>">
                                                        <?php $__errorArgs = ['backend_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="backend_logo-error"
                                                               for="backend_logo"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Website Base Color (Hex color code)')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="website_base_color" required
                                                               class="form-control <?php $__errorArgs = ['website_base_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->website_base_color): ?><?php echo e($appearance->website_base_color); ?><?php else: ?><?php echo e(old('website_base_color')); ?><?php endif; ?>"
                                                               placeholder="#E62E04">
                                                        <?php $__errorArgs = ['website_base_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="website_base_color-error"
                                                               for="website_base_color"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Website Base Hover Color (Hex color code)')); ?><span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="website_base_hover_color" required
                                                               class="form-control <?php $__errorArgs = ['website_base_hover_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->website_base_hover_color): ?><?php echo e($appearance->website_base_hover_color); ?><?php else: ?><?php echo e(old('website_base_hover_color')); ?><?php endif; ?>"
                                                               placeholder="#E62E04">
                                                        <?php $__errorArgs = ['website_base_hover_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="website_base_hover_color-error"
                                                               for="website_base_hover_color"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Cookies Agreement Text')); ?></span></div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                    <textarea name="cookies_agreement_desc"
                                                              class="editor form-control"><?php echo e($appearance->cookies_agreement_desc); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="show-cookies-btn"><?php echo e(__('Show Cookies Agreement?')); ?></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group check-toggle-btn">
                                                        <div class="form-switch">
                                                            <input type="hidden" name="is_show_cookies_agreement"
                                                                   value="0">
                                                            <input class="form-check-input" value="1" name="is_show_cookies_agreement"
                                                                   <?php if($appearance->is_show_cookies_agreement): ?>checked
                                                                   <?php endif; ?> type="checkbox">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Meta Title')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="meta_title" required
                                                               class="form-control <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->meta_title): ?><?php echo e($appearance->meta_title); ?><?php else: ?><?php echo e(old('meta_title')); ?><?php endif; ?>"
                                                               placeholder="Maan ecommerce CMS">
                                                        <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="meta_title-error"
                                                               for="meta_title"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Meta description')); ?> </span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="meta_desc"
                                                               class="form-control <?php $__errorArgs = ['meta_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->meta_desc): ?><?php echo e($appearance->meta_desc); ?><?php else: ?><?php echo e(old('meta_desc')); ?><?php endif; ?>"
                                                               placeholder="Maan ecommerce CMS">
                                                        <?php $__errorArgs = ['meta_desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="meta_desc-error"
                                                               for="meta_desc"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Keywords')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="keywords" required
                                                               class="form-control <?php $__errorArgs = ['keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->keywords): ?><?php echo e($appearance->keywords); ?><?php else: ?><?php echo e(old('keywords')); ?><?php endif; ?>"
                                                               placeholder="Keywords,Keyword,Separate with coma">
                                                        <?php $__errorArgs = ['keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="keywords-error"
                                                               for="keywords"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Hotline Number')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="hotline_number" required
                                                               onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                               class="form-control <?php $__errorArgs = ['hotline_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->hotline_number): ?><?php echo e($appearance->hotline_number); ?><?php else: ?><?php echo e(old('hotline_number')); ?><?php endif; ?>"
                                                               placeholder="01xxxxxxx">
                                                        <?php $__errorArgs = ['hotline_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="hotline_number-error"
                                                               for="hotline_number"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Email')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="email" name="email" required
                                                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->email): ?><?php echo e($appearance->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>"
                                                               placeholder="Email">
                                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="email-error"
                                                               for="email"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Default Currency')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <select name="currency_id"
                                                                class="form-select currency form-control<?php echo e($errors->has('currency_id') ? ' is-invalid' : ''); ?>"
                                                                required>
                                                            <option value=""><?php echo e(__('Select Currency')); ?></option>
                                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($currency->id); ?>"
                                                                        <?php if($currency->id==$appearance->currency_id|| $currency->id==old('currency_id')): ?> selected <?php endif; ?> ><?php echo e($currency->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['currency_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>)
                                                        <label class="error " id="currency_id-error"
                                                               for="currency_id"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Base Currency')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <select name="base_currency_id"
                                                                class="form-select currency form-control<?php echo e($errors->has('base_currency_id') ? ' is-invalid' : ''); ?>"
                                                                required>
                                                            <option value=""><?php echo e(__('Select Currency')); ?></option>
                                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($currency->id); ?>"
                                                                        <?php if($currency->id==$appearance->base_currency_id|| $currency->id==old('base_currency_id')): ?> selected <?php endif; ?> ><?php echo e($currency->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['base_currency_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>)
                                                        <label class="error " id="currency_id-error"
                                                               for="currency_id"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <div class="sm-text small text-danger"><?php echo e(__('Please update change
                                                            exchange rate of every currency after you update the base
                                                            currency')); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Get in Touch')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <textarea type="text" name="get_in_touch" required
                                                                  class="form-control <?php $__errorArgs = ['get_in_touch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                  placeholder="Get in Touch"
                                                        ><?php if($appearance->get_in_touch && $appearance->get_in_touch!="''"): ?><?php echo e($appearance->get_in_touch); ?><?php else: ?><?php echo e(old('get_in_touch')); ?><?php endif; ?></textarea>
                                                        <?php $__errorArgs = ['get_in_touch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="get_in_touch-error"
                                                               for="get_in_touch"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('About Us')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <textarea type="text" name="about_us" required
                                                                  class="form-control <?php $__errorArgs = ['about_us'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                  placeholder="About us"
                                                        ><?php if($appearance->about_us && $appearance->about_us!="''"): ?><?php echo e($appearance->about_us); ?><?php else: ?><?php echo e(old('about_us')); ?><?php endif; ?></textarea>
                                                        <?php $__errorArgs = ['about_us'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="about_us-error"
                                                               for="about_us"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('City')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="city" required
                                                               class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->city): ?><?php echo e($appearance->city); ?><?php else: ?><?php echo e(old('city')); ?><?php endif; ?>"
                                                               placeholder="City">
                                                        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="city-error"
                                                               for="city"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Country')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <select name="country"
                                                                class="form-select country form-control<?php echo e($errors->has('country') ? ' is-invalid' : ''); ?>"
                                                                required>
                                                            <option value=""><?php echo e(__('Select Country')); ?></option>
                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($country->name); ?>"
                                                                        <?php if($country->name==$appearance->country|| $country->id==old('country')): ?> selected <?php endif; ?> ><?php echo e($country->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>)
                                                        <label class="error " id="country-error"
                                                               for="country"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Post Code')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="post_code" required
                                                               class="form-control <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->post_code): ?><?php echo e($appearance->post_code); ?><?php else: ?><?php echo e(old('post_code')); ?><?php endif; ?>"
                                                               placeholder="Post Code">
                                                        <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="post_code-error"
                                                               for="post_code"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Facebook Link')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="facebook_link" required
                                                               class="form-control <?php $__errorArgs = ['facebook_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->facebook_link && $appearance->facebook_link!="''"): ?><?php echo e($appearance->facebook_link); ?><?php else: ?><?php echo e(old('facebook_link')); ?><?php endif; ?>"
                                                               placeholder="Facebook Link">
                                                        <?php $__errorArgs = ['facebook_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="facebook_link-error"
                                                               for="facebook_link"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Twitter Link')); ?> <span
                                                                                class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="twitter_link" required
                                                               class="form-control <?php $__errorArgs = ['twitter_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->twitter_link && $appearance->twitter_link!="''"): ?><?php echo e($appearance->twitter_link); ?><?php else: ?><?php echo e(old('twitter_link')); ?><?php endif; ?>"
                                                               placeholder="Twitter Link">
                                                        <?php $__errorArgs = ['twitter_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="twitter_link-error"
                                                               for="twitter_link"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Pinterest Link')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="pinterest_link" required
                                                               class="form-control <?php $__errorArgs = ['pinterest_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->pinterest_link && $appearance->pinterest_link!="''"): ?><?php echo e($appearance->pinterest_link); ?><?php else: ?><?php echo e(old('pinterest_link')); ?><?php endif; ?>"
                                                               placeholder="Pinterest Link">
                                                        <?php $__errorArgs = ['pinterest_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="pinterest_link-error"
                                                               for="pinterest_link"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Instagram Link')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="instagram_link" required
                                                               class="form-control <?php $__errorArgs = ['instagram_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               value="<?php if($appearance->instagram_link && $appearance->instagram_link!="''"): ?><?php echo e($appearance->instagram_link); ?><?php else: ?><?php echo e(old('instagram_link')); ?><?php endif; ?>"
                                                               placeholder="Instagram Link">
                                                        <?php $__errorArgs = ['instagram_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <label class="error" id="instagram_link-error"
                                                               for="instagram_link"><?php echo e($message); ?></label>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Linkdin Link')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="linkdin_link" class="form-control" placeholder="Linkdin Link" value="<?php if($appearance->linkdin_link && $appearance->linkdin_link!="''"): ?><?php echo e($appearance->linkdin_link); ?><?php else: ?><?php echo e(old('linkdin_link')); ?><?php endif; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="title"><?php echo e(__('Youtube Link')); ?> <span class="text-red">*</span></span>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" name="youtube_link" class="form-control" placeholder="Youtube Link" value="<?php if($appearance->youtube_link && $appearance->youtube_link!="''"): ?><?php echo e($appearance->youtube_link); ?><?php else: ?><?php echo e(old('youtube_link')); ?><?php endif; ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 offset-3">
                                            <div class="from-submit-btn">
                                                <button class="submit-btn" type="submit"><?php echo e(__('Update')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        $(function () {

            "use strict";
            $(document).ready(function () {
                $('#appearanceForm').validate();
                $('.country').select2();
                $('.currency').select2();
                /*rich text editor set*/
                $('.editor').summernote({
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['codeview', 'help']]
                    ]
                })
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/china_hub/resources/views/backend/pages/website_setting/appearance.blade.php ENDPATH**/ ?>