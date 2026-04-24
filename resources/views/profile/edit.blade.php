<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Update profile info -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update password -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete user -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- UPLOAD AVATAR -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    {{-- prikaz slike --}}
                    @if (Auth::user()->avatar)
                        <img src="/storage/images/avatars/{{ Auth::user()->avatar }}" width="150" class="mb-4">
                    @endif

                    <form method="POST" action="{{ route('profile.changeAvatar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Upload Profile Image
                            </label>

                            <input type="file" name="profile_image"
                                class="mt-2 block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300"
                                required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                style="margin-top:15px; padding:10px; background:#2563eb; color:white; border:none; border-radius:6px;">
                                Upload
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
