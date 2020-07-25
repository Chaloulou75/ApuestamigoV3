<div class="animate__animated animate__flipInX max-w-xl mx-auto pt-4 my-4"> 

    <carousel-component>

        @foreach($equipes as $equipe)

        <img class="inline w-12 h-10 pr-2 carousel-cell" data-flickity-lazyload="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}" alt="c" >

        @endforeach 
        
    </carousel-component>
</div>
