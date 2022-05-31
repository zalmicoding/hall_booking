<script src="{{asset('assets')}}/js/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets')}}/library/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/library/bootstrap/js/bootstrap-dropdownhover.min.js"></script>
<script src="{{asset('assets')}}/library/owlcarousel/js/owl.carousel.min.js"></script>
<script src="{{asset('assets')}}/library/select2/js/select2.min.js"></script>
<script src="{{asset('assets')}}/library/jquery-ui/js/jquery-ui.min.js"></script>
<script src="{{asset('assets')}}/library/jquery-ui/js/jquery.ui.touch-punch.min.js"></script>
<script src="{{asset('assets')}}/library/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{asset('assets')}}/library/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{asset('assets')}}/library/datepicker/js/datepicker.js"></script>
<script src="{{asset('assets')}}/js/script.js"></script>
<script src="https://js.stripe.com/v3/"></script>

@if ($errors && (is_array($errors) || $errors->all()))
    <script type="text/javascript">
        $(document).ready(function () {

            var front_modal = $('.front_login_modal').modal('show');

            $('.login_panel').removeClass(['show', 'active']);
            $('.login_panel_title').removeClass(['show', 'active']);

            $('.register_panel').addClass(['show', 'active']);
            $('.register_panel_title').addClass(['show', 'active']);

        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function() {

    $("#owl-demo").owlCarousel({

        autoPlay: 1000, //Set AutoPlay to 3 seconds

        items : 4,
        itemsDesktop : [1199,]4,
        itemsDesktopSmall : [979,4]

    });

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#submit_comment').click(function () {
            let id = $('#hall_detail').attr('data-id');
            let title = $('#hall_detail').attr('data-title');

            $('#append_hall_id').val(id);
            $('#append_hall_title').val(title);
        });
    });

    $(document).ready(function () {
        $(".hall_payment_btn").click(function () {
            let hall_id = $(this).attr('data-hall-id');
            let hall_title = $(this).attr('data-hall-title');
            let hall_event = $(this).attr('data-hall-event');
            let hall_price = $(this).attr('data-hall-price');

            let hall_modal = $("#request_quote").attr("data-hall-id", hall_id);

            $("#hallId").val(hall_id);
            $("#hallTitle").val(hall_title);
            $("#ShowHallTitle").val(hall_title);
            $("#hallPrice").val(hall_price);
            $("#ShowHallPrice").val(hall_price);
            $("#hallEvents").val(hall_event);

            hall_modal.modal('show');
        });
    });
</script>

{{-- Setting stripe publishable key to set the stripe card elements --}}
<script type="text/javascript">
    // Set your publishable key: remember to change this to your live publishable key in production
    // See your keys here: https://dashboard.stripe.com/apikeys
    // var Publishable_key = "{{ env('STRIPE_PUBLIC_KEY') }}";
    var stripe = Stripe("pk_test_51K3NIIAcehZZuafTtf9NQ6PZfGuNnYmHvbraQAqCUKxmin4bKDknYpnKAssVr6TdYGfpje3LjiiYefBlClZeKzDA00b6dHZEky");
    // Set up Stripe.js and Elements to use in checkout form
    var form = document.getElementById("payment-form");
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createSource(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the source to your server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeSource');
                hiddenInput.setAttribute('value', result.source.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
      });
    var elements = stripe.elements();
    var style = {
    base: {
    color: "#32325d",
    }
    };
    var card = elements.create("card", { style: style });
    card.mount("#card-element");
</script>

{{-- Displaying the card errors into the form --}}
<script type="text/javascript">
    card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });
</script>
