<div id="headerMain" class="d-none">
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered pr-0">
        <div class="navbar-nav-wrap">

            <div class="navbar-nav-wrap-content-left d-xl-none">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                       data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                       data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
            </div>

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right flex-grow-1 w-0">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row flex-grow-1 __navbar-nav">

                    <li class="nav-item __nav-item">
                        <a href="<?php echo e(route('admin.users.dashboard')); ?>" id="tourb-6"
                           class="__nav-link <?php echo e(Request::is('admin/users*') ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('assets/admin/img/new-img/user.svg')); ?>" alt="public/img">
                            <span><?php echo e(translate('Users')); ?></span>
                        </a>
                    </li>

                    <li class="nav-item __nav-item">
                        <a href="<?php echo e(route('admin.transactions.store.withdraw_list')); ?>" id="tourb-7"
                           class="__nav-link <?php echo e(Request::is('admin/transactions*') ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('assets/admin/img/new-img/transaction-and-report.svg')); ?>"
                                 alt="public/img">
                            <span><?php echo e(translate('Transactions & Reports')); ?></span>
                        </a>
                    </li>

                    <li class="nav-item __nav-item">
                        <a href="<?php echo e(route('admin.business-settings.business-setup')); ?>" id="tourb-3"
                           class="__nav-link <?php echo e(Request::is('admin/business-settings*') ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('assets/admin/img/new-img/setting-icon.svg')); ?>" alt="public/img">
                            <span><?php echo e(translate('messages.Settings')); ?></span>
                            <svg width="14" viewBox="0 0 14 14" fill="none">
                                <path d="M2.33325 5.25L6.99992 9.91667L11.6666 5.25" stroke="#006161" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <div class="__nav-module" id="tourb-4">
                            <div class="__nav-module-header">
                                <div class="inner">
                                    <h4><?php echo e(translate('Settings')); ?></h4>
                                    <p>
                                        <?php echo e(translate('Monitor your business general settings from here')); ?>

                                    </p>
                                </div>
                            </div>
                            <div class="__nav-module-body">
                                <ul>
                                    <?php if(\App\CentralLogics\Helpers::module_permission_check('module')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.business-settings.module.index')); ?>"
                                               class="next-tour">
                                                <img
                                                    src="<?php echo e(asset('assets/admin/img/navbar-setting-icon/module.svg')); ?>"
                                                    alt="">
                                                <span><?php echo e(translate('System Module Setup')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\App\CentralLogics\Helpers::module_permission_check('zone')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.business-settings.zone.home')); ?>"
                                               class="next-tour">
                                                <img
                                                    src="<?php echo e(asset('assets/admin/img/navbar-setting-icon/location.svg')); ?>"
                                                    alt="">
                                                <span><?php echo e(translate('Zone Setup')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\App\CentralLogics\Helpers::module_permission_check('settings')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.business-settings.business-setup')); ?>"
                                               class="next-tour">
                                                <img
                                                    src="<?php echo e(asset('assets/admin/img/navbar-setting-icon/business.svg')); ?>"
                                                    alt="">
                                                <span><?php echo e(translate('Business Settings')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(\App\CentralLogics\Helpers::module_permission_check('settings')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.business-settings.third-party.payment-method')); ?>"
                                               class="next-tour">
                                                <img
                                                    src="<?php echo e(asset('assets/admin/img/navbar-setting-icon/third-party.svg')); ?>"
                                                    alt="">
                                                <span><?php echo e(translate('3rd Party')); ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('admin.business-settings.social-media.index')); ?>"
                                               class="next-tour">
                                                <img
                                                    src="<?php echo e(asset('assets/admin/img/navbar-setting-icon/social.svg')); ?>"
                                                    alt="">
                                                <span><?php echo e(translate('Social Media and Page Setup')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                                <div class="text-center mt-2">
                                    <a href="<?php echo e(route('admin.business-settings.business-setup')); ?>"
                                       class="next-tour"><?php echo e(translate('View All')); ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php if(\App\CentralLogics\Helpers::module_permission_check('order')): ?>
                        <li class="nav-item __nav-item">
                            <a href="<?php echo e(route('admin.dispatch.dashboard')); ?>" id="tourb-8"
                               class="__nav-link <?php echo e(Request::is('admin/dispatch*') ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('assets/admin/img/new-img/dispatch.svg')); ?>" alt="public/img">
                                <span><?php echo e(translate('Dispatch Management')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <li class="nav-item max-sm-m-0 w-xxl-200px ml-auto flex-grow-0">
                        <button type="button" id="modalOpener" class="title-color bg--secondary border-0 rounded justify-content-between w-100 align-items-center py-2 px-2 px-md-3 d-flex gap-1" data-toggle="modal" data-target="#staticBackdrop">
                            <div class="align-items-center d-flex flex-grow-1 gap-1 justify-content-between">
                                <span class="align-items-center d-none d-xxl-flex gap-2 text-muted"><?php echo e(translate('Search')); ?>

                                </span>
                                <img width="14" class="h-auto" src="<?php echo e(asset('assets/admin/img/new-img/search.svg')); ?>" class="svg" alt="">
                            </div>
                        </button>
                    </li>

                    <li class="nav-item max-sm-m-0  mr-lg-3">
                        <a class="btn btn-icon rounded-circle nav-msg-icon"
                           href="<?php echo e(route('admin.message.list')); ?>">
                            <img src="<?php echo e(asset('assets/admin/img/new-img/message-icon.svg')); ?>" alt="public/img">
                            <?php ($message=\App\Models\Conversation::whereUserType('admin')->whereHas('last_message', function($query) {
                                $query->whereColumn('conversations.sender_id', 'messages.sender_id');
                            })->where('unread_message_count', '>', 0)->count()); ?>
                            <?php if($message!=0): ?>
                                <span class="btn-status btn-status-danger"><?php echo e($message); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item max-sm-m-0">
                        <div class="hs-unfold">
                            <div>
                                <?php ( $local = session()->has('local')?session('local'): null); ?>
                                <?php ($lang = \App\Models\BusinessSetting::where('key', 'system_language')->first()); ?>
                                <?php if($lang): ?>
                                    <div
                                        class="topbar-text dropdown disable-autohide text-capitalize d-flex">
                                        <a class="topbar-link dropdown-toggle d-flex align-items-center title-color"
                                           href="#" data-toggle="dropdown">
                                            <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($data['code']==$local): ?>
                                                    <i class="tio-globe"></i> <?php echo e($data['code']); ?>


                                                <?php elseif(!$local &&  $data['default'] == true): ?>
                                                    <i class="tio-globe"></i> <?php echo e($data['code']); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </a>
                                        <ul class="dropdown-menu lang-menu">
                                            <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($data['status']==1): ?>
                                                    <li>
                                                        <a class="dropdown-item py-1"
                                                           href="<?php echo e(route('admin.lang',[$data['code']])); ?>">
                                                            <span class="text-capitalize"><?php echo e($data['code']); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <?php ($mod = \App\Models\Module::find(Config::get('module.current_module_id'))); ?>
                    <div class="nav-item __nav-item">
                        <a href="javascript:void(0)" class="__nav-link module--nav-icon" id="tourb-0">
                            <?php if($mod): ?>
                                <img src="<?php echo e($mod->icon_full_url); ?>"
                                     class="onerror-image"
                                     data-onerror-image="<?php echo e(asset('assets/admin/img/new-img/module-icon.svg')); ?>"
                                     width="20px" alt="public/img">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/admin/img/new-img/module-icon.svg')); ?>"
                                     alt="public/img">
                            <?php endif; ?>
                            <span class="text-white"><?php echo e($mod ? $mod->module_name : translate('modules')); ?></span>
                            <img src="<?php echo e(asset('assets/admin/img/new-img/angle-white.svg')); ?>"
                                 class="d-none d-lg-block ml-xl-2" alt="public/img">
                        </a>
                        <div class="__nav-module style-2" id="tourb-1">
                            <?php ($modules = \App\Models\Module::when(auth('admin')->user()->zone_id, function($query){
                                $query->whereHas('zones',function($query){
                                    $query->where('zone_id',auth('admin')->user()->zone_id);
                                });
                            })->Active()->get()); ?>
                            <?php if(isset($modules) && ($modules->count()>0)): ?>
                                <div class="__nav-module-header">
                                    <div class="inner">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-6">
                                                <h5><?php echo e(translate('Modules Section')); ?></h5>
                                                <p class="m-0">
                                                    <?php echo e(translate('Select Module & Monitor your business module wise')); ?>

                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="__nav-module-body">
                                    <div class="__nav-module-items">
                                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(($module->module_type == 'rental' && addon_published_status('Rental') == 1) || $module->module_type != 'rental'): ?>
                                            <a href="javascript:"

                                               data-module-id="<?php echo e($module->id); ?>"
                                               data-url="<?php echo e($module->module_type == 'rental' && addon_published_status('Rental') ? route('admin.rental.dashboard') : route('admin.dashboard')); ?>"
                                               data-filter="module_id"

                                               class="__nav-module-item set-module <?php echo e(Config::get('module.current_module_id') == $module->id?'active':''); ?>">
                                                <div class="img w--70px ">
                                                    <img src="<?php echo e($module?->icon_full_url); ?>"

                                                         data-onerror-image="<?php echo e(asset('assets/admin/img/new-img/module/e-shop.svg')); ?>"
                                                         alt="new-img" class="mw-100 onerror-image">
                                                </div>
                                                <div>
                                                    <?php echo e($module->module_name); ?>

                                                </div>
                                            </a>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\App\CentralLogics\Helpers::module_permission_check('module')): ?>
                                            <a href="<?php echo e(route('admin.business-settings.module.create')); ?>"
                                               class="__nav-module-item" data-toggle="tooltip"
                                               data-placement="top" title="<?php echo e(translate('add_new_module')); ?>">
                                                <i class="tio-add display-3"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="__nav-module-body text-center py-5">
                                    <img class="w--120px" src="<?php echo e(asset('assets/admin/img/empty-box.png')); ?>"
                                         alt="">
                                    <h2 class="my-4"><?php echo e(translate('Please, Enable or Create Module First')); ?></h2>
                                    <a href="<?php echo e(route('admin.business-settings.module.index')); ?>"
                                       class="btn btn--primary"><?php echo e(translate('messages.Module Setup')); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>

<div class="modal fade removeSlideDown" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered max-w-520">
        <div class="modal-content modal-content__search border-0">
            <div class="d-flex flex-column gap-3 rounded-20 bg-card py-2 px-3">
                <div class="d-flex gap-2 align-items-center position-relative">
                    <form class="flex-grow-1" id="searchForm" action="<?php echo e(route('admin.search.routing')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex align-items-center global-search-container">
                            <input  autocomplete="off" class="form-control flex-grow-1 rounded-10 search-input" id="searchInput" maxlength="255" name="search" type="search" placeholder="<?php echo e(translate('Search_by_keyword')); ?>" aria-label="Search" autofocus>
                        </div>
                    </form>
                    <div class="position-absolute right-0 pr-2">
                        <button class="border-0 rounded px-2 py-1" type="button" data-dismiss="modal"><?php echo e(translate('Esc')); ?></button>
                    </div>
                </div>
                <div class="min-h-350">
                    <div class="search-result" id="searchResults">
                        <div class="text-center text-muted py-5"><?php echo e(translate('It appears that you have not yet searched.')); ?>.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toggle-tour">
    <a href="https://youtube.com/playlist?list=PLLFMbDpKMZBxgtX3n3rKJvO5tlU8-ae2Y" target="_blank"
       class="d-flex align-items-center gap-10px">
        <img src="<?php echo e(asset('assets/admin/img/tutorial.svg')); ?>" alt="">
        <span>
            <span class="text-capitalize"><?php echo e(translate('Turotial')); ?></span>
        </span>
    </a>
    <div class="d-flex align-items-center gap-10px restart-Tour">
        <img src="<?php echo e(asset('assets/admin/img/tour.svg')); ?>" alt="">
        <span>
            <span class="text-capitalize"><?php echo e(translate('Tour')); ?></span>
        </span>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\Admin\resources\views/layouts/admin/partials/_header.blade.php ENDPATH**/ ?>