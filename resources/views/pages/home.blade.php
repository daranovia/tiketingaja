@extends('layouts.master')

@section('title','Home')

@section('content')

{{-- HERO SECTION --}}

<section id="home" class="relative w-full px-8 py-10 pt-5 bg-white">
    <div class="relative w-full h-185 overflow-hidden rounded-3xl shadow-lg">

        <img src="/assets/pesawat.jpg" alt="Pesawat" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative z-10 flex flex-col justify-center h-full px-10 md:px-20 text-white text-center">
            <p class="text-sm mb-2 uppercase tracking-widest font-medium">
                Make your trip a memory
            </p>

            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6 max-w-2xl">
                Experience The Magic Of Flight!
            </h1>

            <div>
                <button class="bg-indigo-700 hover:bg-indigo-800 text-white px-8 py-4 rounded-full font-semibold transition-all transform hover:scale-105">
                    Book A Trip Now
                </button>
            </div>
        </div>

    </div>
</section>



{{-- POPULAR DESTINATION --}}
<section id="about" class="max-w-7xl mx-auto px-6 pt-2">

    <h2 class="text-2xl font-bold mb-2 text-start">
       Top Flight tipe
    </h2>
    <h4 class="text-sm font-reguler mb-6  text-gray-400 text-start">
       Nikmati pesawat yang nyaman untuk menemani liburan dan destinasi kalian dengan pembelian di tiketing yang cepat dan terpercaya.
    </h4>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-8 py-10">

    <div class="md:col-span-2 bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-200 flex flex-col">
        <img src="/assets/airline.jpg" alt="airline" class="w-full h-55 object-cover">
        <div class="px-6 pb-6 pt-4 flex flex-col flex-grow">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">#Tour2025</span>
            <h3 class="text-xl font-bold text-gray-800 leading-tight mb-3">LUXURY TRAVEL AND AIRLINES</h3>
            <p class="text-gray-500 text-sm mb-6">Luxury travel and airlines offer opulence, comfort, and exclusivity for discerning travellers.</p>
            <div class="mt-auto">
                <button class="bg-sky-200 text-sky-700 px-4 py-2 rounded-full text-xs font-bold w-max hover:bg-sky-300 transition">
                    Learn More
                </button>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-200 flex flex-col">
        <img src="/assets/airline.jpg" alt="airline" class="w-full h-55 object-cover">
        <div class="px-6 pb-6 pt-4 flex flex-col flex-grow">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">#Tour2025</span>
            <h3 class="text-xl font-bold text-gray-800 leading-tight mb-3">LUXURY TRAVEL AND AIRLINES</h3>
            <p class="text-gray-500 text-sm mb-6">Luxury travel and airlines offer opulence, comfort, and exclusivity for discerning travellers.</p>
            <div class="mt-auto">
                <button class="bg-sky-200 text-sky-700 px-4 py-2 rounded-full text-xs font-bold w-max hover:bg-sky-300 transition">
                    Learn More
                </button>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-200 flex flex-col">
        <img src="/assets/airline.jpg" alt="airline" class="w-full h-55 object-cover">
        <div class="px-6 pb-6 pt-4 flex flex-col flex-grow">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">#Tour2025</span>
            <h3 class="text-xl font-bold text-gray-800 leading-tight mb-3">LUXURY TRAVEL AND AIRLINES</h3>
            <p class="text-gray-500 text-sm mb-6">Luxury travel and airlines offer opulence, comfort, and exclusivity for discerning travellers.</p>
            <div class="mt-auto">
                <button class="bg-sky-200 text-sky-700 px-4 py-2 rounded-full text-xs font-bold w-max hover:bg-sky-300 transition">
                    Learn More
                </button>
            </div>
        </div>
    </div>

</div>




</section>


{{-- BOOK SECTION --}}
<section class="max-w-5xl mx-auto py-16 text-center">

    <h2 class="text-3xl font-bold mb-6">
        Journey To The Skies Made Simple!
    </h2>

    <div class="bg-blue-500 text-white rounded-2xl p-10 inline-block">
        <h3 class="text-xl font-semibold mb-2">
            Book A Ticket
        </h3>

        <p class="text-sm opacity-90">
            Traveling is a wonderful way to explore new places.
        </p>
    </div>

</section>

@endsection
