@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}">{!! $breadcrumb->title !!}</a>
                </li>
            @else
                <li class="breadcrumb-item active">{!! $breadcrumb->title !!}</li>
            @endif

        @endforeach
    </ol>

@else

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin::dashboard.home') }}">
                <span class="fa fa-home"></span>
            </a>
        </li>
    </ol>

@endif
