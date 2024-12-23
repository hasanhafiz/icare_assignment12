@extends('layouts.master')
@section('content')
<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
    <!-- Cover Container -->
    <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        
        <!-- /Profile Info -->
        @if ( session('status') )
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{ session('status') }}
          </div>        
        @endif        
        
        <!-- Profile Info -->
        <div class="flex gap-4 justify-center flex-col text-center items-center">
            <!-- User Meta -->
            <div>
                <h1 class="font-bold md:text-2xl">{{ auth()->user()->fullname }}</h1>
                <p class="text-gray-700">{{ auth()->user()->bio }}</p>
            </div>
            <!-- / User Meta -->
        </div>
        
        <!-- Profile Stats -->
        <div
          class="flex flex-row gap-16 justify-center text-center items-center">
          <!-- Total Posts Count -->
          <div class="flex flex-col justify-center items-center">
            <h4 class="sm:text-xl font-bold">{{ $posts_count }}</h4>
            <p class="text-gray-600">Posts</p>
          </div>

          <!-- Total Comments Count -->
          <div class="flex flex-col justify-center items-center">
            <h4 class="sm:text-xl font-bold">14</h4>
            <p class="text-gray-600">Comments</p>
          </div>
        </div>
        <!-- /Profile Stats -->        
        
        <!-- Edit Profile Button (Only visible to the profile owner) -->
        <a href="{{ route('profiles.edit', auth()->user()->id, 'edit') }}" type="button"
            class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
            Edit Profile
        </a>
        <!-- /Edit Profile Button -->
    </section>
    <!-- /Cover Container -->
    
    <!-- Barta Create Post Card -->
    <form
    method="POST" action="{{ route('posts.store') }}"
    enctype="multipart/form-data"
    class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    @csrf
    <!-- Create Post Card Top -->
    <div>
        <div class="flex items-start /space-x-3/">
            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
            <textarea
                class="block w-full p-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                name="body"
                rows="2"
                placeholder="What's going on, {{ auth()->user()->username }}?"></textarea>
            </div>
        </div>
    </div>

    <!-- Create Post Card Bottom -->
    <div>
    <!-- Card Bottom Action Buttons -->
    <div class="flex items-center justify-end">
        <div>
        <!-- Post Button -->
        <button
            type="submit"
            class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
            Post
        </button>
        <!-- /Post Button -->
        </div>
    </div>
    <!-- /Card Bottom Action Buttons -->
    </div>
    <!-- /Create Post Card Bottom -->
    </form>    
    
    
    
</main>
@endsection