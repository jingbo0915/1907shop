 @foreach ($data as $v)
        <tr>
            <td>{{$v->m_id}}</td>
            <td>{{$v->m_title}}</td>
            <td>{{$v->m_cate}}</td>
            <td>{{$v->m_is_import==1?'是':'否'}}</td>
            <td>{{$v->m_is_show==1?'是':'否'}}</td>
            <td>{{$v->m_name}}</td>
            <td>{{$v->m_email}}</td>
            <td>{{$v->m_key}}</td>
            <td>{{$v->m_desc}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->m_file}}" width="100"/></td>
            <td><a href="{{url('/member/edit/'.$v->m_id)}}" class="btn btn-success">编辑</a>|<a href="{{url('/member/del/'.$v->m_id)}}" class="btn btn-danger">删除</a></td>
        </tr>
            @endforeach
 <tr>

     <td colspan="12">{{$data->appends($query)->links()}}</td>

 </tr>


