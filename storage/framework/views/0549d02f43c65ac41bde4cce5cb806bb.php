<?php $__env->startSection('title',translate('denied_stores')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title"><i class="tio-filter-list"></i> <?php echo e(translate('messages.denied_stores')); ?></h1>
            <div class="page-header-select-wrapper">

                <?php if(!isset(auth('admin')->user()->zone_id)): ?>
                <div class="select-item">
                    <select name="zone_id" class="form-control js-select2-custom set-filter" data-url="<?php echo e(url()->full()); ?>" data-filter="zone_id">
                        <option value="" <?php echo e(!request('zone_id')?'selected':''); ?>><?php echo e(translate('messages.All_Zones')); ?></option>
                        <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                    value="<?php echo e($z['id']); ?>" <?php echo e(isset($zone) && $zone->id == $z['id']?'selected':''); ?>>
                                <?php echo e($z['name']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
                        <!-- Nav -->
                        <ul class="nav nav-tabs mb-3 border-0 nav--tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.store.pending-requests')); ?>"   aria-disabled="true"><?php echo e(translate('messages.pending_stores')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(route('admin.store.deny-requests')); ?>"  aria-disabled="true"><?php echo e(translate('messages.denied_stores')); ?></a>
                            </li>
                        </ul>
                        <!-- End Nav -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><?php echo e(translate('messages.stores_list')); ?> <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($stores->total()); ?></span></h5>
                    <form action="javascript:" id="search-form" class="search-form">
                    <!-- Search -->
                        <?php echo csrf_field(); ?>
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="<?php echo e(translate('ex_:_Search_Store_Name')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>" value="<?php echo e(isset($search_by) ? $search_by : ''); ?>" required>
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                    </form>
                    <!-- End Search -->
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging":false

                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="border-0"><?php echo e(translate('sl')); ?></th>
                        <th class="border-0"><?php echo e(translate('messages.store_information')); ?></th>
                        <th class="border-0"><?php echo e(translate('messages.module')); ?></th>
                        <th class="border-0"><?php echo e(translate('messages.owner_information')); ?></th>
                        <th class="border-0"><?php echo e(translate('messages.zone')); ?></th>
                        <th class="text-uppercase border-0"><?php echo e(translate('messages.status')); ?></th>
                        <th class="border-0"><?php echo e(translate('messages.action')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+$stores->firstItem()); ?></td>
                            <td>
                                <div>
                                    <a href="<?php echo e(route('admin.store.view', $store->id)); ?>" class="table-rest-info" alt="view store">
                                        <img class="img--60 circle onerror-image" data-onerror-image="<?php echo e(asset('public/assets/admin/img/160x160/img1.jpg')); ?>"

                                        src="<?php echo e($store['logo_full_url'] ?? asset('public/assets/admin/img/160x160/img1.jpg')); ?>" >
                                        <div class="info"><div class="text--title">
                                            <?php echo e(Str::limit($store->name,20,'...')); ?>

                                            </div>
                                            <div class="font-light">
                                                <?php echo e(translate('messages.id')); ?>:<?php echo e($store->id); ?>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <span class="d-block font-size-sm text-body">
                                    <?php echo e(Str::limit($store->module->module_name,20,'...')); ?>

                                </span>
                            </td>
                            <td>
                                <span class="d-block font-size-sm text-body">
                                    <?php echo e(Str::limit($store->vendor->f_name.' '.$store->vendor->l_name,20,'...')); ?>

                                </span>
                                <div>
                                    <?php echo e($store['phone']); ?>

                                </div>
                            </td>
                            <td>
                                <?php echo e($store->zone?$store->zone->name:translate('messages.zone_deleted')); ?>

                            </td>

                            <td>
                                <?php if(isset($store->vendor->status)): ?>
                                    <?php if($store->vendor->status): ?>
                                    <?php else: ?>
                                    <span class="badge badge-soft-danger"><?php echo e(translate('messages.denied')); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger"><?php echo e(translate('messages.pending')); ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($store->vendor->status == 0): ?>
                                    <a class="btn action-btn btn--primary btn-outline-primary float-right mr-2 request_alert" data-toggle="tooltip" data-placement="top"
                                       data-original-title="<?php echo e(translate('messages.approve')); ?>"
                                       data-url="<?php echo e(route('admin.store.application',[$store['id'],1])); ?>" data-message="<?php echo e(translate('messages.you_want_to_approve_this_application')); ?>"
                                    href="javascript:"><i class="tio-done font-weight-bold"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
                <?php if(count($stores) !== 0): ?>
                <hr>
                <?php endif; ?>
                <div class="page-area">
                    <?php echo $stores->withQueryString()->links(); ?>

                </div>
                <?php if(count($stores) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            <!-- End Table -->
        </div>
        <!-- End Card -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $('.status_change_alert').on('click', function (event) {
            let url = $(this).data('url');
            let message = $(this).data('message');
            status_change_alert(url, message, event)
        })
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(translate('Are you sure?')); ?>' ,
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                confirmButtonText: '<?php echo e(translate('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href=url;
                }
            })
        }
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('keyup', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $('.request_alert').on('click', function (event) {
            let url = $(this).data('url');
            let message = $(this).data('message');
            request_alert(url, message)
        })

        function request_alert(url, message) {
            Swal.fire({
                title: '<?php echo e(translate('messages.are_you_sure')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                confirmButtonText: '<?php echo e(translate('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }

        $('#search-form').on('submit', function () {
            let formData = new FormData(this);
            set_filter('<?php echo url()->full(); ?>',formData.get('search'),'search_by')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/vendor/deny_requests.blade.php ENDPATH**/ ?>