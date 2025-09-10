<x-layout>
    <nav></nav>
        <h2>Available Ninjas</h2>

        <u1>
            @foreach ($ninjas as $ninja)
                <li>
                    <p>{{ $ninja ['name']}}</p>
                    <a href="/index/{{  $ninja['id'] }}">View Details </a>
                </li>
            @endforeach
        </u1>
</x-layout>