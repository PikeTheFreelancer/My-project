<!-- Modal -->

<div class="modal fade" id="reportForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div style="max-width: 800px; padding:20px;" class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{__('What\'s going on here?')}}</h5>
        </div>
        <div class="modal-body">
            <form class="add-post" method="post" action="{{route('report')}}">
                @csrf
                <input type="hidden" name="user" value="{{Auth::user()->name}}">
                <input type="hidden" name="url" value="{{$url}}">
                <div class="form-field mb-3">
                    <label for="title">{{__('Reason')}}</label>
                    <select class="bg-white form-select" name="reason">
                        <option value=""></option>
                        @foreach ($reasons as $reason)
                            <option value="{{$reason->id}}">{{$reason->reason}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-field">
                    <label for="content">{{ __('messages.content') }}</label>
                    <textarea class="tinymce-editor" name="content"></textarea>
                    <label class="error error-tinymce"></label>
                </div>

                <div class="form-field">
                    <button class="btn btn-secondary" type="submit">{{ __('Report') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>