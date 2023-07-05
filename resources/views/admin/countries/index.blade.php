<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2x1 font-semibold p-4">Countries</h1>
        <div class="p-4">
            <Link href="{{ route('admin.countries.create') }}"
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New Country</Link>

        </div>
    </div>
    <x-splade-table :for="$countries">
        @cell('action', $country)
            <div class="space-x-2">
                <Link href="{{ route('admin.countries.edit', $country) }}"
                    class="px-3 py-2 text-white bg-green-400 hover:bg-green-700 rounded-md">
                Edit
                </Link>
                <Link href="{{ route('admin.countries.destroy', $country) }}" method="DELETE" confirm="Delete the country"
                    confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
                    class="px-3 py-2 text-white bg-red-400 hover:bg-red-700 rounded-md">
                Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
