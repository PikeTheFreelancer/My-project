<!-- Modal -->
@php
    if (isset($item)) {
        $name = $item->name;
        $image = $item->image;
        $description = $item->description;
        $price = $item->price;
    }else {
        $name = '';
        $image = '';
        $description = '';
        $price = '';
    }
@endphp
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Merchandise</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Merchandise</label>
                <input value="{{$item->$name ?? ''}}" class="input-border" type="text" name="name" id="">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="">
                <img class="thumbnail" src="{{$item->$image ?? ''}}" alt="">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea value="{{$item->$description ?? ''}}" class="input-border" name="description" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input value="{{$item->$price ?? ''}}" class="input-border" type="text" name="price" id="">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>