<div>
    <input wire:model="search" type="search" placeholder="Search posts by title...">

    <h1>Search Results:</h1>

    <ul>
        @foreach($templates as $template)
        <li>{{ $template->store_name }}</li>
        @endforeach
    </ul>
</div>