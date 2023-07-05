<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2x1 font-semibold p-4">Roles</h1>\
        <div class="p-4">
            <Link href="{{ route('admin.roles.create') }}"
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New Role</Link>

        </div>
    </div>
    <x-splade-table :for="$roles">
        @cell('action', $roles)
            <div class="space-x-2">
                <Link href="{{ route('admin.roles.edit', $roles) }}"
                    class="px-3 py-2 text-white bg-green-400 hover:bg-green-700 rounded-md">
                Edit
                </Link>
                <Link href="{{ route('admin.roles.destroy', $roles) }}" method="DELETE" confirm="Delete the role"
                    confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
                    class="px-3 py-2 text-white bg-red-400 hover:bg-red-700 rounded-md">
                Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
