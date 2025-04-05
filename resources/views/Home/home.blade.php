@extends('Layout.guest')

@section('content')
    


      <section class="w-[100%] relative">
        <video
          autoplay
          loop
          class="h-[100vh] w-[100%] object-cover hidden md:block"
        >
          <source src="{{ asset('assets/img/stad-foot.mp4') }}" type="video/mp4" />
        </video>
        <div class="md:hidden">
          <img
            src="{{ asset('assets/img/stud-red.svg') }}"
            class="h-[100vh] w-[100%] object-cover brightness-[50%]"
            alt=""
          />
        </div>
        <div
          class="md:bg-[#7c00008a] w-[100%] h-[100vh] absolute top-0 left-0 z-5 flex justify-center items-center"
        >
          <!-- <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="animate-bounce"
            alt=""
          /> -->
           <!-- Overlay -->
      <div class="absolute inset-0  flex flex-col justify-center items-center px-6 md:px-20">
        <div class="max-w-4xl mx-auto text-center hero-text">
          <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
            Stop Searching For Your Perfect Match <span class="text-yellow-400"> Create It</span>
          </h1>
          
        
        </div>
        
        <div class="absolute bottom-24 md:bottom-2 animate-bounce">
          <img
            src="{{ asset('assets/img/soccer-red-removebg-preview.png') }}"
            class="w-32 md:w-48"
            alt="Soccer ball"
          />
        </div>
      </div>
      
        </div>
        <div
          class="text-white uppercase absolute top-[46%] right-[-11rem] rotate-[-90deg] tracking-[.7rem]"
        >
          <p class="w-max">make dream come true</p>
        </div>
      </section>
   
        
@endsection
