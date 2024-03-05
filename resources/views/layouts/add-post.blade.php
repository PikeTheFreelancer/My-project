<!-- Modal -->
<div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div style="max-width: 800px; padding:20px;" class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{__('Add New Post')}}</h5>
        </div>
        <div class="modal-body">
            <form class="add-post" method="post" action="{{route('user.save-post')}}">
                @csrf
                <div class="form-field mb-3">
                    <label for="title">{{__('Category')}}</label>
                    <select class="bg-white form-select" name="post_category_id">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{__($category->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-field">
                    <label for="title">{{ __('messages.title') }}</label>
                    <input class="input-border" type="text" name="title" id="">
                </div>
                <div class="form-field">
                    <label for="content">{{ __('messages.content') }}</label>
                    <textarea class="tinymce-editor" name="content"></textarea>
                    <label class="error error-tinymce"></label>
                </div>
                <div class="form-field">
                    <button class="btn btn-secondary" type="submit">{{ __('messages.post') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>