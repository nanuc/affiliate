<div class="bg-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-12 lg:px-8 lg:flex lg:items-center">
        <div class="lg:w-0 lg:flex-1">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                {{ __('affiliate::gui.paypal.header') }}
            </h2>
            <p class="mt-3 max-w-3xl text-lg text-gray-500">
                {{ __('affiliate::gui.paypal.text') }}
            </p>
        </div>
        <div class="mt-8 lg:mt-0 lg:ml-8">
            <form class="sm:flex" action="">
                @csrf
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" name="emailAddress" type="email" autocomplete="email" required class="w-full px-5 py-3 border border-gray-300 shadow-sm placeholder-gray-400 focus:ring-1 focus:ring-{{ $paypalColor }}-500 focus:border-{{ $paypalColor }}-500 sm:max-w-xs rounded-md" placeholder="Enter your email" value="{{ auth()->user()->affiliate_paypal_email }}">
                <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                    <button type="submit" class="w-full flex items-center justify-center py-3 px-5 border border-transparent text-base font-medium rounded-md text-white bg-{{ $paypalColor }}-600 hover:bg-{{ $paypalColor }}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $paypalColor }}-500">
                        Update
                    </button>
                </div>
            </form>
            <div class="text-sm text-gray-800 mt-2" id="thanks"></div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('submit', function (event) {
        event.preventDefault();

        fetch('{{ route('affiliate.email') }}', {
            method: 'POST',
            body: new FormData(event.target),
        }).then(function (response) {
            document.getElementById("thanks").innerHTML = '{{ __('affiliate::gui.paypal.thanks') }}';
        });
    });
</script>
