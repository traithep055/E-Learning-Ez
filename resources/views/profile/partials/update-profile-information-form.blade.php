<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Existing Name Input (Keep it) -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Existing Email Input (Keep it) -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- ... Existing email verification code ... -->
        </div>

        <!-- Add Student ID Input -->
        <div>
            <x-input-label for="stu_id" :value="__('Student ID')" />
            <x-text-input id="stu_id" name="stu_id" type="text" class="mt-1 block w-full" :value="old('stu_id', $user->stu_id)" required autocomplete="stu_id" />
            <x-input-error class="mt-2" :messages="$errors->get('stu_id')" />
        </div>

        <!-- Add Firstname Input -->
        <div>
            <x-input-label for="firstname" :value="__('Firstname')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <!-- Add Lastname Input -->
        <div>
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)" required autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <!-- Add Field of Study Input -->
        <div>
            <x-input-label for="field_of_study" :value="__('Field of Study')" />
            <x-text-input id="field_of_study" name="field_of_study" type="text" class="mt-1 block w-full" :value="old('field_of_study', $user->field_of_study)" required autocomplete="field_of_study" />
            <x-input-error class="mt-2" :messages="$errors->get('field_of_study')" />
        </div>

        <!-- The rest of your form remains the same -->
        <!-- ... -->

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif

        </div>
    </form>
</section>
