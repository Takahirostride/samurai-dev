@php
    if(!isset($client)){ return false;}
@endphp
    <div class="modal fade modal-mail" id="sendmail-modal-client">
        {!! Form::open(['route'=>['asp_register_send_mail']]) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="md-form">
                        <input type="hidden" name="client_list" value="{{ $client->id }}">
                        <p>内容</p>
                        {!! Form::textarea('message',null,['class'=>'form-control','required']) !!}                         
                    </div>
                    <div class="md-success">
                        <h3 class="text-center">Send ok!</h3>
                    </div>                                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary btn-submit">送信する</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script src="{{ asset('assets/asp/js/asp-register-sendmail.js') }}"></script>