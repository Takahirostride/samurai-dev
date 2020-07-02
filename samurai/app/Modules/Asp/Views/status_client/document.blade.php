@extends('Asp::layouts.asp')
@section('content')
@php
    $request = request();
@endphp
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('Asp::status_client.subsidy_nav')
        </div>  
        <div class="col-sm-12"> 
            <div class="lst-hire">
                @include('Asp::status_client.nav_category')
                @if($policies)
                @include('Asp::status_client.form_sort_document',['element'=>$policies])  
                {!! Form::open(['route'=>['asp_client_recruitment_download_preview',$client],'id'=>'fr-download','method'=>'get']) !!}                                     
                <table class="table table-bordered tb-post tbrow-link">
                    <thead>
                        <tr>
                            <th class="td-sl">
                                <span>一括チェック</span>
                                <input type="checkbox" class="cb-cir olCheckAll" data-name="ids[]">
                            </th>
                            <th>施策名</th>
                            <th>発行機関</th>
                            <th>支援規模</th>
                            <th>支援内容</th>
                            <th>お気に入り</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl_policy = $request->query('ids',[]);       
                        @endphp
                        @foreach ($policies as $ite)
                            @php
                                $is_checked = false;
                                $p_ite = array_search($ite->id, $sl_policy);
                                if($p_ite !== false){
                                    $is_checked =true;
                                    unset($sl_policy[$p_ite]);
                                }
                            @endphp
                            @include('Asp::status_client.content_subsidy_document',['policy'=>$ite,'policy_index'=>$loop->index,'is_checked'=>$is_checked])                                
                        @endforeach
                    </tbody>
                </table>
                <div id="pagi-query">
                   {{ $policies->appends($request->query())->links() }} 
                </div>    
                @foreach($sl_policy as $ite)
                <input type="hidden" name="ids[]" value="{{ $ite }}">
                @endforeach            
                <div class="text-center">
                    <button type="submit" class="btn btn-orange btn-md">資料を作成する</button>
                </div>
                {!! Form::close() !!} 
                @endif               
            </div> 
        </div>
    </div>
    <!-- end .row -->
</div>
@endsection
@push('script')
@include('Asp::layouts.modal.modal_sendmail_policy')
<script>
(function($){
$(function(){
    $('#fr-download').on('submit',function(ev){
    var $form = $(this);
    var $policy = $form.find('input[name="ids[]"]');
    var error = true;
    $policy.each(function(){
        var $ele = $(this);
        if($ele.attr('type')=='hidden' || $ele.is(':checked')){
            error = false;
            return true;
        }
    });
    if(error){
        ev.preventDefault();
        alert('Pleased, select policies!');
        return false;
    }
    return true;
    });
    var pagi_query = (function(){
        var exp = {};
        var $element = $('#pagi-query');
        var $form;
        exp.init = function(){
            if($element.length == 0 ){ return false;}
            $form = $element.closest('form');
            listend();
        }
        var listend = function(){
            $element.on('click','a',handleClick);
        }
        var handleClick = function(ev){
            ev.preventDefault();
            var $ele = $(this);
            var href = $ele.attr('href');
            if(!href || href == '#'){
                return false;
            }
            var link = getLink(href);
            var l_query = getQuery(href);
            var page = l_query.hasOwnProperty('page')?l_query.page : '';
            var cate = l_query.hasOwnProperty('cate')?l_query.cate : '';
            var recom_bounty = l_query.hasOwnProperty('recom_bounty')?l_query.recom_bounty : '';
            var p_query = getPost();
            var data = {
                page : page,
                cate : cate,
                recom_bounty : recom_bounty,
                ids : p_query
            }
            link = link + '?' + $.param(data);
            window.location.href = link;
            return true;
        }
        var getPost = function(){
            var $item = $form.find('input[name="ids[]"]');
            var c_item = [];
            var $ele;
            $item.each(function(){
                $ele = $(this);
                if($ele.attr('type')=='hidden'|| $ele.is(':checked')){
                    c_item.push($ele.val());
                    return true;
                }
            });
            return c_item;            
        }
        var getLink = function(dt){
            var c_query = dt.indexOf('?');
            if(c_query < 0){
                return dt;
            }
            return dt.substring(0,c_query); 
        }
        var getQuery = function(dt){
            var c_query = dt.indexOf('?');
            if(c_query < 0){
                return {};
            }
            var str_query = dt.substring(c_query+1,dt.length); 
            return deserialize(str_query);
        }
        var deserialize = function(txt){
            var myjson={}
            var tabparams=txt.split('&')
            var i=-1;
            while (tabparams[++i]){
            tabitems=tabparams[i].split('=')
            if( myjson[decodeURIComponent(tabitems[0])] !== undefined ){
                if( myjson[decodeURIComponent(tabitems[0])] instanceof Array ){
                    myjson[decodeURIComponent(tabitems[0])].push(decodeURIComponent(tabitems[1]))
                }
            else{
               myjson[decodeURIComponent(tabitems[0])]= [myjson[decodeURIComponent(tabitems[0])],decodeURIComponent(tabitems[1])]
                    }
                }
            else{
                 myjson[decodeURIComponent(tabitems[0])]=decodeURIComponent(tabitems[1]);
                }
            }
            return myjson;
        }        
        return exp;
    })();  
    pagi_query.init();  
})    
})(jQuery)    
</script>
@endpush