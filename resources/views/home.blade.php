<x-layouts.app>
    <div class="h-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                @include('affiliate::partials.stats')
                @include('affiliate::partials.personal-link')
                @include('affiliate::partials.paypal-address')
            </div>
        </div>
    </div>
</x-layouts.app>