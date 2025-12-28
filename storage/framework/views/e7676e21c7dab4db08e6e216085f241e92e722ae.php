<div class="content-tab-title">
    <h4><?php echo e(__('Website Setting')); ?></h4>
</div>
<!-- Tab Manu Start  -->
<div class="nav nav-tabs p-tab-manu" id="nav-tab" role="tablist">
    <button class="nav-link <?php if(Request::is('admin/website_setting/header')): ?>active <?php endif; ?>" id="header-tab" data-bs-toggle="tab" data-bs-target="#header"
            type="button" role="tab" Area-controls="header" Area-selected="true"
            <?php if(url()->full()!=route('backend.website_setting.header')): ?> onclick="location.href='<?php echo e(route('backend.website_setting.header')); ?>'" <?php endif; ?>
    ><?php echo e(__('Header')); ?>

    </button>
    <button class="nav-link <?php if(Request::is('admin/website_setting/pages')): ?>active <?php endif; ?>" id="pages-tab" data-bs-toggle="tab" data-bs-target="#pages" type="button"
            role="tab" Area-controls="pages" Area-selected="false"
            <?php if(url()->full()!=route('backend.website_setting.pages')): ?> onclick="location.href='<?php echo e(route('backend.website_setting.pages')); ?>'" <?php endif; ?>
    ><?php echo e(__('Pages')); ?>

    </button>
    <button class="nav-link <?php if(Request::is('admin/website_setting/appearance')): ?>active <?php endif; ?>" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance"
            type="button" role="tab" Area-controls="appearance" Area-selected="false"
            <?php if(url()->full()!=route('backend.website_setting.appearance')): ?> onclick="location.href='<?php echo e(route('backend.website_setting.appearance')); ?>'" <?php endif; ?>
    ><?php echo e(__('Appearance')); ?>

    </button>
    <button class="nav-link <?php if(Request::is('admin/website_setting/announcements','admin/website_setting/announcements/*')): ?>active <?php endif; ?>" id="announcements-tab" data-bs-toggle="tab" data-bs-target="#announcements" type="button" role="tab" Area-controls="announcements" Area-selected="false" <?php if(url()->full()!=route('backend.announcements.index')): ?> onclick="location.href='<?php echo e(route('backend.announcements.index')); ?>'" <?php endif; ?>
    ><?php echo e(__('Announcements')); ?>

    </button>
</div>
<?php /**PATH /var/www/html/china_hub/resources/views/backend/pages/website_setting/nav.blade.php ENDPATH**/ ?>