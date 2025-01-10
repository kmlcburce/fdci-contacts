<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Phone
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Company
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($contacts as $contact)
        <tr>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $contact->name }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->email }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->phone }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->company ?? 'N/A' }}</td>
            <td class="px-6 py-4 text-sm font-medium">
                <a href="{{ route('contacts.edit', $contact->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- {{ $contacts->links() }} -->
