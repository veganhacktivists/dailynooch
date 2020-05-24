<h4>{{ $feed->title }}</h4>

@foreach($feed->item as $entry)
  <li><a href="{{ $entry->link }}">{{ $entry->title }}</a><span style="font-size: 10px;color:grey;">{{ $entry->pubDate }}</span></li>
@endforeach
