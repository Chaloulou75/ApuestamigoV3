<div
    class="createLigueCard animate__animated animate__fadeIn animate__slow flex-grow w-full lg:w-1/3 my-4 md:m-4 border-2 border-francaverde rounded focus:shadow-outline hover:bg-black transition transform hover:-translate-x-2 duration-200">
    <a href="{{ route('ligues.create') }}"
        class="block mx-auto text-white hover:text-francaverde text-base text-center py-16 px-4">
        <svg class="inline-block w-6 h-6 mr-3" fill="none" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
            </path>
        </svg>
        {{ __('nav.creer')}}
    </a>
</div>
