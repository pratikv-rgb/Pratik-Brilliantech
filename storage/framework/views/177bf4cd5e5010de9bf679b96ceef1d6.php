<h4 class="m-0 mr-1">
    <?php ($params = session('dash_params')); ?>
    <?php if($params['zone_id'] != 'all'): ?>
        <?php ($zone_name = \App\Models\Zone::where('id', $params['zone_id'])->first()->name); ?>
    <?php else: ?>
        <?php ($zone_name = translate('messages.all')); ?>
    <?php endif; ?>
</h4>
<?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/partials/_zone-change.blade.php ENDPATH**/ ?>