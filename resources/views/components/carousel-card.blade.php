<div class="animate__animated animate__flipInX max-w-xl text-center mx-auto py-2 my-4"> 

        @foreach($equipes as $equipe)

        <img class="inline w-12 h-10 pr-2" src="{{ $equipe->logourl ? url($equipe->logourl) : URL::to('/img/' .$equipe->logo) }}" loading="lazy" alt="club" >

        @endforeach         
    
</div>

