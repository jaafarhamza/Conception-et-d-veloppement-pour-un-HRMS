<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Error Message -->
        @if(session('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Company Information -->
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-gray-900">Company Information</h2>

                <!-- Company Name -->
                <div>
                    <x-input-label for="company_name" :value="__('Company Name')" />
                    <x-text-input id="company_name" class="block mt-1 w-full" 
                                 type="text" 
                                 name="company_name" 
                                 :value="old('company_name')" 
                                 required 
                                 autofocus />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <!-- Business Sector -->
                <div>
                    <x-input-label for="business_sector" :value="__('Business Sector')" />
                    <x-text-input id="business_sector" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="business_sector" 
                                 :value="old('business_sector')" 
                                 required />
                    <x-input-error :messages="$errors->get('business_sector')" class="mt-2" />
                </div>

                <!-- Registration Number -->
                <div>
                    <x-input-label for="registration_number" :value="__('Registration Number')" />
                    <x-text-input id="registration_number" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="registration_number" 
                                 :value="old('registration_number')" 
                                 required />
                    <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                </div>

                <!-- Company Email -->
                <div>
                    <x-input-label for="company_email" :value="__('Company Email')" />
                    <x-text-input id="company_email" 
                                 class="block mt-1 w-full" 
                                 type="email" 
                                 name="company_email" 
                                 :value="old('company_email')" 
                                 required />
                    <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                </div>

                <!-- Company Phone -->
                <div>
                    <x-input-label for="company_phone" :value="__('Company Phone')" />
                    <x-text-input id="company_phone" 
                                 class="block mt-1 w-full" 
                                 type="tel" 
                                 name="company_phone" 
                                 :value="old('company_phone')" 
                                 required />
                    <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                </div>

                <!-- Company Address -->
                <div>
                    <x-input-label for="company_address" :value="__('Company Address')" />
                    <textarea id="company_address" 
                              name="company_address" 
                              class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                              rows="3" 
                              required>{{ old('company_address') }}</textarea>
                    <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                </div>

                <!-- Company Logo -->
                <div>
                    <x-input-label for="company_logo" :value="__('Company Logo')" />
                    <input id="company_logo" 
                           type="file" 
                           name="company_logo" 
                           class="block mt-1 w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100"
                           accept="image/*" />
                    <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    <x-input-error :messages="$errors->get('company_logo')" class="mt-2" />
                </div>
            </div>

            <!-- Admin Information -->
            <div class="space-y-4 mt-8">
                <h2 class="text-2xl font-bold text-gray-900">Admin Information</h2>

                <!-- Admin First Name -->
                <div>
                    <x-input-label for="admin_first_name" :value="__('First Name')" />
                    <x-text-input id="admin_first_name" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="admin_first_name" 
                                 :value="old('admin_first_name')" 
                                 required />
                    <x-input-error :messages="$errors->get('admin_first_name')" class="mt-2" />
                </div>

                <!-- Admin Last Name -->
                <div>
                    <x-input-label for="admin_last_name" :value="__('Last Name')" />
                    <x-text-input id="admin_last_name" 
                                 class="block mt-1 w-full" 
                                 type="text" 
                                 name="admin_last_name" 
                                 :value="old('admin_last_name')" 
                                 required />
                    <x-input-error :messages="$errors->get('admin_last_name')" class="mt-2" />
                </div>

                <!-- Admin Email -->
                <div>
                    <x-input-label for="admin_email" :value="__('Email')" />
                    <x-text-input id="admin_email" 
                                 class="block mt-1 w-full" 
                                 type="email" 
                                 name="admin_email" 
                                 :value="old('admin_email')" 
                                 required />
                    <x-input-error :messages="$errors->get('admin_email')" class="mt-2" />
                </div>

                <!-- Admin Phone -->
                <div>
                    <x-input-label for="admin_phone" :value="__('Phone Number')" />
                    <x-text-input id="admin_phone" 
                                 class="block mt-1 w-full" 
                                 type="tel" 
                                 name="admin_phone" 
                                 :value="old('admin_phone')" 
                                 required />
                    <x-input-error :messages="$errors->get('admin_phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" 
                                 class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 required 
                                 autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" 
                                 class="block mt-1 w-full"
                                 type="password"
                                 name="password_confirmation" 
                                 required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>