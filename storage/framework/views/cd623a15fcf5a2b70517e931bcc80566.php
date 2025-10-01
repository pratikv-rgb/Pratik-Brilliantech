    <!-- Page Header -->
    <div class="page-header pb-0">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="page-header-title text-break">
                    <span class="page-header-icon">
                        <img src="<?php echo e(asset('public/assets/admin/img/store.png')); ?>" class="w--26" alt="">
                    </span>
                    <span><?php echo e($store->name); ?></span>
                </h1>
            </div>
            <div>
                <?php if(Request::is("admin/store/view/{$store->id}")): ?>
                    <?php if($store->vendor->status): ?>
                    <a href="<?php echo e(route('admin.store.edit',[$store->id])); ?>" class="btn btn--primary float-right">
                        <i class="tio-edit"></i> <?php echo e(translate('messages.edit_store')); ?>

                    </a>
                    <?php else: ?>
                        <?php if(!isset($store->vendor->status)): ?>
                        <a class="btn btn--danger text-capitalize font-weight-bold float-right request_alert"
                    data-url="<?php echo e(route('admin.store.application',[$store['id'],0])); ?>"
                    data-message="<?php echo e(translate('messages.you_want_to_deny_this_application')); ?>"
                            href="javascript:"><i class="tio-clear-circle-outlined font-weight-bold pr-1"></i> <?php echo e(translate('messages.deny')); ?></a>
                        <?php endif; ?>
                        <a class="btn btn--primary text-capitalize font-weight-bold float-right mr-2 request_alert"
                        data-url="<?php echo e(route('admin.store.application',[$store['id'],1])); ?>"
                        data-message="<?php echo e(translate('messages.you_want_to_approve_this_application')); ?>"
                            href="javascript:"><i class="tio-checkmark-circle-outlined font-weight-bold pr-1"></i><?php echo e(translate('messages.approve')); ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if($store->vendor->status): ?>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev d-none">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
            </a>
            </span>

            <span class="hs-nav-scroller-arrow-next d-none">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')==null?'active':''); ?>" href="<?php echo e(route('admin.store.view', $store->id)); ?>"><?php echo e(translate('messages.overview')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='order'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'order'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='item'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'item'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.items')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='reviews'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'reviews'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.reviews')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='discount'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'discount'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.discounts')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='transaction'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.transactions')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='settings'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'settings'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.settings')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='conversations'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'conversations'])); ?>"  aria-disabled="true"><?php echo e(translate('Conversations')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='meta-data'?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'meta-data'])); ?>"  aria-disabled="true"><?php echo e(translate('meta_data')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='disbursements' ?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'disbursements'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.disbursements')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='business_plan' ?'active':''); ?>" href="<?php echo e(route('admin.store.view', ['store'=>$store->id, 'tab'=> 'business_plan'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.business_plan')); ?></a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
        <?php endif; ?>
    </div>
    <!-- End Page Header -->
<?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/vendor/view/partials/_header.blade.php ENDPATH**/ ?>