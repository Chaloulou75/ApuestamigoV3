<div class="max-w-xl text-center mx-auto py-2 my-4" wire:poll.4s
    x-data="{show: false}"
    x-init="setTimeout(() => { show = true })"
    x-show.transition.in.duration.300ms.scale.10="show"
    x-show.transition.out.duration.200ms.scale.85="show">

    @foreach($equipes as $equipe)
    <img class="inline w-12 h-10 pr-2"
        src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}" loading="lazy"
        alt="club">
    @endforeach

</div>
