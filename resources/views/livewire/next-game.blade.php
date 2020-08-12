<div class="container" wire:poll.1s>
    <div
        class="animate__animated animate__flipInX border-2 rounded-full border-francaverde flex-auto text-white text-center bg-francagris px-4 py-2 m-2">
        <p><svg class="inline w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg> {{__('all.Start of the next match')}} <span class="text-francaverde">: {{ $nextGameDate }}</span></p>
    </div>
</div>
