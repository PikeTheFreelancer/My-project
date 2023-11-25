<tr class="userData">
    <td class="userId">{{$category->id}}</td>
    <td class="userName">
        <span>{{$category->name}}</span>
        <input style="width: auto; display:none;" class="input-border" type="text" data-trans="edit-categ-{{$category->id}}" value="{{$category->name}}">
    </td>
    <td class="userCreatedAt">
        {{$category->updated_at}}
    </td>
    <td>
        <span class="categ_save" data-id="{{$category->id}}" data-title="{{$category->name}}" style="display: none">
            Save
        </span>
        <span class="categ_action">
            <a data-id="{{$category->id}}" class="categ_edit" href="#">Edit</a> /
            <a data-id="{{$category->id}}" class="categ_delete" href="{{route('admin.categories.delete',$category->id)}}">Delete</a>
        </span>
    </td>
</tr>