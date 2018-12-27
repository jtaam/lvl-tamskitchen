<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="copyright text-center">
                    <p>
                        &copy; Copyright, 2015 <a href="#">Your Website Link.</a> Theme by <a href="http://themewagon.com/"  target="_blank">ThemeWagon</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.mixitup.min.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.validate.js')}}"></script>
<script src="{{asset('frontend/js/jquery.hoverdir.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/js/jQuery.scrollSpeed.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/js/script.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-datetimepicker.min.js')}}"></script>
{{--<script src="http://127.0.0.1:8888/public/cdn/bootstrap-toastr/js/toastr.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: "dd MM yyyy - hh:ii",
            showMeridian: true,
            autoclose:true,
            todayBtn:true,
        });
    })
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{$error}}');
        </script>
    @endforeach
@endif

{!! Toastr::message() !!}