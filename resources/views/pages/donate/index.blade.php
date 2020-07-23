@extends('layouts.app')

@section('content')

<div class="w-full md:w-4/5 mx-auto my-4">

		<h3 class="animate__animated animate__flipInX text-base text-center tracking-wide text-white py-2">
			{{__('all.Wanna`\' buy me a beer?') }}<span class="text-francaverde"> <svg class="h-5 w-5 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg></span>
		</h3>

		<div class="animate__animated animate__zoomInUp w-full max-w-md md:w-2/5 mx-auto my-4 rounded overflow-hidden bg-gray-100 shadow-lg">
		  {{-- <img class="w-full" src="/img/titreprog.jpg" alt="programme"> --}}
		  <img src="/img/misc/beer.jpg" loading="auto" class="fill-current object-cover w-40 h-40 rounded-full mx-auto p-2" alt="beer">
		  <div class="{{-- text-julien-gris --}} px-6 py-4">
		    <form action="{{ route('donate.store') }}" method="post" id="payment-form">
		    	@csrf
		    	@honeypot

				<div class="mb-2">
		            <label for="email" class="block text-francagris text-sm mb-1">
						<svg class="h-4 w-4 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
		            	{{ __('all.E-Mail Address') }}</label>
		           
	                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') bg-red-dark @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

	                @error('email')
	                    <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror           
		        </div>
		        <div class="mb-2">
		            <label for="cardholdername" class="block text-francagris text-sm mb-1">
		            	<svg class="h-4 w-4 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
		            	{{ __('all.Full Name on card') }}
		        	</label>

		            <input id="cardholdername" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
		             @error('cardholdername') bg-red-dark @enderror" name="cardholdername" value="{{ old('cardholdername') }}" required autocomplete="cardholdername">

		            @error('cardholdername')
		                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
		            
		        </div>
		        <div class="mb-2">
	                <label for="address" class="block text-francagris text-sm mb-1">
						<svg class="h-4 w-4 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
	                	{{ __('all.address')}}
	            	</label>
	                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address">

	                @error('address')
		                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
	            </div>

	            <div class="mb-2">
	                <label for="city" class="block text-francagris text-sm mb-1">{{ __('all.city') }} </label>
	                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" name="city">
	                @error('city')
		                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
	            </div>

	            <div class="mb-2">
	                <label for="postalcode" class="block text-francagris text-sm mb-1">Postal Code</label>
	                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="postalcode" name="postalcode">
	                @error('postalcode')
		                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
	            </div>

	            <div class="mb-2">
	                <label for="country" class="block text-francagris text-sm mb-1">
						<svg class="h-4 w-4 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
	                	{{ __('all.country') }} 
	                </label>
	                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="country" name="country">
	                @error('country')
		                <span class=" mt-1 text-sm text-orange-400" role="relative px-3 py-3 mb-4 border rounded">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
	            </div>
				<div class="mb-2">
				    <label for="card-element" class="block text-francagris text-sm mb-1">
				      <svg class="h-4 w-4 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
				      {{ __('all.Card number')}}
				    </label>
				    <div id="card-element" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-6">
				      <!-- A Stripe Element will be inserted here. -->
				    </div>
				    <!-- Used to display form errors. -->
				    <div id="card-errors" role="alert"></div>
				</div>

			    <button id="card-button" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
			    	Buy me a beer! 5
			    	<svg class="h-6 w-6 inline" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
			    </button>
			</form>
		  </div>		  
		</div>	
</div>

@endsection

@push('scripts')

<script>
	document.addEventListener("turbolinks:load", function() {
	
	// Create a Stripe client.
	var stripe = Stripe('pk_test_Es5qKBFBNCHUEswJ4egdQPXJ00mEYUCQtr');

	// Create an instance of Elements.
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
	  base: {
	    color: '#32325d',
	    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
	    fontSmoothing: 'antialiased',
	    fontSize: '14px',
	    '::placeholder': {
	      color: '#aab7c4'
	    }
	  },
	  invalid: {
	    color: '#fa755a',
	    iconColor: '#fa755a'
	  }
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {
		style: style,
		hidePostalCode : true
	});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	card.on('change', ({error}) => {
	  const displayError = document.getElementById('card-errors');
	  if (error) {
	    displayError.textContent = error.message;
	  } else {
	    displayError.textContent = '';
	  }
	});

	const cardHolderName = document.getElementById('cardholdername');
	const email = document.getElementById('email');

	// Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      var options = {
        name: cardHolderName.value
      }

      stripe.createToken(card, options).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
        }
      });
    });

	function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      // Submit the form
      form.submit();
    }
	})();

</script>

@endpush
