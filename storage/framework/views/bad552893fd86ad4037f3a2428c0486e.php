<?php
if(session()->get('cart_product_ids') && count(session()->get('cart_product_ids'))>0){
    $cart_product_ids = session()->get('cart_product_ids');
}else{
    $cart_product_ids = [];
}
?>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="order--item-box item-box">
        <?php echo $__env->make('admin-views.pos._single_product',['product'=>$product, 'store_data'=>$store, 'cart_product_ids'=>$cart_product_ids], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/pos/_single_product_list.blade.php ENDPATH**/ ?>