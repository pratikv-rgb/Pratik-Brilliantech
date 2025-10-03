<?php $__env->startSection('title',translate('messages.add_new_item')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php ($module_type = \App\CentralLogics\Helpers::get_store_data()->module->module_type); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('assets/admin/img/items.png')); ?>" class="w--22" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.add_new_item')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <form action="javascript:" method="post" id="item_form"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                <?php ($language = $language->value ?? null); ?>
                <?php ($defaultLang = str_replace('_', '-', app()->getLocale())); ?>
                <div class="row g-2">
                    <div class="col-12">
                        <?php if($language): ?>
                        <ul class="nav nav-tabs border-0">
                            <li class="nav-item">
                                <a class="nav-link lang_link active"
                                href="#"
                                id="default-link"><?php echo e(translate('messages.default')); ?></a>
                            </li>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link"
                                        href="#"
                                        id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <span class="card-header-icon">
                                        <i class="tio-dashboard-outlined"></i>
                                    </span>
                                    <span><?php echo e(translate('item_info')); ?></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if($language): ?>
                                <div class="lang_form"
                                id="default-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="default_name"><?php echo e(translate('messages.name')); ?>

                                            (<?php echo e(translate('messages.Default')); ?>)
                                        </label>
                                        <input type="text" name="name[]" id="default_name"
                                            class="form-control" placeholder="<?php echo e(translate('messages.new_item')); ?>"
                                             >
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                                        <textarea type="text" name="description[]" class="form-control min-h-90px ckeditor"></textarea>
                                    </div>
                                </div>
                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-none lang_form"
                                            id="<?php echo e($lang); ?>-form">
                                            <div class="form-group">
                                                <label class="input-label"
                                                    for="<?php echo e($lang); ?>_name"><?php echo e(translate('messages.name')); ?>

                                                    (<?php echo e(strtoupper($lang)); ?>)
                                                </label>
                                                <input type="text" name="name[]" id="<?php echo e($lang); ?>_name"
                                                    class="form-control" placeholder="<?php echo e(translate('messages.new_item')); ?>"
                                                     >
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                            <div class="form-group mb-0">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                                <textarea type="text" name="description[]" class="form-control min-h-90px ckeditor"></textarea>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div id="default-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                                            <input type="text" name="name[]" class="form-control"
                                                placeholder="<?php echo e(translate('messages.new_item')); ?>" required>
                                        </div>
                                        <input type="hidden" name="lang[]" value="default">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?></label>
                                            <textarea type="text" name="description[]" class="form-control min-h-90px ckeditor"></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-image"></i>
                                </span>
                                <span><?php echo e(translate('item_image')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-auto">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.item_images')); ?></label>
                                <div class="row py-2" id="coba"></div>
                            </div>
                            <div class="mt-3">
                                <label class="text-dark">
                                    <?php echo e(translate('messages.item_thumbnail')); ?>

                                    <small class="text-danger">* ( <?php echo e(translate('messages.ratio')); ?> 1:1 )</small>
                                </label>
                                <div id="image-viewer-section" class="text-center pt-2 pb-3 text-left">
                                    <img class="img--100" id="viewer"
                                            src="<?php echo e(asset('assets/admin/img/100x100/2.png')); ?>" alt="banner image"/>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                            accept=".webp, .jpg, .png, .webp , .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg1"><?php echo e(translate('messages.choose_file')); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-dollar-outlined"></i>
                                </span>
                                <span> <?php echo e(translate('item_details')); ?> </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('messages.category')); ?><span
                                                class="input-label-secondary">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control js-select2-custom get-request"
                                                data-url="<?php echo e(url('/')); ?>/vendor-panel/item/get-categories?parent_id=" data-id="sub-categories">
                                            <option value="">---<?php echo e(translate('messages.select')); ?>---</option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('messages.sub_category')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="sub_category_id" id="sub-categories" class="form-control js-select2-custom get-request" data-url="<?php echo e(url('/')); ?>/vendor-panel/item/get-categories?parent_id=" data-id="sub-sub-categories">
                                        </select>
                                    </div>
                                </div>
                                <?php if($module_data['unit']): ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label text-capitalize" for="unit"><?php echo e(translate('messages.unit')); ?></label>
                                        <select name="unit" id="unit" class="form-control js-select2-custom">
                                            <?php $__currentLoopData = \App\Models\Unit::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_data['common_condition']): ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="condition_id"><?php echo e(translate('messages.Suitable_For')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="condition_id" id="condition_id"
                                            data-placeholder="<?php echo e(translate('messages.Select_Condition')); ?>"
                                            id="condition_id" class="js-select2-custom form-control"
                                            oninvalid="this.setCustomValidity('<?php echo e(translate('messages.Select_Condition')); ?>')">
                                            <option value="">---<?php echo e(translate('messages.select')); ?>---</option>
                                            <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($condition['id']); ?>"><?php echo e($condition['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_data['brand']): ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="brand_id"><?php echo e(translate('messages.Brand')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="brand_id" id="brand_id"
                                            data-placeholder="<?php echo e(translate('messages.Select_brand')); ?>"
                                            id="brand_id" class="js-select2-custom form-control"
                                            oninvalid="this.setCustomValidity('<?php echo e(translate('messages.Select_brand')); ?>')">
                                            <option value="">---<?php echo e(translate('messages.select')); ?>---</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($brand['id']); ?>"><?php echo e($brand['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_data['veg_non_veg']): ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.item_type')); ?></label>
                                        <select name="veg" id="veg" class="form-control js-select2-custom" required>
                                            <option value="0"><?php echo e(translate('messages.non_veg')); ?></option>
                                            <option value="1"><?php echo e(translate('messages.veg')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_type == 'grocery' || $module_type == 'food'): ?>

                                    <div class="col-sm-6" id="nutrition">
                                        <label class="input-label" for="sub-categories">
                                            <?php echo e(translate('Nutrition')); ?>

                                            <span class="input-label-secondary" title="<?php echo e(translate('Specify the necessary keywords relating to energy values for the item.')); ?>" data-toggle="tooltip">
                                                <i class="tio-info-outined"></i>
                                            </span>
                                        </label>
                                        <select name="nutritions[]" class="form-control multiple-select2" data-placeholder="<?php echo e(translate('messages.Type your content and press enter')); ?>" multiple>
                                            <?php $__currentLoopData = \App\Models\Nutrition::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nutrition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($nutrition->nutrition); ?>"><?php echo e($nutrition->nutrition); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>


                                    <div class="col-sm-6" id="allergy">
                                        <label class="input-label" for="sub-categories">
                                            <?php echo e(translate('Allegren Ingredients')); ?>

                                            <span class="input-label-secondary" title="<?php echo e(translate('Specify the ingredients of the item which can make a reaction as an allergen.')); ?>" data-toggle="tooltip">
                                                <i class="tio-info-outined"></i>
                                            </span>
                                        </label>
                                        <select name="allergies[]" class="form-control multiple-select2" data-placeholder="<?php echo e(translate('messages.Type your content and press enter')); ?>" multiple>
                                            <?php $__currentLoopData = \App\Models\Allergy::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($allergy->allergy); ?>"><?php echo e($allergy->allergy); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.price')); ?></label>
                                        <input type="number" min="0" max="999999999999" step="0.01" value="1" name="price" class="form-control"
                                                placeholder="<?php echo e(translate('messages.Ex:')); ?> 100" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.discount_type')); ?></label>
                                        <select name="discount_type" id="discount_type" class="form-control js-select2-custom">
                                            <option value="percent"><?php echo e(translate('messages.percent')); ?></option>
                                            <option value="amount"><?php echo e(translate('messages.amount')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.discount')); ?></label>
                                        <input type="number" min="0" max="999999999" value="0" name="discount" class="form-control"
                                                placeholder="<?php echo e(translate('messages.Ex:')); ?> 100" >
                                    </div>
                                </div>
                                <?php if($module_data['stock']): ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="total_stock"><?php echo e(translate('messages.total_stock')); ?></label>
                                        <input type="number" class="form-control" name="current_stock" min="0" id="quantity">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-sm-6 col-lg-4" id="maximum_cart_quantity">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="maximum_cart_quantity"><?php echo e(translate('messages.Maximum_Purchase_Quantity_Limit')); ?>

                                            <span
                                            class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="<?php echo e(translate('If_this_limit_is_exceeded,_customers_can_not_buy_the_item_in_a_single_purchase.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                        </label>
                                        <input type="number"  placeholder="<?php echo e(translate('messages.Ex:_10')); ?>"  class="form-control" name="maximum_cart_quantity" min="0" id="cart_quantity">
                                    </div>
                                </div>




                                <?php if($module_type == 'pharmacy'): ?>




                                <div class="col-sm-6" id="generic_name">
                                    <label class="input-label" for="sub-categories">
                                        <?php echo e(translate('generic_name')); ?>

                                        <span class="input-label-secondary" title="<?php echo e(translate('Specify the medicine`s active ingredient that makes it work')); ?>" data-toggle="tooltip">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <div class="dropdown suggestion_dropdown">
                                        <input type="text" class="form-control" placeholder="<?php echo e(translate('messages.Type your content here')); ?>"  name="generic_name" autocomplete="off">
                                        <?php if(count(\App\Models\GenericName::select(['generic_name'])->get())>0): ?>
                                        <div class="dropdown-menu">
                                            <?php $__currentLoopData = \App\Models\GenericName::select(['generic_name'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generic_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="dropdown-item"><?php echo e($generic_name->generic_name); ?></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php endif; ?>





                                <div class="col-sm-6 col-lg-4" id="organic">
                                    <div class="form-check mb-0 p-6">
                                        <input class="form-check-input" name="organic" type="checkbox" value="1" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          <?php echo e(translate('messages.is_organic')); ?>

                                        </label>
                                      </div>
                                </div>
                                <?php if($module_data['basic']): ?>
                                <div class="col-sm-3 col-lg-3" id="basic">
                                    <div class="form-check mb-0 p-6">
                                        <input class="form-check-input" name="basic" type="checkbox" value="1" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          <?php echo e(translate('messages.is_basic')); ?>

                                        </label>
                                      </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_type == 'pharmacy'): ?>
                                <div class="col-sm-3 col-lg-3" id="is_prescription_required">
                                    <div class="form-check mb-0 p-6">
                                        <input class="form-check-input" name="is_prescription_required" type="checkbox" value="1" id="flexCheckDefaultPrescription" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          <?php echo e(translate('messages.is_prescription_required')); ?>

                                        </label>
                                      </div>
                                </div>
                                <?php endif; ?>
                                <?php if($module_data['halal']): ?>
                                <div class="col-sm-6 col-lg-4" id="halal">
                                    <div class="form-check mb-0 p-6">
                                        <input class="form-check-input" name="is_halal" type="checkbox" value="1" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          <?php echo e(translate('messages.is_it_halal')); ?>

                                        </label>
                                      </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" id="food_variation_section">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header flex-wrap">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2">
                                    <i class="tio-canvas-text"></i>
                                </span>
                                <span><?php echo e(translate('messages.food_variations')); ?></span>
                            </h5>
                            <a class="btn text--primary-2" id="add_new_option_button">
                                <?php echo e(translate('add_new_variation')); ?>

                                <i class="tio-add"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Empty Variation -->
                            <div id="empty-variation">
                                <div class="text-center">
                                    <img src="<?php echo e(asset('assets/admin/img/variation.png')); ?>" alt="">
                                    <div><?php echo e(translate('No variation added')); ?></div>
                                </div>
                            </div>
                            <div id="add_new_option">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="attribute_section">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon"><i class="tio-canvas-text"></i></span>
                                <span><?php echo e(translate('attribute')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1"><?php echo e(translate('messages.attribute')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="attribute_id[]" id="choice_attributes"
                                            class="form-control js-select2-custom" multiple="multiple">
                                            <?php $__currentLoopData = \App\Models\Attribute::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($attribute['id']); ?>"><?php echo e($attribute['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <div class="customer_choice_options d-flex __gap-24px"
                                        id="customer_choice_options">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="variant_combination" id="variant_combination">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($module_data['add_on']): ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon"><i class="tio-puzzle"></i></span>
                                <span><?php echo e(translate('addons')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <?php if($module_data['add_on']): ?>
                                <div class="col-sm-12">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('messages.addon')); ?><span
                                                class="input-label-secondary"></span></label>
                                        <select name="addon_ids[]" id="addons" class="form-control js-select2-custom" multiple="multiple">
                                            <?php $__currentLoopData = \App\Models\AddOn::where('store_id', \App\CentralLogics\Helpers::get_store_id())->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($addon['id']); ?>"><?php echo e($addon['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>



                <?php if($productWiseTax): ?>
                    <div class="col-lg-12">
                        <div class="card shadow--card-2 border-0">
                        <div class="card-header flex-wrap">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2">
                                    <i class="tio-canvas-text"></i>
                                </span>
                                <span><?php echo e(translate('messages.Tax_Information')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                                <span class="mb-2 d-block title-clr fw-normal"><?php echo e(translate('Select Tax Rate')); ?></span>
                                <select name="tax_ids[]" required id="tax__rate" class="form-control js-select2-custom"
                                    multiple="multiple" placeholder="Type & Select Tax Rate">
                                    <?php $__currentLoopData = $taxVats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxVat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($taxVat->id); ?>"> <?php echo e($taxVat->name); ?>

                                            (<?php echo e($taxVat->tax_rate); ?>%)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon"><i class="tio-label"></i></span>
                                <span><?php echo e(translate('tags')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tags" placeholder="<?php echo e(translate('messages.search_tags')); ?>" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($module_data['item_available_time']): ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon"><i class="tio-date-range"></i></span>
                                <span><?php echo e(translate('available_time_schedule')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.available_time_starts')); ?></label>
                                        <input type="time" name="available_time_starts" class="form-control"
                                                placeholder="<?php echo e(translate('messages.Ex:')); ?> 10:30 am" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.available_time_ends')); ?></label>
                                        <input type="time" name="available_time_ends" class="form-control"  placeholder="<?php echo e(translate('messages.Ex:')); ?> 5:45 pm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('assets/admin')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(asset('assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin')); ?>/js/view-pages/vendor/product-index.js"></script>
<script>
    "use strict";

    mod_type="<?php echo e($module_type); ?>";

    $(document).ready(function() {
        $("#add_new_option_button").click(function(e) {
            $('#empty-variation').hide();
            count++;
            let add_option_view = `
                    <div class="__bg-F8F9FC-card view_new_option mb-2">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-check form--check">
                                    <input id="options[` + count + `][required]" name="options[` + count + `][required]" class="form-check-input" type="checkbox">
                                    <span class="form-check-label"><?php echo e(translate('Required')); ?></span>
                                </label>
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm delete_input_button"
                                        title="<?php echo e(translate('Delete')); ?>">
                                        <i class="tio-add-to-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-xl-4 col-lg-6">
                                    <label for=""><?php echo e(translate('name')); ?></label>
                                    <input required name=options[` + count +
                `][name] class="form-control new_option_name" type="text" data-count="`+
                count +`">
                                </div>

                                <div class="col-xl-4 col-lg-6">
                                    <div>
                                        <label class="input-label text-capitalize d-flex align-items-center"><span class="line--limit-1"><?php echo e(translate('messages.selcetion_type')); ?> </span>
                                        </label>
                                        <div class="resturant-type-group px-0">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input show_min_max" data-count="`+count+`" type="radio" value="multi"
                                                name="options[` + count + `][type]" id="type` + count +
                `" checked
                                                >
                                                <span class="form-check-label">
                                                    <?php echo e(translate('Multiple Selection')); ?>

                </span>
            </label>

            <label class="form-check form--check mr-2 mr-md-4">
                <input class="form-check-input hide_min_max" data-count="`+count+`" type="radio" value="single"
                    name="options[` + count + `][type]" id="type` + count +
                `"
                                                >
                                                <span class="form-check-label">
                                                    <?php echo e(translate('Single Selection')); ?>

                </span>
            </label>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-6">
    <div class="row g-2">
        <div class="col-6">
            <label for=""><?php echo e(translate('Min')); ?></label>
                                            <input id="min_max1_` + count + `" required  name="options[` + count + `][min]" class="form-control" type="number" min="1">
                                        </div>
                                        <div class="col-6">
                                            <label for=""><?php echo e(translate('Max')); ?></label>
                                            <input id="min_max2_` + count + `"   required name="options[` + count + `][max]" class="form-control" type="number" min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="option_price_` + count + `" >
                                <div class="bg-white border rounded p-3 pb-0 mt-3">
                                    <div  id="option_price_view_` + count + `">
                                        <div class="row g-3 add_new_view_row_class mb-3">
                                            <div class="col-md-4 col-sm-6">
                                                <label for=""><?php echo e(translate('Option_name')); ?></label>
                                                <input class="form-control" required type="text" name="options[` +
                count +
                `][values][0][label]" id="">
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <label for=""><?php echo e(translate('Additional_price')); ?></label>
                                                <input class="form-control" required type="number" min="0" step="0.01" name="options[` +
                count + `][values][0][optionPrice]" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 p-3 mr-1 d-flex "  id="add_new_button_` + count +
                `">
                                        <button type="button" class="btn btn--primary btn-outline-primary add_new_row_button" data-count="`+
                count +`"><?php echo e(translate('Add_New_Option')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

            $("#add_new_option").append(add_option_view);
        });

        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function() {
            let select2 = $.HSCore.components.HSSelect2.init($(this));
        });
    });

    function add_new_row_button(data) {
        count = data;
        countRow = 1 + $('#option_price_view_' + data).children('.add_new_view_row_class').length;
        let add_new_row_view = `
            <div class="row add_new_view_row_class mb-3 position-relative pt-3 pt-sm-0">
                <div class="col-md-4 col-sm-5">
                        <label for=""><?php echo e(translate('Option_name')); ?></label>
                        <input class="form-control" required type="text" name="options[` + count + `][values][` +
            countRow + `][label]" id="">
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for=""><?php echo e(translate('Additional_price')); ?></label>
                        <input class="form-control"  required type="number" min="0" step="0.01" name="options[` +
            count +
            `][values][` + countRow + `][optionPrice]" id="">
                    </div>
                    <div class="col-sm-2 max-sm-absolute">
                        <label class="d-none d-sm-block">&nbsp;</label>
                        <div class="mt-1">
                            <button type="button" class="btn btn-danger btn-sm deleteRow"
                                title="<?php echo e(translate('Delete')); ?>">
                                <i class="tio-add-to-trash"></i>
                            </button>
                        </div>
                </div>
            </div>`;
        $('#option_price_view_' + data).append(add_new_row_view);

    }

    function add_more_customer_choice_option(i, name) {
        let n = name;

        $('#customer_choice_options').append(
            `<div class="__choos-item"><div><input type="hidden" name="choice_no[]" value="${i}"><input type="text" class="form-control d-none" name="choice[]" value="${n}" placeholder="<?php echo e(translate('messages.choice_title')); ?>" readonly> <label class="form-label">${n}</label> </div><div><input type="text" class="form-control combination_update" name="choice_options_${i}[]" placeholder="<?php echo e(translate('messages.enter_choice_values')); ?>" data-role="tagsinput"></div></div>`
        );
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    }

    function combination_update() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '<?php echo e(route('vendor.item.variant-combination')); ?>',
            data: $('#item_form').serialize()+'&stock=<?php echo e($module_data['stock']); ?>',
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#loading').hide();
                $('#variant_combination').html(data.view);
                if (data.length < 1) {
                    $('input[name="current_stock"]').attr("readonly", false);
                }
            }
        });
    }

    // $('#item_form').on('keydown', function(e) {
    //         if (e.key === 'Enter') {
    //         e.preventDefault(); // Prevent submission on Enter
    //         }
    //     });

    $('#item_form').on('submit', function () {
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('vendor.item.store')); ?>',
            data: $('#item_form').serialize(),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#loading').hide();
                if (data.errors) {
                    for (let i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                }
                if(data.product_approval){
                        toastr.success(data.product_approval, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                    location.href = '<?php echo e(route('vendor.item.pending_item_list')); ?>';
                    }, 2000);
                }
                if(data.success) {
                    toastr.success(data.success, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.href = '<?php echo e(route('vendor.item.list')); ?>';
                    }, 2000);
                }
            }
        });
    });

    $(function() {
        $("#coba").spartanMultiImagePicker({
            fieldName: 'item_images[]',
            maxCount: 5,
            rowHeight: '100px !important',
            groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
            maxFileSize: '',
            placeholderImage: {
                image: "<?php echo e(asset('assets/admin/img/upload.png')); ?>",
                width: '100px'
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

            },
            onExtensionErr: function(index, file) {
                toastr.error(
                    "<?php echo e(translate('messages.please_only_input_png_or_jpg_type_file')); ?>", {
                        CloseButton: true,
                        ProgressBar: true
                    });
            },
            onSizeErr: function(index, file) {
                toastr.error("<?php echo e(translate('messages.file_size_too_big')); ?>", {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });
    });

    $('#reset_btn').click(function(){
            $('#category_id').val(null).trigger('change');
            $('#sub-categories').val(null).trigger('change');
            $('#unit').val(null).trigger('change');
            $('#veg').val(0).trigger('change');
            $('#addons').val(null).trigger('change');
            $('#discount_type').val(null).trigger('change');
            $('#choice_attributes').val(null).trigger('change');
            $('#customer_choice_options').empty().trigger('change');
            $('#variant_combination').empty().trigger('change');
            $('#viewer').attr('src', "<?php echo e(asset('assets/admin/img/upload.png')); ?>");
            $("#coba").empty().spartanMultiImagePicker({
            fieldName: 'item_images[]',
            maxCount: 6,
            rowHeight: '120px',
            groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
            maxFileSize: '',
            placeholderImage: {
                image: "<?php echo e(asset('assets/admin/img/400x400/img2.jpg')); ?>",
                width: '100%'
            },
            dropFileLabel: "Drop Here",
            onAddRow: function (index, file) {

            },
            onRenderedPreview: function (index) {

            },
            onRemoveRow: function (index) {

            },
            onExtensionErr: function (index, file) {
                toastr.error("<?php echo e(translate('messages.please_only_input_png_or_jpg_type_file')); ?>", {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function (index, file) {
                toastr.error("<?php echo e(translate('messages.file_size_too_big')); ?>", {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });
    })
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Admin\resources\views/vendor-views/product/index.blade.php ENDPATH**/ ?>