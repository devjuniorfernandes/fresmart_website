<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-3 bg-[#45B500] hover:bg-[#3a9900] active:bg-[#2e7a00] border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-[#45B500] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
