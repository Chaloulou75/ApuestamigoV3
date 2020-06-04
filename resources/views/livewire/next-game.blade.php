<div class="container" wire:poll.1s>
    <div class="border-2 rounded-full border-francaverde flex-auto text-white text-center bg-francagris px-4 py-2 m-2">
       <p> {{__('all.Start of the next match')}} <span class="text-francaverde">: {{ $nextGameDate }}</span></p> 
    </div>
</div>

@push('scripts')
<script>
        document.addEventListener('livewire:load', () => {
            setInterval(function(){ window.livewire.emit('alive'); }, 1800000);
        });
</script>
@endpush
