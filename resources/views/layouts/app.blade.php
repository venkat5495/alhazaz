<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link name="favicon" type="image/x-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />

    <title>{{ \App\GeneralSetting::first()->site_name }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!--active-shop Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/active-shop.min.css')}}" rel="stylesheet">

    <!--active-shop Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('css/demo/active-shop-demo-icons.min.css')}}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!--Switchery [ OPTIONAL ]-->
    <link href="{{ asset('plugins/switchery/switchery.min.css')}}" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
    <link href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet">

    <!--Select2 [ OPTIONAL ]-->
    <link href="{{ asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!--Chosen [ OPTIONAL ]-->
    {{-- <link href="{{ asset('plugins/chosen/chosen.min.css')}}" rel="stylesheet"> --}}

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">

    <!--Summernote [ OPTIONAL ]-->
    <link href="{{ asset('css/jodit.min.css') }}" rel="stylesheet">

    <!--Theme [ DEMONSTRATION ]-->
    <!-- <link href="{{ asset('css/themes/type-full/theme-dark-full.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/themes/type-c/theme-navy.min.css') }}" rel="stylesheet">

    <!--Spectrum Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/spectrum.css')}}" rel="stylesheet">

    <!--Custom Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <style>
    .panel-body table input[type="checkbox"]{ -webkit-appearance: auto !important; }
    .colorpicker-alpha {display:none !important;} .colorpicker{ min-width:128px !important;}
    .panel-body table input[type="checkbox"] { -webkit-appearance: checkbox !important;}
    </style>


    <!--jQuery [ REQUIRED ]-->
    <script src=" {{asset('js/jquery.min.js') }}"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!--active-shop [ RECOMMENDED ]-->
    <script src="{{ asset('js/active-shop.min.js') }}"></script>

    <!--Alerts [ SAMPLE ]-->
    <script src="{{ asset('js/demo/ui-alerts.js') }}"></script>

    <!--Switchery [ OPTIONAL ]-->
    <script src="{{ asset('plugins/switchery/switchery.min.js')}}"></script>

    <!--DataTables [ OPTIONAL ]-->
    <script src="{{ asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="{{ asset('js/demo/tables-datatables.js')}}"></script>

    <!--Select2 [ OPTIONAL ]-->
    <script src="{{ asset('plugins/select2/js/select2.min.js')}}"></script>

    <!--Summernote [ OPTIONAL ]-->
    <script src="{{ asset('js/jodit.min.js') }}"></script>

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{ asset('plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>

    <!--Bootstrap Wizard [ OPTIONAL ]-->
    <script src="{{ asset('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!--Form Component [ SAMPLE ]-->
    <script src="{{asset('js/demo/form-wizard.js')}}"></script>

    <!--Spectrum JavaScript [ REQUIRED ]-->
    <script src="{{ asset('js/spectrum.js')}}"></script>

    <!--Spartan Image JavaScript [ REQUIRED ]-->
    <script src="{{ asset('js/spartan-multi-image-picker-min.js') }}"></script>

    <!--Custom JavaScript [ REQUIRED ]-->
    <script src="{{ asset('js/custom.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.min.js')}}"></script>

    <script type="text/javascript">

        $( document ).ready(function() {
            //$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
            if($('.active-link').parent().parent().parent().is('ul')){
                $('.active-link').parent().parent().addClass('in');
                $('.active-link').parent().parent().parent().addClass('in');
            }
            if($('.active-link').parent().parent().is('li')){
                $('.active-link').parent().parent().addClass('active-sub');
            }
            if($('.active-link').parent().is('ul')){
                $('.active-link').parent().addClass('in');
            }


            $('.demo-dt-basic').dataTable( {
                "responsive": true,
                language: {
                @if(app()->getLocale() == 'sa')
                    processing:     "معالجة...",
                    search:         "بحث&nbsp;:",
                    lengthMenu:    "تبين  _MENU_ إدخالات",
                    info:           "عرض  _START_ إلى  _END_ من  _TOTAL_ إدخالات",
                    infoEmpty:      "عرض   0 إلى  0 من  0 إدخالات",
                    infoFiltered:   "(تصفيتها من  _MAX_ مجموع الإدخالات)",
                    infoPostFix:    "",
                    loadingRecords: "جار التحميل...",
                    zeroRecords:    "لم يتم العثور على سجلات مطابقة",
                    emptyTable:     "لا توجد بيانات متاحة في الجدول",
                @endif
                    paginate : {
                      "previous": '<i class="demo-psi-arrow-left"></i>',
                      "next": '<i class="demo-psi-arrow-right"></i>'
                    }
                }
            } );

        });

    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133955404-1"></script>

        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', @php env('TRACKING_ID') @endphp);
        </script>
    @endif
    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <!-- RTL -->
        <link type="text/css" href="{{ asset('frontend/css/admin/active.rtl.css') }}" rel="stylesheet">

    @endif

</head>
<body>


    @foreach (session('flash_notification', collect())->toArray() as $message)
        <script type="text/javascript">
            $(document).on('nifty.ready', function() {
                showAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
            });
        </script>
    @endforeach


    <div id="container" class="effect aside-float aside-bright mainnav-lg">

        @include('inc.admin_nav')

        <div class="boxed">
            <div id="content-container">
                <div id="page-content">

                    @yield('content')

                </div>
            </div>
        </div>

        @include('inc.admin_sidenav')

        @include('inc.admin_footer')

        @include('partials.modal')

    </div>

        @yield('script')

</body>
</html>
<script>
    function get_cities(selected_city_id = null){
        var selected_city_id = selected_city_id;
        var state_id = $('#state').val();
        if (state_id !== undefined) {
            $.get('{{ route('cities_list') }}',{_token:'{{ csrf_token() }}', state_id:state_id, city_id:selected_city_id}, function(data){
                $('#city_ids').html(data);
                // $('.demo-select2').select2();
            });
        }
    }
    
    $(document).on('change','#state', function() {
        get_cities();
    });
</script>