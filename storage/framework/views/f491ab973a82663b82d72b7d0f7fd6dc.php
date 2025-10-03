<?php $__env->startSection('title', translate('messages.Add new category')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/category.png')); ?>" class="w--20" alt="">
                </span>
                <span>
                    <?php echo e(translate('add_new_category')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <form
                    action="<?php echo e(isset($category) ? route('admin.category.update', [$category['id']]) : route('admin.category.store')); ?>"
                    method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if($language): ?>
                        <ul class="nav nav-tabs mb-4 border-0">
                            <li class="nav-item">
                                <a class="nav-link lang_link active" href="#"
                                    id="default-link"><?php echo e(translate('messages.default')); ?></a>
                            </li>
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link" href="#"
                                        id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($language): ?>
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>

                                        (<?php echo e(translate('messages.default')); ?>)
                                        <span class="form-label-secondary text-danger" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                        </span>

                                    </label>
                                    <input type="text" name="name[]" value="<?php echo e(old('name.0')); ?>" class="form-control"
                                        placeholder="<?php echo e(translate('messages.new_category')); ?>" maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>

                                            (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input type="text" name="name[]" value="<?php echo e(old('name.' . $key + 1)); ?>"
                                            class="form-control" placeholder="<?php echo e(translate('messages.new_category')); ?>"
                                            maxlength="191">
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="<?php echo e(translate('messages.new_category')); ?>" value="<?php echo e(old('name')); ?>"
                                        maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            <?php endif; ?>
                            <input name="position" value="0" class="initial-hidden">

                            <?php if($categoryWiseTax): ?>
                                <span class="mb-2 d-block title-clr fw-normal"><?php echo e(translate('Select Tax Rate')); ?></span>
                                <select name="tax_ids[]" id="tax__rate" class="form-control js-select2-custom"
                                    multiple="multiple" required placeholder="Type & Select Tax Rate">
                                    <?php $__currentLoopData = $taxVats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxVat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($taxVat->id); ?>"> <?php echo e($taxVat->name); ?>

                                            (<?php echo e($taxVat->tax_rate); ?>%)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 d-flex align-items-center flex-column">
                                <label class="mb-3 text-center"><?php echo e(translate('messages.image')); ?> <small
                                        class="text-danger">* ( <?php echo e(translate('messages.ratio')); ?> 1:1)</small></label>
                                <label class="text-center my-auto position-relative d-inline-block">
                                    <img class="img--176 border" id="viewer"
                                        <?php if(isset($category)): ?> src="<?php echo e(asset('storage/app/public/category')); ?>/<?php echo e($category['image']); ?>"
                                        <?php else: ?>
                                        src="<?php echo e(asset('public/assets/admin/img/upload-img.png')); ?>" <?php endif; ?>
                                        alt="image" />
                                    <div class="icon-file-group">
                                        <div class="icon-file">
                                            <input type="file" name="image" id="customFileEg1"
                                                class="custom-file-input read-url"
                                                accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <i class="tio-edit"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" id="reset_btn"
                            class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit"
                            class="btn btn--primary"><?php echo e(isset($category) ? translate('messages.update') : translate('messages.add')); ?></button>
                    </div>

                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header py-2 border-0">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><?php echo e(translate('messages.category_list')); ?><span
                            class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($categories->total()); ?></span></h5>

                    <form class="search-form">
                        <!-- Search -->
                        <div class="input-group input--group">
                            <input type="search" name="search" value="<?php echo e(request()?->search ?? null); ?>"
                                class="form-control min-height-45"
                                placeholder="<?php echo e(translate('messages.search_categories')); ?>"
                                aria-label="<?php echo e(translate('messages.ex_:_categories')); ?>">
                            <input type="hidden" name="position" value="0">
                            <button type="submit" class="btn btn--secondary min-height-45"><i
                                    class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>
                    <?php if(request()->get('search')): ?>
                        <button type="reset" class="btn btn--primary ml-2 location-reload-to-category"
                            data-url="<?php echo e(url()->full()); ?>"><?php echo e(translate('messages.reset')); ?></button>
                    <?php endif; ?>
                    <!-- Unfold -->
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40"
                            href="javascript:;"
                            data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item"
                                href="<?php echo e(route('admin.category.export-categories', ['type' => 'excel', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item"
                                href="<?php echo e(route('admin.category.export-categories', ['type' => 'csv', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(asset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                .<?php echo e(translate('messages.csv')); ?>

                            </a>

                        </div>
                    </div>
                    <!-- End Unfold -->
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-align-middle"
                        data-hs-datatables-options='{
                            "isResponsive": false,
                            "isShowPaging": false,
                            "paging":false,
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0"><?php echo e(translate('sl')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.id')); ?></th>
                                <th class="border-0 w--1"><?php echo e(translate('messages.name')); ?></th>
                                <th class="border-0 text-center"><?php echo e(translate('messages.status')); ?></th>
                                <th class="border-0 text-center"><?php echo e(translate('messages.featured')); ?></th>
                                <?php if($categoryWiseTax): ?>
                                <th  class="border-0 "><?php echo e(translate('messages.Vat/Tax')); ?></th>
                                <?php endif; ?>
                                <th class="border-0 text-center"><?php echo e(translate('messages.priority')); ?></th>
                                <th class="border-0 text-center"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                        </thead>

                        <tbody id="table-div">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + $categories->firstItem()); ?></td>
                                    <td><?php echo e($category->id); ?></td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            <?php echo e(Str::limit($category['name'], 20, '...')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm"
                                            for="stocksCheckbox<?php echo e($category->id); ?>">
                                            <input type="checkbox"
                                                data-url="<?php echo e(route('admin.category.status', [$category['id'], $category->status ? 0 : 1])); ?>"
                                                class="toggle-switch-input redirect-url"
                                                id="stocksCheckbox<?php echo e($category->id); ?>"
                                                <?php echo e($category->status ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label mx-auto">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm"
                                            for="featuredCheckbox<?php echo e($category->id); ?>">
                                            <input type="checkbox"
                                                data-url="<?php echo e(route('admin.category.featured', [$category['id'], $category->featured ? 0 : 1])); ?>"
                                                class="toggle-switch-input redirect-url"
                                                id="featuredCheckbox<?php echo e($category->id); ?>"
                                                <?php echo e($category->featured ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label mx-auto">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>


                                <?php if($categoryWiseTax): ?>
                                <td>
                                    <span class="d-block font-size-sm text-body">
                                        <?php $__empty_1 = true; $__currentLoopData = $category?->taxVats?->pluck('tax.name', 'tax.tax_rate')->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span> <?php echo e($tax); ?> : <span class="font-bold">
                                                    (<?php echo e($key); ?>%)
                                                </span> </span>
                                            <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <span> <?php echo e(translate('messages.no_tax')); ?> </span>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <?php endif; ?>




                                    <td>

                                        <form action="<?php echo e(route('admin.category.priority', $category->id)); ?>"
                                            class="priority-form">
                                            <select name="priority" id="priority"
                                                class="form-control form--control-select  priority-select  mx-auto <?php echo e($category->priority == 0 ? 'text-title' : ''); ?> <?php echo e($category->priority == 1 ? 'text-info' : ''); ?> <?php echo e($category->priority == 2 ? 'text-success' : ''); ?>">
                                                <option value="0" class="text--title"
                                                    <?php echo e($category->priority == 0 ? 'selected' : ''); ?>>
                                                    <?php echo e(translate('messages.normal')); ?></option>
                                                <option value="1" class="text--title"
                                                    <?php echo e($category->priority == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(translate('messages.medium')); ?></option>
                                                <option value="2" class="text--title"
                                                    <?php echo e($category->priority == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(translate('messages.high')); ?></option>
                                            </select>
                                        </form>

                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn action-btn btn--primary btn-outline-primary"
                                                href="<?php echo e(route('admin.category.edit', [$category['id']])); ?>"
                                                title="<?php echo e(translate('messages.edit_category')); ?>"><i
                                                    class="tio-edit"></i>
                                            </a>
                                            <a class="btn action-btn btn--danger btn-outline-danger form-alert"
                                                href="javascript:" data-id="category-<?php echo e($category['id']); ?>"
                                                data-message="<?php echo e(translate('Want to delete this category')); ?>"
                                                title="<?php echo e(translate('messages.delete_category')); ?>"><i
                                                    class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.category.delete', [$category['id']])); ?>"
                                                method="post" id="category-<?php echo e($category['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(count($categories) !== 0): ?>
                <hr>
            <?php endif; ?>
            <div class="page-area">
                <?php echo $categories->appends($_GET)->links(); ?>

            </div>
            <?php if(count($categories) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(asset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/view-pages/category-index.js"></script>
    <script>
        "use strict";
        $('.location-reload-to-category').on('click', function() {
            const url = $(this).data('url');
            let nurl = new URL(url);
            nurl.searchParams.delete('search');
            location.href = nurl;
        });

        $("#customFileEg1").change(function() {
            readURL(this);
            $('#viewer').show(1000)
        });
        $('#reset_btn').click(function() {
            $('#exampleFormControlSelect1').val(null).trigger('change');
            $('#viewer').attr('src', "<?php echo e(asset('public/assets/admin/img/upload-img.png')); ?>");
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/category/index.blade.php ENDPATH**/ ?>