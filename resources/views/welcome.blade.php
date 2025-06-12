@vite('resources/css/app.css')

<x-layouts.base :showSidebar="false">
<x-slot name="title">
    {{ __('About') }}
</x-slot>

<div class="min-h-screen bg-transparent relative">
    <div class="h-screen w-full bg-welcome-gradient flex items-center justify-center">
        <div class="max-w-3xl text-center bg-white p-5 rounded-2xl shadow-xl border">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6">
                {{ __('Information system for your fraternity!') }}
            </h1>
            <p class="text-lg text-gray-700 leading-relaxed">
                {{ __('Manage events, roles, communication and more – all in one place. Built to help your organization stay connected, organized, and efficient.') }}
            </p>

        </div>
    </div>
</div>

</x-layouts.base>
