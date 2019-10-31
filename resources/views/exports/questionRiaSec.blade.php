<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Content</th>
        <th>Created at</th>
        <th>Type</th>
    </tr>
    </thead>
    <tbody>

    @foreach($questions as $key => $question)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{!!  $question->content!!} </td>
            <td>{{$question->created_at}}</td>
            <td>{{$question->Type}}</td>
        </tr>
    @endforeach
    </tbody>
</table>