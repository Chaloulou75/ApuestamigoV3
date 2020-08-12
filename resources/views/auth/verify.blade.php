@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
            <div
                class="relative flex flex-col min-w-0 rounded break-words bg-francagris border-b-1 border-francaverde text-white">
                <div class="py-3 px-6 mb-0 bg-francagris border-b-1 border-francaverde text-white">
                    {{ __('all.Verify Your Email Address') }}</div>

                <div class="flex-auto p-6">
                    @if (session('resent'))
                    <div class="relative px-3 py-3 mb-4 border rounded text-green-700 border-green-dark bg-green-lighter"
                        role="relative px-3 py-3 mb-4 border rounded">
                        {{ __('all.A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('all.Before proceeding, please check your email for a verification link.') }}
                    {{ __('all.If you did not receive the email') }}, <a
                        href="{{ route('verification.resend') }}">{{ __('all.click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
