<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/pricing.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        @foreach($sliders as $key=>$slider)
        .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{$key + 1}}) .item {
            @if (config('app.env')=='local')
              background: url({{'/uploads/slider/'}}{{$slider->image}});
            @else
              background: url({{$slider->image}});
            @endif            
            background-size: cover;
            /*background-position: bottom;*/
        }
        @endforeach

    </style>

    <script src="{{asset('frontend/js/jquery-1.11.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.flexslider.min.js')}}"></script>
    <script type="text/javascript">
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                controlsContainer: ".flexslider-container"
            });
        });
    </script>

    {{--Google Map--}}
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var mapCanvas = document.getElementById('map-canvas');
            var mapOptions = {
                center: new google.maps.LatLng({{$map->latitude}}, {{$map->longitude}}),
                zoom: 16,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(mapCanvas, mapOptions)

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng({{$map->latitude}}, {{$map->longitude}}),
                title: "{{$map->title}}"
            });

            // To add the marker to the map, call setMap();
            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <style>
        .flex-direction-nav li a {
            background: url({{asset('frontend/images/a17.png')}}) no-repeat 0 0;
        }
    </style>
</head>
