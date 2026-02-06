<x-mail::message>
# Daily New Books Summary

The following books were added in the given period:

<x-mail::table>
| Created At | Title | ID |
| ---------- | ----- | -- |
@foreach ($books as $book)
| {{ $book['created_at'] }} | {{ is_array($book['title']) ? ($book['title']['en'] ?? reset($book['title'])) : $book['title'] }} | {{ $book['id'] }} |
@endforeach
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
