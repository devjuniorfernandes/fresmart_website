@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#45B500] focus:ring-[#45B500] focus:ring-opacity-50 rounded-xl shadow-sm']) }}>
