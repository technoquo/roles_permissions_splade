<x-admin-layout>
    <h1 class="text-2x1 font-semibold p-4">Edit User</h1>
    <x-splade-form :default="$user" :action="route('admin.users.update', $user)" method='PUT' class="p-4 bg-white rounded-md space-y-2">
        <x-splade-input name="username" :label="__('Username')" />
        <x-splade-input name="first_name" :label="__('First name')" />
        <x-splade-input name="last_name" :label="__('Last name')" />
        <x-splade-input name="email" label="Email address" />
        <x-splade-select name="roles[]" :options="$roles" multiple relation choices />
        <x-splade-select name="permissions[]" :options="$permissions" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>

</x-admin-layout>
