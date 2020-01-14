
    <tbody>
    @foreach($data as $v)
    <tr>
        <td>{{$v->n_id}}</td>
        <td>{{$v->n_title}}</td>
        <td>{{$v->n_content}}</td>
        <td><img src="{{env('NEWS_URL')}}{{$v->n_myfile}}" width="100px"></td>
        <td>
            <a href="{{url('/news/edit/'.$v->n_id)}}">编辑</a>
            <a href="{{url('/news/del/'.$v->n_id)}}">删除</a>
        </td>
    </tr>
    </tbody>
@endforeach
<tr>
    <td colspan="5">
        {{$data->appends($query)->links()}}
    </td>
</tr>