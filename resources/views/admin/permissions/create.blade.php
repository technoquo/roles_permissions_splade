<x-admin-layout>
    <h1 class="text-2x1 font-semibold p-4">New Permission</h1>
    <x-splade-form :action="route('admin.permissions.store')" class="p-4 bg-white rounded-md space-y-2">
        <x-splade-input name="name" :label="__('name')" />
        <x-splade-select name="roles[]" :options="$roles" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>

</x-admin-layout>
