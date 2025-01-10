<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Heading -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Contact List</h1>

        <!-- Search Form -->
        <form id="search-form" class="mb-6">
            <div class="flex space-x-4">
                <input type="text" id="search-input" name="search" class="px-4 py-2 border border-gray-300 rounded-md w-1/3" placeholder="Search..." value="{{ request('search') }}">
            </div>
        </form>

        <!-- Add Contact Button -->
        <div class="mb-4">
            <a href="{{ route('contacts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Add Contact
            </a>
        </div>

        <!-- Contacts Table -->
        <div id="contacts-list" class="overflow-hidden bg-white shadow sm:rounded-lg">
            @include('contacts.partials.contacts-table', ['contacts' => $contacts])
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var searchKeyword = $(this).val();

            $.ajax({
                url: '{{ route('contacts.index') }}',
                method: 'GET', 
                data: {
                    search: searchKeyword,  
                },
                success: function(response) {
                    $('#contacts-list').html(response); 
                },
            });
        });

    });
</script>
