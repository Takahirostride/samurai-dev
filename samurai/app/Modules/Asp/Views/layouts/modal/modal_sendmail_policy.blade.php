    <div class="modal fade modal-mail" id="sendmail-modal-policy">
        {!! Form::open(['route'=>['asp_register_mail_policy']]) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="md-form">
                        <input type="hidden" name="client_id" value="">
                        <input type="hidden" name="policy_id" value="">
                        <div class="form-group">
                            <p class="control-label">件名</p>
                            {!! Form::text('title',null,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            <p class="control-label">内容</p>
                            {!! Form::textarea('message',null,['class'=>'form-control','required']) !!}
                        </div>                                
                    </div>
                    <div class="md-success">
                        <h3 class="text-center">Send ok!</h3>
                    </div>                   
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary btn-submit">送信する</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script src="{{ asset('assets/asp/js/asp-register-sendmail.js') }}"></script>