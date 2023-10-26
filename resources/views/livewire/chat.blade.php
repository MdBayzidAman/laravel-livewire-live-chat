<div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
    <main class="flex-grow flex flex-row min-h-0">
        <!-- Chat side panel -->
        <section class="flex flex-col flex-none overflow-auto w-24 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out">
            <!-- Header and Search bar -->
            <livewire:component.user-search/>
            <!-- Chat user list  -->
            <div class="contacts p-2 flex-1 overflow-y-scroll">
                @foreach($users as $user)
                    <a href="{{ route('wire.chat.box', ['id' => $user->id]) }}">
                        <livewire:component.user-list :user="$user" />
                    </a>
                @endforeach
            </div>
        </section>
        <!-- Chat box message section -->
        <livewire:component.chatbox :user="$chatUser" />
    </main>
</div>
