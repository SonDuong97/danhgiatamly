<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Content</th>
        <th>Created at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{!!  $question->content!!} </td>
            <td>{{$question->created_at->format('i:h d/m/Y')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>