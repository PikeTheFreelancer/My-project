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
      <form class="modal-content edit-merchandise" method="POST" action="{{ route('user.my-store.save-merchandise-fields') }}" enctype="multipart/form-data">
        @csrf
        <input id="merchandise_id" name="merchandise_id" type="hidden">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Merchandise</h5>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Merchandise</label>
                <input class="input-border" type="text" name="name" id="item_name">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <div class="image-uploader">
                  <input type="file" name="image" id="image_uploader">
                  <img class="thumbnail" src="" alt="" id="item_image">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="input-border" name="description" id="item_description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input class="input-border" type="text" name="price" id="item_price">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
</div>