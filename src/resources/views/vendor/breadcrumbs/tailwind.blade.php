@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb flex items-center mb-0">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item text-blue">
                        <a href="{{ $breadcrumb->url }}" class="">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item text-gray-900 active">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="text-gray px-2">
                        /
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
