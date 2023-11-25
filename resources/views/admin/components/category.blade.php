<tr>
    <td>{{$category->id}}</td>
    <td>{{$category->name}}</td>
    <td>{{$category->updated_at}}</td>
    <td>
        <a data-id="{{$category->id}}" class="categ_edit" href="#">Edit</a> /
        <a data-id="{{$category->id}}" class="categ_delete" href="{{route('admin.categories.delete',$category->id)}}">Delete</a>
    </td>
</tr>