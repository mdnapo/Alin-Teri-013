<table class="table table-bordered" id="stories_holder">
    <thead>
    <th>#</th>
    <th>Naam</th>
    <th>Aanpassen</th>
    <th>Verwijderen</th>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <th scope="row" class="#{{ $item->id }}">{{ $item->id }}</th>
            <td>{{ $item->naam }}</td>
            <td>
                <a href="{{ url('/admin/stories/edit/'.$item->id) }}" class="glyphicon glyphicon-pencil plain_link"></a>
            </td>
            <td>
                <a id="{{ $item->id }}" class="glyphicon glyphicon-remove plain_link"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>