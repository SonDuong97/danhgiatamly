<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>user_id</th>
        <th>user_name</th>
        <th>user_email</th>
        <th>title</th>
        @foreach(json_decode($histories[0]->result, true) as $data)
            <th>{{$data['type']}}</th>
            <th>Score</th>
        @endforeach
        <th>created_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($histories as $key => $history)
        <tr>
            <td>{{ $key }}</td>
            <td>{!!  $history->user_id!!} </td>
            <td>{!!  $history->user_name!!} </td>
            <td>{!!  $history->user_email!!} </td>
            <td>{!!  $history->title!!} </td>
            @foreach(json_decode($history->result, true) as $data)
                <td>{{$data['level']}}</td>
                <td>{{$data['score']}}</td>
            @endforeach
            <td>{{$history->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>