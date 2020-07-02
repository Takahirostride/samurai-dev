@php
    if(!isset($pay_option) || empty($pay_option)){return false;}
    $payroll = App\Modules\Admin\Models\AdminPayroll::first();
    if(!$payroll){ return false;}
@endphp
@if(in_array(0,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">完全非公開オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->completely_private_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            依頼を非公開にして提案を募集することができます。<br/>
            募集中は士業とクライアント（法人）しか依頼を閲覧することができず、募集終了後には当選ユーザー及び依頼したクライアントのみ閲覧することができます。<br/>
            ※士業が依頼詳細ページを閲覧するには本人確認と機密保持確認が必須となります。</p>
    </div>
</div>
@endif
@if(in_array(1,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">非公開オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->private_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            依頼を非公開にして提案を募集することができます。（非公開オプションをつけていても、士業にログインすると、表示されてしまいます。予めご了承ください。）</p>
    </div>
</div>
@endif
@if(in_array(2,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">急募オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->quick_invitation_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            仕事依頼が急募であることを表示し、どの依頼よりも最優先で上位表示します。</p>
    </div>
</div>
@endif
@if(in_array(3,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">注目オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->featured_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            仕事依頼をより多くの士業に見つけてもらえるように表示されます。多くの提案を集めることができます。</p>
    </div>
</div>
@endif
@if(in_array(4,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">マイページ表示オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->mypage_display_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            士業のマイページに、お客様（法人）の依頼ページリンクが表示されます。</p>
    </div>
</div>
@endif
@if(in_array(5,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">認定士業への一斉通知オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->notification_to_cert_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            依頼内容を認定士業にメールで告知・宣伝ができます。</p>
    </div>
</div>
@endif
@if(in_array(6,$pay_option))
<div class="row div-style-white" style="padding:20px 15px 20px 15px;" >
    <div style="margin-top:10px;margin-bottom:20px;">
        <span style="color: #337ab7;font-size:18px;font-weight:600;">士業100人への一斉通知オプション</span>
        <button type="button" class="btn btn-warning" style="float:right;">+{{$payroll->notification_to_100_option}}円</button>
    </div>
    <div>
        <p style="font-size: 14px;">
            依頼内容を実績ある士業100名にメールで告知・宣伝ができます。</p>
    </div>
</div>
@endif
