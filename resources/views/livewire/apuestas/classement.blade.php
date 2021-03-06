<div class="animate__animated animate__headShake py-4 flex justify-center">
    <table class="table-auto w-full bg-white shadow-md border-t-4 border-solid rounded-lg border-francaverde mb-4">
        <thead class="table-header-group bg-francagris text-white text-xs">
            <tr>
                <th scope="col" class="p-3 px-5 font-thin">#</th>
                <th scope="col" class="text-left p-3 px-5 font-thin">{{ __('all.Name')}}</th>
                <th scope="col" class="text-left p-3 px-5 font-thin">{{ __('all.Club')}}</th>
                <th scope="col" class="text-center p-3 px-5 font-thin">{{ __('all.Points')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ligue->users as $user)
            <tr class="@if( $user->id == Auth::user()->id ) bg-blue-100 @endif">
                <td scope="row" class="py-2 px-4 text-center @if($loop->first) border-l-4 border-francaverde @endif">
                    {{ $loop->iteration }} </td>
                <td
                    class="py-2 px-4 hover:underline hover:text-francaverde text-sm @if( $user->id == Auth::user()->id ) font-semibold @endif">
                    <a href="{{ action('ApuestasController@show', [$ligue, $user, $fecha = $journee ]) }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td class="py-2 px-4">
                    <img class="inline w-10 h-8 pr-2" loading="lazy"
                        src="{{ $user->equipe->logourl ? url($user->equipe->logourl) : URL::to('/img/' .$user->equipe->logo) }}"
                        loading="lazy" alt="{{ $user->equipe->name}}">
                    <span class="hidden md:inline-block text-xs">{{ $user->equipe->name}}</span>
                </td>
                <td class="text-center font-medium py-2 px-4">{{ $user->pivot->totalPoints }}</td>
            </tr>
            @empty
            <tr class="spinner text-center"></tr>
            @endforelse
        </tbody>
    </table>
</div>
