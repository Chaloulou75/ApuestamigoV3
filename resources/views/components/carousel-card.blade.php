<div class="animate__animated animate__lightSpeedInLeft max-w-xl mx-auto pt-4 my-4"> 

    <carousel-component>

        @foreach($equipes as $equipe)

        <img class="inline w-12 h-10 pr-2 carousel-cell" loading="lazy" src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}" loading="lazy" alt="club">

        @endforeach 
        
    </carousel-component>
</div>
