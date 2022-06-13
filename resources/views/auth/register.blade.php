<!-- Site favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/favicon-16x16.png') }}">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
</script>

<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="login.html">
                <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="">
            </a>
        </div>
        <div class="login-menu">
            <ul>
                <li><a href="{{route('login')}}">Login</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('vendors/images/register-page-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10" style="padding: 30px">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Register To DeskApp</h2>
                        </div><br>
                        <x-guest-layout>
                            
                        
                                <x-jet-validation-errors class="mb-4" />
                        
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                        
                                    <div>
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                        
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-jet-label for="terms">
                                                <div class="flex items-center">
                                                    <x-jet-checkbox name="terms" id="terms"/>
                        
                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-jet-label>
                                        </div>
                                    @endif
                        
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>
                        
                                        <x-jet-button class="ml-4">
                                            {{ __('Register') }}
                                        </x-jet-button>
                                    </div>
                                </form>
                        </x-guest-layout>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal"
        data-backdrop="static">Launch modal</button>
    <div class="modal fade submit_modal" id="success-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <x-jet-button class="ml-4 btn btn-primary wow zoomIn"> 
                    {{ __('Register') }}
                </x-jet-button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>


<script src="{{ asset('vendors/scripts/core.js') }}"></script>
<script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('vendors/scripts/process.js') }}"></script>
<script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
<script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>