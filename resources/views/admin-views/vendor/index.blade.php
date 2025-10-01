@extends('layouts.admin.app')

@section('title',translate('messages.add_store_name'))



@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{asset('assets/admin/img/store.png')}}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('messages.add_new_store')}}
                </span>
            </h1>
        </div>
        @php($language=\App\Models\BusinessSetting::where('key','language')->first())
        @php($language = $language->value ?? null)
        @php($defaultLang = 'en')

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- End Page Header -->
      <form action="{{ route('admin.store.create') }}" method="POST" enctype="multipart/form-data" id="vendor_form">
    @csrf

    <div class="row g-2">

        <!-- Store Details -->
        <div class="col-lg-6">
            <div class="card shadow--card-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for="store_name">{{ translate('Store Name') }}</label>
                        <input type="text" name="name[]" class="form-control" placeholder="{{ translate('Store Name') }}" required>
                        <input type="hidden" name="lang[]" value="default">
                    </div>

                    <div class="form-group">
                        <label for="address">{{ translate('Address') }}</label>
                        <textarea name="address[]" class="form-control" placeholder="{{ translate('Store Address') }}"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo & Cover -->
        <div class="col-lg-6">
            <div class="card shadow--card-2">
                <div class="card-header">{{ translate('Store Logo & Cover') }}</div>
                 <div class="card-body">
                <div class="d-flex flex-wrap flex-sm-nowrap __gap-12px">
                    <div class="__custom-upload-img mr-lg-5"> @php($logo = \App\Models\BusinessSetting::where('key', 'logo')->first()) @php($logo = $logo->value ?? '') <label class="form-label"> {{ translate('logo') }}
                        <span class="text--primary">({{ translate('1:1') }})</span>
                    </label>
                    <label class="text-center position-relative">
                        <img class="img--110 min-height-170px min-width-170px onerror-image image--border" id="viewer" data-onerror-image="{{ asset('assets/admin/img/upload.png') }}" src="{{ asset('assets/admin/img/upload-img.png') }}" alt="logo image" />
                        <div class="icon-file-group">
                        <div class="icon-file">
                            <i class="tio-edit"></i>
                            <input type="file" name="logo" id="customFileEg1" class="custom-file-input" accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div>
                        </div>
                    </label>
                    </div>
                    <div class="__custom-upload-img"> @php($icon = \App\Models\BusinessSetting::where('key', 'icon')->first()) @php($icon = $icon->value ?? '') <label class="form-label"> {{ translate('Store Cover') }}
                        <span class="text--primary">({{ translate('2:1') }})</span>
                    </label>
                    <label class="text-center position-relative">
                        <img class="img--vertical min-height-170px min-width-170px onerror-image image--border" id="coverImageViewer" data-onerror-image="{{ asset('assets/admin/img/upload-img.png') }}" src="{{ asset('assets/admin/img/upload-img.png') }}" alt="Fav icon" />
                        <div class="icon-file-group">
                        <div class="icon-file">
                            <i class="tio-edit"></i>
                            <input type="file" name="cover_photo" id="coverImageUpload" class="custom-file-input" accept=".webp, .jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        </div>
                        </div>
                    </label>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Google Map -->
        <div class="col-lg-12">
            <div class="card">

                 <div class="card-header">
                    <h4 class="card-title m-0 d-flex align-items-center">
                        <img class="mr-2 align-self-start w--20" src="{{asset('assets/admin/img/resturant.png')}}" alt="instructions">
                        <span>{{translate('store_information')}}</span>
                    </h4>
                </div>

                <div class="card-body">
                      <div class="row g-3 my-0">
                            <div class="col-md-12">
                            <div class="position-relative">
                                <label class="input-label" for="tax">{{translate('Estimated Delivery Time ( Min & Maximum Time)')}}</label>
                                <input type="text" id="time_view" class="form-control" readonly>
                                <a href="javascript:void(0)" class="floating-date-toggler">&nbsp;</a>
                                <span class="offcanvas"></span>
                                <div class="floating--date" id="floating--date">
                                <div class="card shadow--card-2">
                                    <div class="card-body">
                                    <div class="floating--date-inner">
                                        <div class="item">
                                        <label class="input-label" for="minimum_delivery_time">{{ translate('Minimum Time') }}</label>
                                        <input id="minimum_delivery_time" type="number" name="minimum_delivery_time" class="form-control h--45px" placeholder="{{ translate('messages.Ex :') }} 30" pattern="^[0-9]{2}$" required value="{{ old('minimum_delivery_time') }}">
                                        </div>
                                        <div class="item">
                                        <label class="input-label" for="maximum_delivery_time">{{ translate('Maximum Time') }}</label>
                                        <input id="maximum_delivery_time" type="number" name="maximum_delivery_time" class="form-control h--45px" placeholder="{{ translate('messages.Ex :') }} 60" pattern="[0-9]{2}" required value="{{ old('maximum_delivery_time') }}">
                                        </div>
                                        <div class="item smaller">
                                        <select name="delivery_time_type" id="delivery_time_type" class="custom-select">
                                            <option value="min">{{translate('messages.minutes')}}</option>
                                            <option value="hours">{{translate('messages.hours')}}</option>
                                            <option value="days">{{translate('messages.days')}}</option>
                                        </select>
                                        </div>
                                        <div class="item smaller">
                                        <button type="button" class="btn btn--primary delivery-time">{{ translate('done') }}</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <div class="row g-3 my-0">
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label class="input-label" for="choice_zones">{{translate('messages.zone')}}
                            <span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.select_zone_for_map')}}">
                                <img src="{{asset('/assets/admin/img/info-circle.svg')}}" alt="{{translate('messages.select_zone_for_map')}}">
                            </span>
                            </label>
                            <select name="zone_id" id="choice_zones" required class="form-control js-select2-custom" data-placeholder="{{translate('messages.select_zone')}}">
                            <option value="" selected disabled>{{translate('messages.select_zone')}}</option> @foreach(\App\Models\Zone::active()->get() as $zone) @if(isset(auth('admin')->user()->zone_id)) @if(auth('admin')->user()->zone_id == $zone->id) <option value="{{$zone->id}}">{{$zone->name}}</option> @endif @else <option value="{{$zone->id}}">{{$zone->name}}</option> @endif @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="input-label" for="latitude">{{translate('messages.latitude')}}
                            <span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.store_lat_lng_warning')}}">
                                <img src="{{asset('/assets/admin/img/info-circle.svg')}}" alt="{{translate('messages.store_lat_lng_warning')}}">
                            </span>
                            </label>
                            <input type="text" id="latitude" name="latitude" class="form-control" placeholder="{{ translate('messages.Ex:') }} -94.22213" value="{{old('latitude')}}" required readonly>
                        </div>
                        <div class="form-group mb-5">
                            <label class="input-label" for="longitude">{{translate('messages.longitude')}}
                            <span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{translate('messages.store_lat_lng_warning')}}">
                                <img src="{{asset('/assets/admin/img/info-circle.svg')}}" alt="{{translate('messages.store_lat_lng_warning')}}">
                            </span>
                            </label>
                            <input type="text" name="longitude" class="form-control" placeholder="{{ translate('messages.Ex:') }} 103.344322" id="longitude" value="{{old('longitude')}}" required readonly>
                        </div>
                        </div>
                        <div class="col-lg-8">
                        <input id="pac-input" class="controls rounded" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('messages.search_your_location_here') }}" type="text" placeholder="{{ translate('messages.search_here') }}" />
                        <div id="map" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Owner Information -->
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title m-0 d-flex align-items-center">
                    <span class="card-header-icon mr-2">
                    <i class="tio-user"></i>
                    </span>
                    <span>{{translate('messages.owner_information')}}</span>
                </h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ translate('First Name') }}</label>
                        <input type="text" name="f_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Last Name') }}</label>
                        <input type="text" name="l_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Phone') }}</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="col-lg-12">
            <div class="card">
                 <div class="card-header">
                    <h4 class="card-title m-0 d-flex align-items-center">
                        <span class="card-header-icon mr-2">
                        <i class="tio-user"></i>
                        </span>
                        <span>{{translate('messages.account_information')}}</span>
                    </h4>
                  </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ translate('Email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Password') }}</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Confirm Password') }}</label>
                        <input type="password" name="confirmPassword" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                 <div class="card-header">
                    <h4 class="card-title m-0 d-flex align-items-center">
                        <span class="card-header-icon mr-2">
                        <i class="tio-user"></i>
                        </span>
                        <span>{{translate('messages.account_information')}}</span>
                    </h4>
                  </div>
                <div class="card-body">
                      <div class="row g-3">
                            <div class="col-md-8 col-xxl-9">
                            <div class="bg--secondary rounded p-20 h-100">
                                <div class="form-group">
                                <label class="input-label mb-2 d-block title-clr fw-normal" for="exampleFormControlInput1">{{translate('Taxpayer Identification Number(TIN)')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tin" placeholder="{{translate('Type Your Taxpayer Identification Number(TIN)')}}" class="form-control" required>
                                </div>
                                <div class="form-group mb-0">
                                <label class="input-label mb-2 d-block title-clr fw-normal" for="exampleFormControlInput1">{{translate('Expire Date')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tin_expire_date" class="form-control" required>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4 col-xxl-3">
                            <div class="bg--secondary rounded p-20 h-100 single-document-uploaderwrap">
                                <div class="d-flex align-items-center gap-1 justify-content-between mb-20">
                                <div>
                                    <h4 class="mb-1 fz--14px">{{translate('TIN Certificate')}}</h4>
                                    <p class="fz-12px mb-0">{{translate('pdf, doc, jpg. File size : max 2 MB')}}</p>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <button type="button" id="doc_edit_btn" class="w-30px h-30 rounded d-flex align-items-center justify-content-center btn--primary btn px-3 icon-btn">
                                    <i class="tio-edit"></i>
                                    </button>
                                </div>
                                </div>
                                <div>
                                <div id="file-assets" data-picture-icon="{{ asset('assets/admin/img/picture.svg') }}" data-document-icon="{{ asset('assets/admin/img/document.svg') }}" data-blank-thumbnail="{{ asset('assets/admin/img/picture.svg') }}"></div>
                                <!-- Upload box -->
                                <div class="d-flex justify-content-center" id="pdf-container">
                                    <div class="document-upload-wrapper" id="doc-upload-wrapper">
                                    <input type="file" name="tin_certificate_image" class="document_input" accept=".doc, .pdf, .jpg, .png, .jpeg">
                                    <div class="textbox">
                                        <img width="40" height="40" class="svg" src="{{ asset('assets/admin/img/doc-uploaded.png') }}" alt="">
                                        <p class="fs-12 mb-0">Select a file or <span class="font-semibold">Drag & Drop</span> here </p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="col-lg-12 mt-3">
            <button type="submit" class="btn btn-primary">{{ translate('Submit') }}</button>
        </div>

    </div>
</form>


    </div>

@endsection

@push('script_2')

    <script src="{{ asset('assets/admin/js/file-preview/pdf.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/file-preview/pdf-worker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/file-preview/add-multiple-document-upload.js') }}"></script>

    <script src="{{asset('assets/admin/js/spartan-multi-image-picker.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value}}&libraries=places&callback=initMap&v=3.45.8"></script>

<script>
"use strict";

$(document).on('ready', function () {
    $('.offcanvas').on('click', function(){
        $('.offcanvas, .floating--date').removeClass('active')
    })
    $('.floating-date-toggler').on('click', function(){
        $('.offcanvas, .floating--date').toggleClass('active')
    })
    @if (isset(auth('admin')->user()->zone_id))
        $('#choice_zones').trigger('change');
    @endif
});

function readURL(input, viewer) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#'+viewer).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#customFileEg1").change(function () {
    readURL(this, 'viewer');
});
$("#coverImageUpload").change(function () {
    readURL(this, 'coverImageViewer');
});

// ---------------- MAP SCRIPT ----------------
@php($default_location=\App\Models\BusinessSetting::where('key','default_location')->first())
@php($default_location=$default_location->value?json_decode($default_location->value, true):0)
let myLatlng = { lat: {{$default_location?$default_location['lat']:'23.757989'}}, lng: {{$default_location?$default_location['lng']:'90.360587'}} };

let map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: myLatlng,
    });

let zonePolygon = null;
let infoWindow = new google.maps.InfoWindow();
let bounds = new google.maps.LatLngBounds();
let activeMarker = new google.maps.Marker({
    map: map,
    position: myLatlng,
    draggable: true
});


google.maps.event.addListener(activeMarker, 'dragend', function (event) {
    document.getElementById('latitude').value = event.latLng.lat();
    document.getElementById('longitude').value = event.latLng.lng();
});

function initMap() {
    // ---- Current location ----
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                myLatlng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(myLatlng);
                activeMarker.setPosition(myLatlng);
                document.getElementById('latitude').value = myLatlng.lat;
                document.getElementById('longitude').value = myLatlng.lng;
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    }

    // ---- Map Click to get lat/lng ----
    map.addListener("click", function(mapsMouseEvent) {
        let clickedLatLng = mapsMouseEvent.latLng.toJSON();
        activeMarker.setPosition(mapsMouseEvent.latLng);
        infoWindow.setContent("Lat: " + clickedLatLng.lat + ", Lng: " + clickedLatLng.lng);
        infoWindow.open(map, activeMarker);

        document.getElementById('latitude').value = clickedLatLng.lat;
        document.getElementById('longitude').value = clickedLatLng.lng;
    });

    // ---- Search Box ----
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();
        if (places.length == 0) return;

        const bounds = new google.maps.LatLngBounds();
        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) return;

        
            activeMarker.setPosition(place.geometry.location);
            map.setCenter(place.geometry.location);
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}
initMap();

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

// ---- Zone Polygon ----
$('#choice_zones').on('change', function(){
    let id = $(this).val();
    $.get({
        url: '{{ route("admin.zone.get-coordinates", ":id") }}'.replace(':id', id),
        dataType: 'json',
        success: function (data) {
            if(zonePolygon) zonePolygon.setMap(null);

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

            google.maps.event.addListener(zonePolygon, 'click', function (mapsMouseEvent) {
                let coordinates = mapsMouseEvent.latLng.toJSON();
                activeMarker.setPosition(mapsMouseEvent.latLng);
                infoWindow.setContent("Lat: " + coordinates.lat + ", Lng: " + coordinates.lng);
                infoWindow.open(map, activeMarker);

                document.getElementById('latitude').value = coordinates.lat;
                document.getElementById('longitude').value = coordinates.lng;
            });
        },
    });
});

// ---- Reset ----
$('#reset_btn').click(function(){
    $('#viewer').attr('src', "{{ asset('assets/admin/img/upload.png') }}");
    $('#customFileEg1').val(null);
    $('#coverImageViewer').attr('src', "{{ asset('assets/admin/img/upload-img.png') }}");
    $('#coverImageUpload').val(null);
    $('#choice_zones').val(null).trigger('change');
    $('#module_id').val(null).trigger('change');
    if(zonePolygon) zonePolygon.setMap(null);
    $('#coordinates').val(null);
    $('#latitude').val(null);
    $('#longitude').val(null);
    activeMarker.setMap(null);
});

// ---- Module Ajax ----
let zone_id = 0;
$('#choice_zones').on('change', function() {
    if($(this).val()) {
        zone_id = $(this).val();
    }
});

$('#module_id').select2({
    ajax: {
        url: '{{url('/')}}/vendor/get-all-modules',
        data: function (params) {
            return {
                q: params.term,
                page: params.page,
                zone_id: zone_id
            };
        },
        processResults: function (data) {
            return { results: data };
        },
        __port: function (params, success, failure) {
            let $request = $.ajax(params);
            $request.then(success);
            $request.fail(failure);
            return $request;
        }
    }
});

// ---- Delivery Time ----
$('.delivery-time').on('click',function (){
    let min = $("#minimum_delivery_time").val();
    let max = $("#maximum_delivery_time").val();
    let type = $("#delivery_time_type").val();
    $("#floating--date").removeClass('active');
    $("#time_view").val(min+' to '+max+' '+type);
});
</script>



@endpush
