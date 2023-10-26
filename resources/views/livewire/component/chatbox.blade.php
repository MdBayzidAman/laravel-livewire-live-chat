<section class="flex flex-col flex-auto border-l border-gray-800">
    <div class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
        <div class="flex">
            <div class="w-12 h-12 mr-4 relative flex flex-shrink-0">
                <img class="shadow-md rounded-full w-full h-full object-cover" src="https://lh3.googleusercontent.com/a/ACg8ocLSWviYGj3S-NADlRx_XFArzj-O3ArgCAU3uZrebtyolEc=s96-c" alt="" />
            </div>
            <div class="text-sm">
                <p class="font-bold">Scarlett Johansson</p>
                <p>Active 1h ago</p>
            </div>
        </div>

        <div class="flex">
            <a href="#" class="block rounded-full hover:bg-gray-700 bg-gray-800 w-10 h-10 p-2 ml-4">
                <svg viewBox="0 0 20 20" class="w-full h-full fill-current text-blue-500">
                    <path d="M2.92893219,17.0710678 C6.83417511,20.9763107 13.1658249,20.9763107 17.0710678,17.0710678 C20.9763107,13.1658249 20.9763107,6.83417511 17.0710678,2.92893219 C13.1658249,-0.976310729 6.83417511,-0.976310729 2.92893219,2.92893219 C-0.976310729,6.83417511 -0.976310729,13.1658249 2.92893219,17.0710678 Z M9,11 L9,10.5 L9,9 L11,9 L11,15 L9,15 L9,11 Z M9,5 L11,5 L11,7 L9,7 L9,5 Z" />
                </svg>
            </a>
        </div>
    </div>
    <!-- message body -->
    <div wire:poll class="chat-body p-4 flex-1 overflow-y-scroll">
    
    {{-- messages --}}
    @foreach ($messages as $chat)
        @if ($chat->from_id != Auth::user()->id)
            <div class="flex flex-row justify-start my-2">
                <p class="px-6 py-3 text-sm grid grid-flow-row gap-2 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">{{ $chat->chats }}</p>
            </div>

        @else
            <div class="flex flex-row justify-end my-2">
                <p class="px-6 py-3 text-sm rounded-t-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">{{ $chat->chats }}</p>
            </div>
        @endif
    @endforeach

        <!-- <p class="p-4 text-center text-sm text-gray-500">FRI 3:04 PM</p> -->
        <!-- <div class="flex flex-row justify-end my-2">
            <a class="block w-64 h-64 relative flex flex-shrink-0 max-w-xs lg:max-w-md" href="#">
                <img class="absolute shadow-md w-full h-full rounded-l-lg object-cover" src="https://unsplash.com/photos/8--kuxbxuKU/download?force=true&w=640" alt="hiking" />
            </a>
        </div> -->

    </div>
    <form wire:submit="createMessage" >
        
        <div class="chat-footer flex-none">
            <div class="flex flex-row items-center p-4">
                <div class="relative flex-grow">
                    <label>
                        <input wire:model="message" class="input-message rounded-full py-2 pl-3 pr-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in" type="text" value="" placeholder="Aa" />
                    </label>
                </div>
                {{-- <button type="submit" class="flex flex-shrink-0 focus:outline-none mx-2 text-blue-600 hover:text-blue-700 w-6 h-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </button> --}}
            </div>
        </div>
    </form>
</section>