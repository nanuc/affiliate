@props(['color' => 'indigo-600', 'caption', 'value'])
<div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
        {{ $caption }}
    </dt>
    <dd class="order-1 text-5xl font-extrabold text-{{ $color }}">
        {{ $value }}
    </dd>
</div>