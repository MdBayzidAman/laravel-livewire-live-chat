<div class="flex justify-between items-center p-3 hover:bg-gray-800 rounded-lg relative">
    <div class="w-16 h-16 relative flex flex-shrink-0">
        <img class="shadow-md rounded-full w-full h-full object-cover" src="https://lh3.googleusercontent.com/a/ACg8ocLSWviYGj3S-NADlRx_XFArzj-O3ArgCAU3uZrebtyolEc=s96-c" alt="" />
    </div>
    <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
        <p>{{ $user->name }}</p>
        <div class="flex items-center text-sm text-gray-600">
            <div class="min-w-0">
                <p class="truncate">{{ $user->last_message }}</p>
            </div>
            <p class="ml-2 whitespace-no-wrap">Just now</p>
        </div>
    </div>
</div>