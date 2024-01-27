  {{-- <!-- Preloader Start -->
  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend') }}/assets/imgs/theme/loading.gif" alt="" />
            </div>
        </div>
    </div>
</div> --}}
<!-- Vendor JS-->
  <script src="{{ asset('frontend') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/slick.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.syotimer.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/waypoints.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/wow.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/perfect-scrollbar.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/magnific-popup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/select2.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/counterup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.countdown.min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/images-loaded.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/isotope.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/scrollup.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.vticker-min.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.theia.sticky.js"></script>
  <script src="{{ asset('frontend') }}/assets/js/plugins/jquery.elevatezoom.js"></script>
  <!-- Template  JS -->
  <script src="{{ asset('frontend') }}/assets/js/main.js?v=5.3"></script>
  <script src="{{ asset('frontend') }}/assets/js/shop.js?v=5.3"></script>
  {{-- jquery cdn --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
  {{-- fontawesome cdn  --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>

    $(document).ready(function(){
        
        $("#photo").change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $("#selected_photo").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

{{-- toastr js --}}
<script>

    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.success("{{ session('message') }}");
    @endif

</script> 

</body>

</html>