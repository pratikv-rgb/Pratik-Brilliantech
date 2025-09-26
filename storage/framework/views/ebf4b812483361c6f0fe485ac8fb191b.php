<?php $__empty_1 = true; $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div  class="select-product-item media gap-3 cursor-pointer">
        <img class="avatar avatar-xl border onerror-image" width="75"
        data-onerror-image="<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>"
        src="<?php echo e($store['logo_full_url'] ?? asset('public/assets/admin/img/160x160/img1.jpg')); ?>"

            alt="">
        <div class="media-body d-flex flex-column gap-1 ">
            <a href="#"  class="d-flex flex-column gap-1"  onclick="selected_stores(<?php echo e($store->id); ?>)">
                <h6 class="fs-13 mb-1 text-truncate custom-width product-name"><?php echo e($store['name']); ?></h6>
                <div class="d-flex gap-1 flex-wrap align-items-center lh--1">
                    <i class=" fs-13 tio-star"></i>
                    <div class="fs-10 text-dark" > <?php echo e($store->ratings['rating']); ?></div>
                    <div class="fs-10 text-muted" >  (<?php echo e($store->ratings['total']); ?>)</div>
                </div>
                <div class="fs-10 text-muted" ><?php echo e($store->address); ?></div>
                <div class="d-flex gap-3 flex-wrap align-items-center text-primary "  >
                    <div class="fs-10  " ><?php echo e($store->items_count); ?> <?php echo e(translate('messages.items')); ?>+</div>
                    <div class=" bg-primary" style="width: 1px;height: 10px;">

                    </div>
                    <div class="fs-10 " ><?php echo e($store->orders_count); ?> <?php echo e(translate('messages.Orders')); ?></div>
                </div>

            </a>

        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-center"><?php echo e(translate('messages.No Data found')); ?></p>
<?php endif; ?>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/view-pages/common.js"></script>
<?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/vendor/partials/_search_store.blade.php ENDPATH**/ ?>