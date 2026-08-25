@foreach($events as $event)
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <p>{{ $event->location }}</p>
    <p>{{ $event->start_date }}</p>
    <p>{{ $event->end_date }}</p>
    <p>{{ $event->capacity }}</p>
    <p>{{ $event->available_seats }}</p>
    <p>{{ $event->price }}</p>
    <p>{{ $event->image }}</p>
    <p>{{ $event->status }}</p>
    <p>category: {{ $event->category->name }}</p>
@endforeach
