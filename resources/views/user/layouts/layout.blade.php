<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    @yield('title')

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user_hexashop/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('user_hexashop/assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('user_hexashop/assets/css/templatemo-hexashop.css') }}">

    <link rel="stylesheet" href="{{ asset('user_hexashop/assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('user_hexashop/assets/css/lightbox.css') }}">

    <link rel="stylesheet" href="{{ asset('user_hexashop/assets/css/styled.css') }}">

    @yield('css');
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    @include('user.partials.header')
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    @yield('content')'

    <!-- ***** Footer Start ***** -->
    @include('user.partials.footer')


    <!-- jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('user_hexashop/assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('user_hexashop/assets/js/popper.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('user_hexashop/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/accordions.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/slick.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('user_hexashop/assets/js/isotope.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Global Init -->
    <script src="{{ asset('user_hexashop/assets/js/custom.js') }}"></script>

    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Find the input element
            var quantityInput = $("input[name='quantity']");

            // Click event for the plus button
            $(".plus").click(function() {
                // Increment the value
                quantityInput.val(parseInt(quantityInput.val()) + 1);
            });

            // Click event for the minus button
            $(".minus").click(function() {
                // Ensure the value doesn't go below 1
                if (parseInt(quantityInput.val()) > 1) {
                    // Decrement the value
                    quantityInput.val(parseInt(quantityInput.val()) - 1);
                }
            });
        });
    </script>

    @yield('js');
</body>

</html>
