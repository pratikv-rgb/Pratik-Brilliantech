<?php $__env->startSection('title',translate('POS Orders')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 0;
        }

    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg-default mt-1">
		<div class="content container-fluid">
			<div class="d-flex flex-wrap">
				<div class="order--pos-left">
                    <div class="card h-100">
                        <div class="card-header bg-light border-0">
                            <h5 class="card-title">
                                <span>
                                    <?php echo e(translate('product_section')); ?>

                                </span>
                            </h5>
                        </div>

                        <div class="card-body d-flex flex-column" id="items">
                            <div class="mb-4">
                                <div class="row g-2 justify-content-around">
                                    <div class="col-sm-6 col-12">
                                        <select name="store_id" id="store_select"
                                                data-url="<?php echo e(url()->full()); ?>"
                                                data-filter="store_id"
                                                data-placeholder="<?php echo e(translate('messages.select_store')); ?>" class="js-data-example-ajax form-control h--45px set-filter">
                                            <?php if($store): ?>
                                            <option value="<?php echo e($store->id); ?>" selected><?php echo e($store->name); ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <select name="category" id="category" class="form-control js-select2-custom mx-1 set-filter"
                                                data-url="<?php echo e(url()->full()); ?>"
                                                data-filter="category_id"
                                                title="<?php echo e(translate('messages.select_category')); ?>" disabled>
                                            <option value=""><?php echo e(translate('messages.all_categories')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>" <?php echo e($category==$item->id?'selected':''); ?>><?php echo e(Str::limit($item->name,20 ,'...')); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <form id="search-form" class="search-form">
                                            <!-- Search -->
                                            <div class="position-relative">
                                                <input id="datatableSearch" type="search" value="<?php echo e($keyword??''); ?>" name="keyword" class="form-control h--45px pl-5" placeholder="<?php echo e(translate('messages.Search_by_product_name')); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>" disabled>
                                                <img width="16" height="16" src="<?php echo e(asset('assets/admin/img/icons/search-icon.png')); ?>" alt="" class="search-icon">

                                                
                                            </div>
                                            <!-- End Search -->
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-auto" id="single-list">
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
                            </div>
                            <?php if(count($products)===0): ?>
                                <div class="search--no-found">
                                    <img src="<?php echo e(asset('assets/admin/img/search-icon.png')); ?>" alt="img">
                                    <p>
                                        <?php echo e(translate('messages.no_products_on_pos_search')); ?>

                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer border-0">
                            <?php echo $products->withQueryString()->links(); ?>

                        </div>
                    </div>
				</div>
				<div class="order--pos-right">
                    <div class="card h-100">
                        <div class="card-header bg-light border-0">
                            <h5 class="card-title">
                                <span>
                                    <?php echo e(translate('billing_section')); ?>

                                </span>
                            </h5>
                        </div>
                        <?php
                        $customer= session('customer') ?? null;
                        ?>
                        <div class="card-body p-0">
                            <div class="d-flex flex-wrap p-3 add--customer-btn">
                                <select id="customer" name="customer_id"
                                    data-placeholder="<?php echo e(translate('messages.select_customer')); ?>"
                                    class="js-data-example-ajax form-control">
                                    <?php if(isset($customer)): ?>
                                    <option selected value="<?php echo e($customer->id); ?>"><?php echo e($customer->f_name.' '.$customer->l_name); ?> (<?php echo e($customer->phone); ?>)</option>
                                    <?php endif; ?>
                                </select>
                                <button class="btn btn--primary rounded font-regular" id="add_new_customer"
                                    type="button" data-toggle="modal" data-target="#add-customer"
                                    title="Add Customer">
                                    <?php echo e(translate('Add new customer')); ?>

                                </button>
                            </div>






                            <div id="customer_data" class="<?php echo e(isset($customer) ? '': 'd-none'); ?> ">
                                <!-- Card -->
                                <div class="p-2">
                                    <div class="p-2 rounded bg--secondary">
                                        <div class="media align-items-center customer--information-single" href="javascript:">
                                            <div class="avatar avatar-circle">
                                                <img class="avatar-img onerror-image" id=customer_image src="<?php echo e(isset($customer) ? $customer->image_full_url : ''); ?>"
                                                    alt="Image Description">
                                            </div>
                                            <div class="media-body">
                                                <ul class="list-unstyled m-0">
                                                    <li class="pb-1">
                                                    <h4> <span id="customer_name" class="text--primary"><?php echo e(isset($customer) ? $customer->f_name . ' ' . $customer->l_name : ''); ?></span>, <small id="customer_phone"><?php echo e(isset($customer) ? $customer->phone : ''); ?></small></h4>
                                                    </li>
                                                    <li>
                                                    <?php echo e(translate('messages.Wallet')); ?> : <strong class="text-dark" id="customer_wallet" ><?php echo e(isset($customer) ?  \App\CentralLogics\Helpers::format_currency($customer->wallet_balance) : ''); ?></strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>








                            <div class="pos--delivery-options">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="card-title d-flex align-items-center gap-2">
                                        <span class="card-title-icon">
                                            <i class="tio-user"></i>
                                        </span>
                                        <span><?php echo e(translate('Delivery Information')); ?> <small>(<?php echo e(translate('Home Delivery')); ?>)</small></span>
                                    </h5>
                                    <span class="delivery--edit-icon text-primary" id="delivery_address" data-toggle="modal" data-target="#deliveryAddrModal"><i class="tio-edit"></i></span>
                                </div>
                                <div class="pos--delivery-options-info d-flex flex-wrap" id="del-add">
                                    <?php echo $__env->make('admin-views.pos._address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                            <div class='w-100' id="cart">
                                <?php echo $__env->make('admin-views.pos._cart',['store'=>$store], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-view-modal">

            </div>
        </div>
    </div>


    
    <div class="modal fade" id="print-invoice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(translate('messages.print_invoice')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row ff-emoji">
                    <div class="col-md-12">
                        <div class="text-center">
                            <input type="button" class="btn btn--primary non-printable text-white print-Div"
                                value="<?php echo e(translate('Proceed, If thermal printer is ready.')); ?>"/>
                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger non-printable"><?php echo e(translate('messages.back')); ?></a>
                        </div>
                        <hr class="non-printable">
                    </div>
                    <div class="row m-auto" id="print-modal-content"></div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="add-customer" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(translate('add_new_customer')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.pos.customer-store')); ?>" method="post" id="product_form"
                          >
                        <?php echo csrf_field(); ?>
                        <div class="row" >
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="f_name" class="input-label" ><?php echo e(translate('first_name')); ?> <span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input id="f_name" type="text" name="f_name" class="form-control" value="<?php echo e(old('f_name')); ?>"  placeholder="<?php echo e(translate('first_name')); ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="l_name" class="input-label" ><?php echo e(translate('last_name')); ?> <span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input id="l_name" type="text" name="l_name" class="form-control" value="<?php echo e(old('l_name')); ?>"  placeholder="<?php echo e(translate('last_name')); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="input-label" ><?php echo e(translate('email')); ?><span
                                        class="input-label-secondary text-danger">*</span></label>
                                    <input id="email" type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>"  placeholder="<?php echo e(translate('Ex_:_ex@example.com')); ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="phone" class="input-label" ><?php echo e(translate('phone')); ?> (<?php echo e(translate('with_country_code')); ?>)<span
                                        class="input-label-secondary text-danger">*</span></label>
                                    <input id="phone" type="tel" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>"  placeholder="<?php echo e(translate('phone')); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="btn--container justify-content-end">
                            <button type="reset" class="btn btn--reset"><?php echo e(translate('reset')); ?></button>
                            <button type="submit" id="submit_new_customer" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&libraries=places&callback=initMap&v=3.49">
</script>
<script src="<?php echo e(asset('assets/admin/js/view-pages/pos.js')); ?>"></script>

<script>
    "use strict";
    $(document).on('click', '.place-order-submit', function (event) {
        event.preventDefault();
        let customer_id = document.getElementById('customer');
        if(customer_id.value)
        {
            document.getElementById('customer_id').value = customer_id.value;
            let form = document.getElementById('order_place');
            form.submit();
        } else{
            toastr.error('<?php echo e(translate('messages.customer_not_selected')); ?>', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    });


    function initMap() {
        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: {
                lat: <?php echo e($store ? $store['latitude'] : '23.757989'); ?>,
                lng: <?php echo e($store ? $store['longitude'] : '90.360587'); ?>

            }
        });

        let zonePolygon = null;

        //get current location block
        let infoWindow = new google.maps.InfoWindow();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                   let myLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    infoWindow.setPosition(myLatlng);
                    infoWindow.setContent("Location found.");
                    infoWindow.open(map);
                    map.setCenter(myLatlng);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        //-----end block------
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
        let markers = [];
        const bounds = new google.maps.LatLngBounds();
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length === 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                if(!google.maps.geometry.poly.containsLocation(
                    place.geometry.location,
                    zonePolygon
                )){
                    toastr.error('<?php echo e(translate('messages.out_of_coverage')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    return false;
                }

                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();

                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        <?php if($store): ?>
            $.get({
                url: '<?php echo e(url('/')); ?>/admin/zone/get-coordinates/<?php echo e($store->zone_id); ?>',
                dataType: 'json',
                success: function(data) {
                    zonePolygon = new google.maps.Polygon({
                        paths: data.coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'white',
                        fillOpacity: 0,
                    });
                    zonePolygon.setMap(map);
                    zonePolygon.getPaths().forEach(function(path) {
                        path.forEach(function(latlng) {
                            bounds.extend(latlng);
                            map.fitBounds(bounds);
                        });
                    });
                    map.setCenter(data.center);
                    google.maps.event.addListener(zonePolygon, 'click', function(mapsMouseEvent) {
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                                2),
                        });
                        let coordinates;

                         coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                         coordinates = JSON.parse(coordinates);

                        document.getElementById('latitude').value = coordinates['lat'];
                        document.getElementById('longitude').value = coordinates['lng'];
                        infoWindow.open(map);

                        let geocoder;
                        geocoder = new google.maps.Geocoder();
                        let latlng = new google.maps.LatLng( coordinates['lat'], coordinates['lng'] ) ;

                        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                            if (status === google.maps.GeocoderStatus.OK) {
                                if (results[1]) {
                                    let address = results[1].formatted_address;
                                    // initialize services
                                    const geocoder = new google.maps.Geocoder();
                                    const service = new google.maps.DistanceMatrixService();
                                    // build request
                                    const origin1 = { lat: <?php echo e($store['latitude']); ?>, lng: <?php echo e($store['longitude']); ?> };
                                    const origin2 = "<?php echo e($store->address); ?>";
                                    const destinationA = address;
                                    const destinationB = { lat: coordinates['lat'], lng: coordinates['lng'] };
                                    const request = {
                                        origins: [origin1, origin2],
                                        destinations: [destinationA, destinationB],
                                        travelMode: google.maps.TravelMode.DRIVING,
                                        unitSystem: google.maps.UnitSystem.METRIC,
                                        avoidHighways: false,
                                        avoidTolls: false,
                                    };

                                    // get distance matrix response
                                    service.getDistanceMatrix(request).then((response) => {
                                        // put response
                                        let distancMeter = response.rows[0].elements[0].distance['value'];
                                        let distanceMile = distancMeter/1000;
                                        let distancMileResult = Math.round((distanceMile + Number.EPSILON) * 100) / 100;
                                        document.getElementById('distance').value = distancMileResult;
                                        document.getElementById('address').value =response.destinationAddresses[1];
                                        <?php
                                        $module_wise_delivery_charge = $store->zone->modules()->where('modules.id', $store->module_id)->first();
                                        if($store->sub_self_delivery ){
                                                $per_km_shipping_charge = $store?->per_km_shipping_charge ?? 0;
                                                $minimum_shipping_charge = $store?->minimum_shipping_charge ?? 0;
                                                $maximum_shipping_charge = $store?->maximum_shipping_charge?? 0;

                                                $self_delivery_status = 1;
                                        } else{
                                                $self_delivery_status = 0;

                                            if ($module_wise_delivery_charge) {
                                                $per_km_shipping_charge = $module_wise_delivery_charge->pivot->per_km_shipping_charge;
                                                $minimum_shipping_charge = $module_wise_delivery_charge->pivot->minimum_shipping_charge;
                                                $maximum_shipping_charge = $module_wise_delivery_charge->pivot->maximum_shipping_charge??0;

                                            } else {
                                                $per_km_shipping_charge = (float)\App\Models\BusinessSetting::where(['key' => 'per_km_shipping_charge'])->first()->value;
                                                $minimum_shipping_charge = (float)\App\Models\BusinessSetting::where(['key' => 'minimum_shipping_charge'])->first()->value;
                                                $maximum_shipping_charge = 0;
                                            }
                                        }


                                        ?>

                                        $.get({
                                                url: '<?php echo e(route('admin.pos.extra_charge')); ?>',
                                                dataType: 'json',
                                                data: {
                                                    distancMileResult: distancMileResult,
                                                    self_delivery_status: <?php echo e($self_delivery_status); ?>,
                                                },
                                                success: function(data) {
                                                 let   extra_charge = data;
                                                    let original_delivery_charge =  (distancMileResult * <?php echo e($per_km_shipping_charge); ?> > <?php echo e($minimum_shipping_charge); ?>) ? distancMileResult * <?php echo e($per_km_shipping_charge); ?> : <?php echo e($minimum_shipping_charge); ?>;
                                                    let delivery_amount = (<?php echo e($maximum_shipping_charge); ?> > <?php echo e($minimum_shipping_charge); ?> && original_delivery_charge + extra_charge > <?php echo e($maximum_shipping_charge); ?> ? <?php echo e($maximum_shipping_charge); ?> : original_delivery_charge + extra_charge);
                                                    let delivery_charge =Math.round(( delivery_amount + Number.EPSILON) * 100) / 100;
                                                document.getElementById('delivery_fee').value = delivery_charge;
                                                $('#delivery_fee').siblings('strong').html(delivery_charge + '<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>');

                                                },
                                                error:function(){
                                                    let original_delivery_charge =  (distancMileResult * <?php echo e($per_km_shipping_charge); ?> > <?php echo e($minimum_shipping_charge); ?>) ? distancMileResult * <?php echo e($per_km_shipping_charge); ?> : <?php echo e($minimum_shipping_charge); ?>;

                                                    let delivery_charge =Math.round((
                                                (<?php echo e($maximum_shipping_charge); ?> > <?php echo e($minimum_shipping_charge); ?> && original_delivery_charge  > <?php echo e($maximum_shipping_charge); ?> ? <?php echo e($maximum_shipping_charge); ?> : original_delivery_charge)
                                                + Number.EPSILON) * 100) / 100;
                                                document.getElementById('delivery_fee').value = delivery_charge;
                                                $('#delivery_fee').siblings('strong').html(delivery_charge + '<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>');
                                                }
                                            });

                                    });

                                }
                            }
                        });
                    });
                },
            });
        <?php endif; ?>

    }


    $(document).on('ready', function () {
        $('#store_select').select2({
            ajax: {
                url: '<?php echo e(url('/')); ?>/admin/store/get-stores',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        module_id:<?php echo e(Config::get('module.current_module_id')); ?>,
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                    results: data
                    };
                },
                __port: function (params, success, failure) {
                    let $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });
    });



    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        let keyword= $('#datatableSearch').val();
        let url = new URL('<?php echo url()->full(); ?>');
        url.searchParams.set('keyword', keyword);
        location.href = url;
    });

    $(document).on('click', '.quick-View', function () {
        $.get({
            url: '<?php echo e(route('admin.pos.quick-view')); ?>',
            dataType: 'json',
            data: {
                product_id: $(this).data('id')
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                // $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function () {
                // $('#loading').hide();
            },
        });
        // check_stock();
    });



    $(document).on('click', '.quick-View-Cart-Item', function () {
        $.get({
            url: '<?php echo e(route('admin.pos.quick-view-cart-item')); ?>',
            dataType: 'json',
            data: {
                product_id:  $(this).data('product-id'),
                item_key:  $(this).data('item-key'),
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    });


    function checkAddToCartValidity() {
        let names = {};
        $('#add-to-cart-form input:radio').each(function () {
            names[$(this).attr('name')] = true;
        });
        let count = 0;
        $.each(names, function () {
            count++;
        });
        if ($('input:radio:checked').length === count) {
            return true;
        }
        return true;
    }

    function checkStore() {
        let module_id = <?php echo e(Config::get('module.current_module_id')); ?>;
        let store_id = getUrlParameter('store_id');
        if(module_id && store_id){
            $('#category').prop("disabled", false);
            $('#datatableSearch').prop("disabled", false);
        }
    }

    checkStore();

    function getVariantPrice() {
        if ($('#add-to-cart-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
            // alert(1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('admin.pos.variant_price')); ?>',
                    data: $('#add-to-cart-form').serializeArray(),
                    success: function(data) {
                        if(data.error === 'quantity_error'){
                            toastr.error(data.message);
                        }
                            else{
                            $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                            $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                        }
                    }
                });
        }
    }


    $(document).on('click', '.add-To-Cart', function () {

        if (checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           let form_id = 'add-to-cart-form'
            $.post({
                url: '<?php echo e(route('admin.pos.add-to-cart')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.data === 1) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            text: "<?php echo e(translate('messages.product_already_added_in_cart')); ?>"
                        });
                        return false;
                    }
                    else if (data.data === 2) {
                        updateCart();
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            text: "<?php echo e(translate('messages.product_has_been_updated_in_cart')); ?>"
                        });

                        return false;
                    }
                    else if (data.data === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: '<?php echo e(translate("Sorry, product out of stock")); ?>.'
                        });
                        return false;
                    }
                    else if (data.data === -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: '<?php echo e(translate("Sorry, you can not add multiple stores data in same cart")); ?>.'
                        });
                        return false;
                    }
                    else if (data.data === 'variation_error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            text: data.message
                        });
                        return false;
                    }
                    $('.call-when-done').click();

                    toastr.success('<?php echo e(translate('messages.product_has_been_added_in_cart')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });

                    updateCart();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        } else {
            Swal.fire({
                type: 'info',
                title: '<?php echo e(translate('Cart')); ?>',
                text: '<?php echo e(translate("Please choose all the options")); ?>'
            });
        }

    });



    $(document).on('click', '.check-stock', function () {
        check_stock();
    });


    function check_stock(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           let form_id = 'add-to-cart-form'
            $.post({
                url: '<?php echo e(route('admin.pos.item_stock_view')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    // $('#loading').show();
                },
                success: function (data) {


                    $('#add-to-cart-form input[name=quantity]').empty()
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
            },
                complete: function () {
                    $('#loading').hide();
                }
            });
    }



    $(document).on('click', '.item-stock-view-update', function () {
        item_stock_view_update();
    });


    function item_stock_view_update(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
           let form_id = 'add-to-cart-form'
            $.post({
                url: '<?php echo e(route('admin.pos.item_stock_view_update')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    // $('#loading').show();
                },
                success: function (data) {
                    $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
                complete: function () {
                    $('#loading').hide();
                }
            });
    }

    $(document).on('click', '.delivery-Address-Store', function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        let form_id = 'delivery_address_store';
        $.post({
            url: '<?php echo e(route('admin.pos.add-delivery-address')); ?>',
            data: $('#' + form_id).serializeArray(),
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                if (data.errors) {
                    for (let i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    $('#del-add').empty().html(data.view);
                }
                updateCart();
                $('.call-when-done').click();
            },
            complete: function() {
                $('#loading').hide();
                $('#deliveryAddrModal').modal('hide');
            }
        });



    });

    $(document).on('click', '.remove-From-Cart', function () {
      let key=  $(this).data('product-id')
        $.post('<?php echo e(route('admin.pos.remove-from-cart')); ?>', {_token: '<?php echo e(csrf_token()); ?>', key: key}, function (data) {
            if (data.errors) {
                for (let i = 0; i < data.errors.length; i++) {
                    toastr.error(data.errors[i].message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            } else {
                updateCart();
                toastr.info('<?php echo e(translate('messages.item_has_been_removed_from_cart')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }

        });
    });

    $(document).on('click', '.empty-Cart', function () {
            $.post('<?php echo e(route('admin.pos.emptyCart')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>'
            }, function() {
                $('#del-add').empty();
                updateCart();
                toastr.info('<?php echo e(translate('messages.item_has_been_removed_from_cart')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            });
    });


    function updateCart() {
        $.post('<?php echo e(route('admin.pos.cart_items')); ?>?store_id=<?php echo e(request()?->store_id); ?>', {_token: '<?php echo e(csrf_token()); ?>'}, function (data) {
            $('#cart').empty().html(data);
        });
        $.post('<?php echo e(route('admin.pos.single_items')); ?>' + window.location.search, {_token: '<?php echo e(csrf_token()); ?>'}, function(data) {
            $('#single-list').empty().html(data);
        });
    }


   $(function(){
        $(document).on('click','input[type=number]',function(){ this.select(); });
    });


    $(document).on('change', '.update-Quantity', function (event) {

        let element = $( event.target );
        let minValue = parseInt(element.attr('min'));
        let maxValue = parseInt(element.attr('max'));
        let valueCurrent = parseInt(element.val());

        let key = element.data('key');

    if (valueCurrent >= minValue && valueCurrent <= maxValue) {
    $.post('<?php echo e(route('admin.pos.updateQuantity')); ?>', {_token: '<?php echo e(csrf_token()); ?>', key: key, quantity:valueCurrent}, function () {
                updateCart();
            });
        } else if(valueCurrent > maxValue){
            Swal.fire({
                icon: 'error',
                title: 'Cart',
                text: 'Sorry, cart limit exceeded.'
            });
            element.val(element.data('oldvalue'));
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Cart',
                text: '<?php echo e(translate('Sorry, the minimum value was reached')); ?>'
            });
            element.val(element.data('oldvalue'));
        }


        // Allow: backspace, delete, tab, escape, enter and .
        if(event.type === 'keydown')
        {
            if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (event.keyCode === 65 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        }

    });


    $('#customer').select2({
        ajax: {
            url: '<?php echo e(route('admin.pos.customers')); ?>',
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            __port: function (params, success, failure) {
                let $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    function print_invoice(order_id) {
        $.get({
            url: '<?php echo e(url('/')); ?>/admin/pos/invoice/'+order_id,
            dataType: 'json',
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                $('#print-invoice').modal('show');
                $('#print-modal-content').empty().html(data.view);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
    <?php if(session('last_order')): ?>
    $(document).on('ready', function() {
            $('#print-invoice').modal('show');
        });
    print_invoice("<?php echo e(session('last_order')); ?>")
    <?php (session(['last_order'=> false])); ?>
    <?php endif; ?>

    $('.location-reload-to-base-pos').on('click', function() {
    const url = $(this).data('url');
    let nurl = new URL(url);
    nurl.searchParams.delete('keyword');
    location.href = nurl;
});

        $( "#customer" ).change(function() {
            if($(this).val())
            {
                $('#customer_id').val($(this).val());
                $.get({
                url: '<?php echo e(route('admin.pos.getUserData')); ?>',
                dataType: 'json',
                data: {
                    customer_id: $(this).val()
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#customer_name').text(data.customer_name );
                    $('#customer_phone').text(data.customer_phone );
                    $('#customer_wallet').text(data.customer_wallet );
                    $('#customer_image').attr('src', data.customer_image);
                    $('#customer_data').removeClass('d-none');
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
            }
        });


        document.querySelectorAll('[name="keyword"]').forEach(function(element) {
            element.addEventListener('input', function(event) {
                const urlParams = new URLSearchParams(window.location.search);
                if (this.value === "" && urlParams.has('keyword')) {
                        var nurl = new URL('<?php echo url()->full(); ?>');
                        nurl.searchParams.delete("keyword");
                        location.href = nurl;
                }
            });
        });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Admin\resources\views/admin-views/pos/index.blade.php ENDPATH**/ ?>