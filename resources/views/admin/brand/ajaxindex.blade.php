@foreach ($data as $v)
    <tr>
        <th>{{$v->brand_id}}</th>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="100"/>{{$v->brand_name}}</td>
        <td>{{$v->brand_url}}</td>
        <td>{{$v->brand_desc}}</td>
        <td><a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-success">编辑</a>|<a href="{{url('/brand/del/'.$v->brand_id)}}" class="btn btn-danger">删除</a></td>
    </tr>
@endforeach
<tr>
    <td colspan="4"> {{$data->appends($query)->links()}}</td>
</tr>>
