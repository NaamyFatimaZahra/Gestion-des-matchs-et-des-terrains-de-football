@extends('Layout.guest')

@section('content')
    <section class="bg-gradient-to-b from-[#7c0000] to-[#500000] min-h-screen">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <pattern id="pattern-circles" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse" patternContentUnits="userSpaceOnUse">
                        <circle id="pattern-circle" cx="10" cy="10" r="2" fill="#fff"></circle>
                    </pattern>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-circles)"></rect>
                </svg>
            </div>

            <div class="container mx-auto px-6 lg:px-8 py-24">
                <div class="flex flex-col lg:flex-row items-center">
                    <!-- Text Content -->
                    <div class="lg:w-1/2 text-white z-10">
                        <h1 class="text-4xl md:text-5xl font-bold mb-6">About <span class="text-yellow-400">MatchMaker</span></h1>
                        <p class="text-lg mb-8">We're revolutionizing how football enthusiasts connect, play, and enjoy the beautiful game together. Our platform bridges the gap between players looking for teams and venues seeking bookings.</p>
                        <div class="flex space-x-4">
                            <a href="#mission" class="inline-block px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-[#7c0000] font-semibold rounded-lg transition duration-300">Our Mission</a>
                            <a href="#features" class="inline-block px-6 py-3 border-2 border-white hover:bg-white hover:text-[#7c0000] text-white font-semibold rounded-lg transition duration-300">Features</a>
                        </div>
                    </div>
                    
                    <!-- Image -->
                    <div class="lg:w-1/2 mt-12 lg:mt-0 z-10">
                        <div class="relative">
                            <div class="w-full h-96 bg-[#5c0000] rounded-lg shadow-2xl overflow-hidden">
                                <img src="{{ asset('assets/img/about-football.jpg') }}" class="w-full h-full object-cover opacity-80" alt="Football players">
                            </div>
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-yellow-400 rounded-full flex items-center justify-center">
                                <img src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}" class="w-24 h-24" alt="Soccer ball">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div id="mission" class="py-20 bg-[#5c0000]">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center">
                    <!-- Image -->
                    <div class="lg:w-2/5 order-2 lg:order-1 mt-12 lg:mt-0">
                        <div class="relative">
                            <div class="h-[400px] w-[400px] rounded-full overflow-hidden border-8 border-yellow-400">
                                <img src="{{ asset('assets/img/mission-image.jpg') }}" class="w-full h-full object-cover" alt="Our mission">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="lg:w-3/5 lg:pl-16 order-1 lg:order-2">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Our <span class="text-yellow-400">Mission</span></h2>
                        <div class="space-y-8 text-white">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-400 text-[#7c0000]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-semibold">Connect Players</h3>
                                    <p class="mt-2">Bringing football enthusiasts together, helping them find teams and matches that fit their schedule and skill level.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-400 text-[#7c0000]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-semibold">Simplify Venue Booking</h3>
                                    <p class="mt-2">Making it easy to find and book football fields in your city, with transparent pricing and availability.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-400 text-[#7c0000]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-semibold">Grow the Community</h3>
                                    <p class="mt-2">Building a thriving football community where players can meet new friends and enjoy the sport they love.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-20">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Platform <span class="text-yellow-400">Features</span></h2>
                    <p class="text-white text-lg max-w-3xl mx-auto">Our comprehensive suite of tools designed to make organizing and joining football matches easier than ever.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <!-- Feature Card 1 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Advanced Search</h3>
                        <p class="text-gray-200">Find matches and venues based on your location, availability, and preferences with our powerful search system.</p>
                    </div>
                    
                    <!-- Feature Card 2 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Easy Booking</h3>
                        <p class="text-gray-200">Book football fields with just a few clicks and manage all your reservations from your personal dashboard.</p>
                    </div>
                    
                    <!-- Feature Card 3 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Real-time Notifications</h3>
                        <p class="text-gray-200">Stay updated with match invitations, booking confirmations, and player responses through our notification system.</p>
                    </div>
                    
                    <!-- Feature Card 4 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Team Communication</h3>
                        <p class="text-gray-200">Communicate with team members through our integrated messaging system to coordinate match details.</p>
                    </div>
                    
                    <!-- Feature Card 5 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Player Profiles</h3>
                        <p class="text-gray-200">Create your personalized profile showcasing your availability, playing history, and preferences.</p>
                    </div>
                    
                    <!-- Feature Card 6 -->
                    <div class="bg-[#5c0000] rounded-xl p-8 shadow-lg transform transition duration-300 hover:-translate-y-2">
                        <div class="h-14 w-14 rounded-full bg-yellow-400 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#7c0000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Match History</h3>
                        <p class="text-gray-200">Keep track of all your matches, bookings, and teams you've played with through your personal dashboard.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="py-20 bg-[#4c0000]">
            <div class="container mx-auto px-6 lg:px-8">
                <div class="bg-gradient-to-r from-[#7c0000] to-[#9c0000] rounded-xl p-10 shadow-2xl relative overflow-hidden">
                    <!-- Background Elements -->
                    <div class="absolute right-0 top-0 h-full w-1/3 bg-[#5c0000] opacity-20 transform -skew-x-12"></div>
                    <div class="absolute right-20 bottom-10">
                        <img src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}" class="w-20 h-20 animate-bounce" alt="Soccer ball">
                    </div>
                    
                    <div class="relative z-10 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
                        <div class="md:w-2/3 mb-8 md:mb-0">
                            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Find Your <span class="text-yellow-400">Perfect Match?</span></h2>
                            <p class="text-gray-100 text-lg">Join our community of football enthusiasts today and start playing!</p>
                        </div>
                        <div>
                            <a href="/register" class="inline-block px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-[#7c0000] font-bold rounded-lg text-lg transition duration-300 transform hover:scale-105">Sign Up Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="py-10 bg-[#3c0000] text-center">
            <div class="container mx-auto px-6 lg:px-8">
                <p class="text-white uppercase tracking-[.5rem]">make dream come true</p>
            </div>
        </div>
    </section>
@endsection