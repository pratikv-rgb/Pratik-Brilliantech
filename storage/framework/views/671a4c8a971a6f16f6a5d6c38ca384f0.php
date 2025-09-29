<!DOCTYPE html>
<?php

$country=\App\Models\BusinessSetting::where('key','country')->first();
$countryCode= strtolower($country?$country->value:'auto');
?>
<html dir="<?php echo e(session()->get('site_direction')); ?>" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e(session()->get('site_direction') === 'rtl'?'active':''); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Title -->
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Favicon -->
    <?php ($logo=\App\Models\BusinessSetting::where(['key'=>'icon'])->first()); ?>
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/x-icon" href="<?php echo e(\App\CentralLogics\Helpers::get_full_url('business', $logo?->value?? '', $logo?->storage[0]?->value ?? 'public','favicon')); ?>">
    <!-- Font -->
    <link href="<?php echo e(asset('assets/admin/css/fonts.css')); ?>" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/vendor/icon-set/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/owl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/theme.minc619.css?v=1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-tour-standalone.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/emogi-area.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/style.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/intltelinput/css/intlTelInput.css')); ?>">

    <?php echo $__env->yieldPushContent('css_or_js'); ?>

    <script src="<?php echo e(asset('assets/admin/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/toastr.css')); ?>">
</head>

<body class="footer-offset">
    <?php if(env('APP_MODE')=='demo'): ?>
        <div class="direction-toggle">
            <i class="tio-settings"></i>
            <span></span>
        </div>
    <?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" class="initial-hidden">
                <div class="loader--inner">
                    <img width="200" src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!isset($module_type)): ?>
<?php ($module_type = Config::get('module.current_module_type')); ?>
<?php endif; ?>

<!-- Builder -->
<?php echo $__env->make('layouts.admin.partials._front-settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Builder -->

<!-- JS Preview mode only -->
<?php echo $__env->make('layouts.admin.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(Request::is('admin/payment/configuration*') || Request::is('admin/sms/configuration*') || Request::is('taxvat/*')): ?>
<?php ($module_type = 'settings'); ?>
<?php endif; ?>

    <?php if($module_type == 'rental'): ?>
        <?php echo $__env->make("rental::admin.partials._sidebar_{$module_type}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make("layouts.admin.partials._sidebar_{$module_type}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<!-- END ONLY DEV -->

<main id="content" role="main" class="main pointer-event">
    <!-- Content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- End Content -->

    <!-- Footer -->
<?php echo $__env->make('layouts.admin.partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- End Footer -->

    <div class="modal fade" id="popup-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="update_notification_text">
                                    <i class="tio-shopping-cart-outlined"></i> <?php echo e(translate('messages.You have new order, Check Please.')); ?>

                                </h2>
                                <hr>
                                <button class="btn btn-primary check-order"><?php echo e(translate('messages.Ok, let me check')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="toggle-modal">
        <div class="modal-dialog status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <img id="toggle-image" alt="" class="mb-20">
                                <h5 class="modal-title" id="toggle-title"></h5>
                            </div>
                            <div class="text-center" id="toggle-message">
                            </div>
                        </div>
                        <div class="btn--container justify-content-center">
                            <button type="button" id="toggle-ok-button" class="btn btn--primary min-w-120 confirm-Toggle" data-dismiss="modal" ><?php echo e(translate('Ok')); ?></button>
                            <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                <?php echo e(translate("Cancel")); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="toggle-status-modal">
        <div class="modal-dialog status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <img id="toggle-status-image" alt="" class="mb-20">
                                <h5 class="modal-title" id="toggle-status-title"></h5>
                            </div>
                            <div class="text-center" id="toggle-status-message">
                            </div>
                        </div>
                        <div class="btn--container justify-content-center">
                            <button type="button" id="toggle-status-ok-button" class="btn btn--primary min-w-120 confirm-Status-Toggle" data-dismiss="modal" ><?php echo e(translate('Ok')); ?></button>
                            <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                <?php echo e(translate("Cancel")); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="instruction-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close instruction-Modal-Close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0sus46BflpU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="email-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close email-Modal-Close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_BIHsClZtOE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                      </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="new-dynamic-submit-model">
        <div class="modal-dialog modal-dialog-centered status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <img id="image-src" class="mb-20">
                                <h5 class="modal-title" id="toggle-title"></h5>
                            </div>
                            <div class="text-center" id="toggle-message">
                                <h3 id="modal-title"></h3>
                                <div id="modal-text"></div>
                            </div>

                            </div>
                            <div class="mb-4 d-none" id="note-data">
                                <textarea class="form-control" placeholder="<?php echo e(translate('your_note_here')); ?>" id="get-text-note" cols="5" ></textarea>
                            </div>
                        <div class="btn--container justify-content-center">
                            <div id="hide-buttons">
                                <div class="d-flex justify-content-center flex-wrap gap-3">
                                    <button data-dismiss="modal" id="cancel6_btn_text" class="btn btn--cancel min-w-120" ><?php echo e(translate("Not_Now")); ?></button>
                                    <button type="button" id="new-dynamic-ok-button" class="btn btn-primary confirm-model min-w-120"><?php echo e(translate('Yes')); ?></button>
                                </div>
                            </div>

                            <button data-dismiss="modal"  type="button" id="new-dynamic-ok-button-show" class="btn btn--primary  d-none min-w-120"><?php echo e(translate('Okay')); ?></button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
$current_module_type_for_search = null;
if(in_array(config('module.current_module_type'),config('module.module_type') )){
    $current_module_type_for_search = config('module.current_module_type');
}
?>


<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->
<script src="<?php echo e(asset('assets/admin')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/firebase.min.js"></script>
<!-- JS Implementing Plugins -->

<?php echo $__env->yieldPushContent('script'); ?>
<!-- JS Front -->

<script src="<?php echo e(asset('assets/admin')); ?>/js/vendor.min.js"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/sweet_alert.js"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/bootstrap-tour-standalone.min.js"></script>
<script src="<?php echo e(asset('assets/admin/js/owl.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/emogi-area.js"></script>
<script src="<?php echo e(asset('assets/admin')); ?>/js/toastr.js"></script>
<script src="<?php echo e(asset('assets/admin/js/app-blade/admin.js')); ?>"></script>


<?php echo Toastr::message(); ?>


<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e(translate($error)); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>
<!-- JS Plugins Init. -->


<?php echo $__env->yieldPushContent('script_2'); ?>
<script>
    let baseUrl = '<?php echo e(url('/')); ?>';
</script>

<script src="<?php echo e(asset('assets/admin/js/view-pages/common.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/keyword-highlighted.js')); ?>"></script>
<audio id="myAudio">
    <source src="<?php echo e(asset('assets/admin/sound/notification.mp3')); ?>" type="audio/mpeg">
</audio>
<script>
    var audio = document.getElementById("myAudio");
    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
"use strict";


    <?php ($modules = \App\Models\Module::Active()->get()); ?>

    <?php if(isset($modules) && ($modules->count()<1)): ?>
    $('#instruction-modal').show();
    <?php endif; ?>



    $('.restart-Tour').on('click',function (){
        <?php if(isset($modules) && ($modules->count()>0)): ?>
            tour.restart();
            $('body').css('overflow','hidden')
        <?php endif; ?>
    });


    $('.log-out').on('click',function (){

        Swal.fire({
            title: '<?php echo e(translate('Do you want to logout?')); ?>',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonColor: '#FC6A57',
            cancelButtonColor: '#363636',
            confirmButtonText: `<?php echo e(translate('yes')); ?>`,
            cancelButtonText: `<?php echo e(translate('Do_not_Logout')); ?>`,
            }).then((result) => {
            if (result.value) {
            location.href='<?php echo e(route('logout')); ?>';
            } else{
            Swal.fire('<?php echo e(translate('messages.canceled')); ?>', '', 'info')
            }
        })

    });


    function route_alert(route, message, title="<?php echo e(translate('messages.are_you_sure')); ?>") {
        Swal.fire({
            title: title,
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
            confirmButtonText: '<?php echo e(translate('messages.Yes')); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = route;
            }
        })
    }

    $('.form-alert').on('click',function (){
        let id = $(this).data('id')
        let message = $(this).data('message')
        Swal.fire({
            title: '<?php echo e(translate('messages.Are you sure?')); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
            confirmButtonText: '<?php echo e(translate('messages.Yes')); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).submit()
            }
        })
    })

    $('.canceled-status').on('click',function (){
        let route = $(this).data('url');
        let message = $(this).data('message');
        let processing = $(this).data('processing')??false;
        cancelled_status(route, message, processing);
    })

    function cancelled_status(route, message, processing = false) {
        Swal.fire({
            //text: message,
            title: '<?php echo e(translate('messages.Are you sure ?')); ?>',
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '<?php echo e(translate('messages.Cancel')); ?>',
            confirmButtonText: '<?php echo e(translate('messages.submit')); ?>',
            inputPlaceholder: "<?php echo e(translate('Enter_a_reason')); ?>",
            input: 'text',
            html: message + '<br/>'+'<label><?php echo e(translate('Enter_a_reason')); ?></label>',
            inputValue: processing,
            preConfirm: (note) => {
                location.href = route + '&note=' + note;
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
    }

    function set_mail_filter(url, id, filter_by) {
        Swal.fire({
            title: '<?php echo e(translate('messages.Are you sure?')); ?>',
            text: 'Please save changes before switching template',
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
            confirmButtonText: '<?php echo e(translate('messages.Yes')); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                let nurl = new URL(url);
                nurl.searchParams.set(filter_by, id);
                location.href = nurl;
            }
        })
    }


    function copy_text(copyText) {
        navigator.clipboard.writeText(copyText);
        toastr.success('<?php echo e(translate('messages.text_copied')); ?>', {
            CloseButton: true,
            ProgressBar: true
        });
    }

    $(document).on('ready', function(){
        $(".direction-toggle").on("click", function () {
            if($('html').hasClass('active')){
                $('html').removeClass('active')
                setDirection(1);
            }else {
                setDirection(0);
                $('html').addClass('active')
            }
        });

        if ($('html').attr('dir') === "rtl") {
            $(".direction-toggle").find('span').text('Toggle LTR')
        } else {
            $(".direction-toggle").find('span').text('Toggle RTL')
        }

        function setDirection(status) {
            if (status === 1) {
                $("html").attr('dir', 'ltr');
                $(".direction-toggle").find('span').text('Toggle RTL')
            } else {
                $("html").attr('dir', 'rtl');
                $(".direction-toggle").find('span').text('Toggle LTR')
            }
            $.get({
                    url: '<?php echo e(route('admin.business-settings.site_direction')); ?>',
                    dataType: 'json',
                    data: {
                        status: status,
                    },
                    success: function() {
                        alert(ok);
                    },

                });
            }
        });

    <?php ($fcm_credentials = \App\CentralLogics\Helpers::get_business_settings('fcm_credentials')); ?>
    let firebaseConfig = {
        apiKey: "<?php echo e(isset($fcm_credentials['apiKey']) ? $fcm_credentials['apiKey'] : ''); ?>",
        authDomain: "<?php echo e(isset($fcm_credentials['authDomain']) ? $fcm_credentials['authDomain'] : ''); ?>",
        projectId: "<?php echo e(isset($fcm_credentials['projectId']) ? $fcm_credentials['projectId'] : ''); ?>",
        storageBucket: "<?php echo e(isset($fcm_credentials['storageBucket']) ? $fcm_credentials['storageBucket'] : ''); ?>",
        messagingSenderId: "<?php echo e(isset($fcm_credentials['messagingSenderId']) ? $fcm_credentials['messagingSenderId'] : ''); ?>",
        appId: "<?php echo e(isset($fcm_credentials['appId']) ? $fcm_credentials['appId'] : ''); ?>",
        measurementId: "<?php echo e(isset($fcm_credentials['measurementId']) ? $fcm_credentials['measurementId'] : ''); ?>"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken();
            })
            .then(function(token) {
                // console.log('FCM Token:', token);
                // Send the token to your backend to subscribe to topic
                subscribeTokenToBackend(token, 'admin_message');
            }).catch(function(error) {
            console.error('Error getting permission or token:', error);
        });
    }

    function subscribeTokenToBackend(token, topic) {
        fetch('<?php echo e(url('/')); ?>/subscribeToTopic', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({ token: token, topic: topic })
        }).then(response => {
            if (response.status < 200 || response.status >= 400) {
                return response.text().then(text => {
                    throw new Error(`Error subscribing to topic: ${response.status} - ${text}`);
                });
            }
            console.log(`Subscribed to "${topic}"`);
        }).catch(error => {
            console.error('Subscription error:', error);
        });
    }



    function conversationList() {
        $.ajax({
                url: "<?php echo e(route('admin.message.list')); ?>",
                success: function(data) {
                    $('#conversation-list').empty();
                    $("#conversation-list").append(data.html);
                    let user_id = getUrlParameter('user');
                $('.customer-list').removeClass('conv-active');
                $('#customer-' + user_id).addClass('conv-active');
                }
            })
    }

    function conversationView() {
        let conversation_id = getUrlParameter('conversation');
        let user_id = getUrlParameter('user');
        let url= '<?php echo e(url('/')); ?>/admin/message/view/'+conversation_id+'/' + user_id;
        $.ajax({
            url: url,
            success: function(data) {
                $('#view-conversation').html(data.view);
            }
        })
    }



    function vendorConversationView() {
        let conversation_id = getUrlParameter('conversation');
        let user_id = getUrlParameter('user');
        let url= '<?php echo e(url('/')); ?>/admin/store/message/'+conversation_id+'/' + user_id;
        $.ajax({
            url: url,
            success: function(data) {
                $('#vendor-view-conversation').html(data.view);
            }
        })
    }

    function dmConversationView() {
        let conversation_id = getUrlParameter('conversation');
        let user_id = getUrlParameter('user');
        let url= '<?php echo e(url('/')); ?>/admin/users/delivery-man/message/'+conversation_id+'/' + user_id;
        $.ajax({
            url: url,
            success: function(data) {
                $('#dm-view-conversation').html(data.view);
            }
        })
    }

    let new_order_type='store_order';
    let new_module_id=null;
    let admin_zone_id=null;
    let admin_role_id=null;

    <?php ($order_notification_type = \App\Models\BusinessSetting::where('key', 'order_notification_type')->first()); ?>
    <?php ($order_notification_type = $order_notification_type ? $order_notification_type->value : 'firebase'); ?>
    messaging.onMessage(function(payload) {
        console.log(payload.data)
        if(payload.data.order_id && payload.data.type == "order_request"){
                <?php ($admin_order_notification = \App\Models\BusinessSetting::where('key', 'admin_order_notification')->first()); ?>
                <?php ($admin_order_notification = $admin_order_notification ? $admin_order_notification->value : 0); ?>
                <?php if(\App\CentralLogics\Helpers::module_permission_check('order') && $admin_order_notification && $order_notification_type == 'firebase'): ?>
                new_order_type = payload.data.order_type
                new_module_id = payload.data.module_id
                admin_zone_id = '<?php echo auth()->guard('admin')->user()->zone_id ;?>';
                admin_role_id = '<?php echo auth()->guard('admin')->user()->role_id ;?>';
                if(new_order_type === 'trip'){
                    document.querySelector('.update_notification_text').textContent = "<?php echo e(translate('messages.You have new trip, Check Please.')); ?>";
                }
                if(admin_role_id === '1'){
                    playAudio();
                    $('#popup-modal').appendTo("body").modal('show');
                }
                if((admin_role_id !== '1') && (admin_zone_id === payload.data.zone_id)){
                    playAudio();
                    $('#popup-modal').appendTo("body").modal('show');
                }
                <?php endif; ?>

        }else{
            if (window.location.href.includes('message/list?conversation')) {
                let conversation_id = getUrlParameter('conversation');
                let user_id = getUrlParameter('user');
                let url = '<?php echo e(url('/')); ?>/admin/message/view/' + conversation_id + '/' + user_id;
                console.log(url);
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#view-conversation').html(data.view);
                    }
                })
            }
            toastr.success('New message arrived', {
                CloseButton: true,
                ProgressBar: true
            });
            if($('#conversation-list').scrollTop() === 0){
                conversationList();
            }
        }
    });

    <?php if(\App\CentralLogics\Helpers::module_permission_check('order') && $order_notification_type == 'manual'): ?>
        <?php ($admin_order_notification=\App\Models\BusinessSetting::where('key','admin_order_notification')->first()); ?>
        <?php ($admin_order_notification=$admin_order_notification?$admin_order_notification->value:0); ?>
        <?php if($admin_order_notification): ?>
            setInterval(function () {
                $.get({
                    url: '<?php echo e(route('admin.get-store-data')); ?>',
                    dataType: 'json',
                    success: function (response) {
                        let data = response.data;
                        new_order_type = data.type;
                        new_module_id = data.module_id;
                        if(new_order_type === 'trip'){
                            document.querySelector('.update_notification_text').textContent = "<?php echo e(translate('messages.You have new trip, Check Please.')); ?>";
                        }
                        if (data.new_order > 0) {
                            playAudio();
                            $('#popup-modal').appendTo("body").modal('show');
                        }else{
                            $('#popup-modal').appendTo("body").modal('hide');
                        }
                    },
                });
            }, 10000);
        <?php endif; ?>
    <?php endif; ?>

    $(document).on('click', '.check-order', function () {
        if(new_order_type === 'parcel')
        {
            location.href = '<?php echo e(url('/')); ?>/admin/parcel/orders/all?module_id=' + new_module_id;
        }
        else if(new_order_type === 'trip')
        {
            location.href = '<?php echo e(url('/')); ?>/admin/rental/trip?module_id=' + new_module_id;
        }
        else
        {
            location.href = '<?php echo e(url('/')); ?>/admin/order/list/all?module_id=' + new_module_id;
        }
    });

    startFCM();
    conversationList();
    if(getUrlParameter('conversation')){
        conversationView();
        vendorConversationView();
        dmConversationView();
    }


    $(document).on('click', '.call-demo', function () {
        <?php if(env('APP_MODE') =='demo'): ?>
            toastr.info('<?php echo e(translate('Update option is disabled for demo!')); ?>', {
                CloseButton: true,
                ProgressBar: true
            });
        <?php endif; ?>
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
</script>
        <script src="<?php echo e(asset('assets/admin/intltelinput/js/intlTelInput.min.js')); ?>"></script>

        <script>

    const inputs = document.querySelectorAll('input[type="tel"]');

    inputs.forEach(input => {
        window.intlTelInput(input, {
            initialCountry: "<?php echo e($countryCode); ?>",
            utilsScript: "<?php echo e(asset('assets/admin/intltelinput/js/utils.js')); ?>",
            autoInsertDialCode: true,
            nationalMode: false,
            formatOnDisplay: false,
        });
    });


  function keepNumbersAndPlus(inputString) {
    let regex = /[0-9+]/g;
    let filteredString = inputString.match(regex);
    let result = filteredString ? filteredString.join('') : '';
    return result;
}

$(document).on('keyup', 'input[type="tel"]', function () {
        let input = $(this).val();
        $(this).val(keepNumbersAndPlus(input));
        });


  //external configuration
    $("#generateSystemSelfToken").on("click", function () {
        generateRandomToken(64);
    });
    if(document.getElementById('copyButton')){

        document.getElementById('copyButton').addEventListener('click', function() {
            const input = document.getElementById('systemSelfToken');

            // Select the input field text
            input.select();
            input.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the input field to the clipboard
            navigator.clipboard.writeText(input.value).then(function() {
                toastr.success('Text copied to clipboard: ' + input.value);
            }).catch(function(error) {
                toastr.error('Failed to copy text: ', error);
            });
        });
    }

    function generateRandomToken(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let token = '';
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            token += characters.charAt(randomIndex);
        }
        $('#systemSelfToken').val(token)
    }


            //search option
            $(document).ready(function () {
            $('#searchForm input[name="search"]').keyup(function () {
                var searchKeyword = $(this).val().trim();

                if (searchKeyword.length >= 1) {
                    $.ajax({
                        type: 'POST',
                        url: $('#searchForm').attr('action'),
                        data: {search: searchKeyword, _token: $('input[name="_token"]').val()},
                        success: function (response) {
                            if (response.length === 0) {
                                let htmlContent = '';

                                <?php if(!$current_module_type_for_search): ?>
                                    htmlContent += '<div class="bg--13 d-inline-block fs-12 fw-500 mb-2 px-2 py-1 rounded text-italic">' + <?php echo json_encode(translate('* To get module-specific results, please search within the module.'), 512) ?> + '</div>';
                                <?php endif; ?>

                                htmlContent += '<div class="fs-16 fw-500 mb-2">' + <?php echo json_encode(translate('Search Result'), 15, 512) ?> + '</div>' +
                                    '<div class="search-list h-300 d-flex flex-column gap-2 justify-content-center align-items-center fs-16">' +
                                        '<img width="30" class="h-auto" src="' + <?php echo json_encode(asset('assets/admin/img/modal/no-search-found.png'), 15, 512) ?> + '" alt="">' + ' ' +
                                        <?php echo json_encode(translate('No result found'), 15, 512) ?> +
                                    '</div>';

                                $('#searchResults').html(htmlContent);

                            } else {
                                var resultHtml = '';
                                response.forEach(function (route) {
                                    var separator = route.fullRoute.includes('?') ? '&' : '?';
                                    var fullRouteWithKeyword = route.fullRoute + separator + 'keyword=' + encodeURIComponent(searchKeyword);
                                    var keywordRegex = searchKeyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                                        keywordRegex = new RegExp('(' + keywordRegex + ')', 'gi');
                                    var highlightedRouteName = route.routeName.replace(keywordRegex, '<mark>$1</mark>');
                                    var highlightedURI = route.URI.replace(keywordRegex, '<mark>$1</mark>');
                                    resultHtml += '<a href="' + fullRouteWithKeyword + '" class="search-list-item d-flex flex-column" data-route-name="' + route.routeName + '" data-route-uri="' + route.URI + '" data-route-full-url="' + route.fullRoute + '" aria-current="true">';
                                    resultHtml += '<h5>' + highlightedRouteName + '</h5>';
                                    resultHtml += '<p class="text-muted fs-12 mb-0">' + highlightedURI + '</p>';
                                    resultHtml += '</a>';
                                });

                                let htmlContent = '';

                                <?php if(!$current_module_type_for_search): ?>
                                    htmlContent += '<div class="bg--13 d-inline-block fs-12 fw-500 mb-2 px-2 py-1 rounded text-italic">' + <?php echo json_encode(translate('* To get module-specific results, please search within the module.'), 512) ?> + '</div>';
                                <?php endif; ?>
                                htmlContent +='<div class="fs-16 fw-500 mb-2">' + <?php echo json_encode(translate('Search Result'), 15, 512) ?> + '</div>' + '<div class="search-list d-flex flex-column">' + resultHtml + '</div>';

                                $('#searchResults').html(htmlContent);
                                $('.search-list-item').click(function () {
                                    var routeName = $(this).data('route-name');
                                    var routeUri = $(this).data('route-uri');
                                    var routeFullUrl = $(this).data('route-full-url');

                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo e(route('admin.store.clicked.route')); ?>',
                                        data: {
                                            routeName: routeName,
                                            routeUri: routeUri,
                                            routeFullUrl: routeFullUrl,
                                            searchKeyword: searchKeyword,
                                            moduleId: '<?php echo e(config('module.current_module_id') ?? null); ?>',
                                            _token: $('input[name="_token"]').val()
                                        },
                                        success: function (response) {

                                        },
                                        error: function (xhr, status, error) {
                                            console.error(xhr.responseText);
                                        }
                                    });
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else {
                    getRecentSearch()
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key === 'k') {
                event.preventDefault();
                document.getElementById('modalOpener').click();
            }
        });

        $(document).ready(function () {
            $("#staticBackdrop").on("shown.bs.modal", function () {
                getRecentSearch()
            });
        });


        function getRecentSearch(){
            $(this).find("#searchForm input[type=search]").val('');
                $('#searchResults').html('<div class="text-center text-muted py-5"><?php echo e(translate('Loading recent searches')); ?>...</div>');
                $(this).find("#searchForm input[type=search]").focus();

                $.ajax({
                    type: 'GET',
                    url: '<?php echo e(route('admin.recent.search')); ?>',
                    success: function (response) {
                        if (response.length === 0) {
                            $('#searchResults').html('<div class="text-center text-muted py-5"><?php echo e(translate('It appears that you have not yet searched.')); ?>.</div>');
                        } else {
                            var resultHtml = '';
                            response.forEach(function (route) {
                                resultHtml += '<a href="' + route.route_full_url + '" class="search-list-item d-flex flex-column" data-route-name="' + route.route_name + '" data-route-uri="' + route.route_uri + '" data-route-full-url="' + route.route_full_url + '" aria-current="true">';
                                resultHtml += '<h5>' + route.route_name + '</h5>';
                                resultHtml += '<p class="text-muted fs-12  mb-0">' + route.route_uri + '</p>';
                                resultHtml += '</a>';
                            });
                            $('#searchResults').html('<div class="recent-search fs-16 fw-500 animate">' +
                                <?php echo json_encode(translate('Recent Search'), 15, 512) ?> + '<div class="search-list d-flex flex-column mt-2">' + resultHtml + '</div></div>');

                            $('.search-list-item').click(function () {
                                var routeName = $(this).data('route-name');
                                var routeUri = $(this).data('route-uri');
                                var routeFullUrl = $(this).data('route-full-url');
                                var searchKeyword = $('input[type=search]').val().trim();

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo e(route('admin.store.clicked.route')); ?>',
                                    data: {
                                        routeName: routeName,
                                        routeUri: routeUri,
                                        routeFullUrl: routeFullUrl,
                                        searchKeyword: searchKeyword,
                                        _token: $('input[name="_token"]').val()
                                    },
                                    success: function (response) {
                                        console.log(response.message);
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(xhr.responseText);
                                    }
                                });
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#searchResults').html('<div class="text-center text-muted py-5"><?php echo e(translate('Error loading recent searches')); ?>.</div>');
                    }
                });
        }





        $("#staticBackdrop").on("hidden.bs.modal", function () {
            $('#searchResults').empty();
        });

        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('search', function() {
            if (!this.value.trim()) {
                $('#searchResults').html('<div class="text-center text-muted py-5"></div>');
            }
        });

        $('#searchForm').submit(function (event) {
            event.preventDefault();
        });



</script>

<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="<?php echo e(asset('/assets/admin')); ?>/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Admin\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>