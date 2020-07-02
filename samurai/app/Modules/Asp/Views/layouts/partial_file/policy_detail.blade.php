@php
	if(!isset($policy)){return false;}
@endphp

            <p class="stitle1">{{ $policy->name }}</p>
            <p class="stitle2">{{ $policy->name_serve }}</p>
            <div class="minitry-list">
                @foreach ($policy->cat as $cat)
                    <span>{{ $cat->category_name }}</span>
                @endforeach
            </div>
            <div class="plc-company">
                <div class="row">
                    <div class="col-md-9">
                        登録機関:{{ $policy->companyName() }}
                    </div>
                    <div class="col-md-3">
                        更新日: {{ ol_get_date_string($policy->subscript_duration_detail) }}
                    </div>
                </div>                
            </div>

            <div class="minitry-list gray">
                @foreach ($policy->business_type as $ite)
                    <span>{{ $ite }}</span>
                @endforeach
            </div>            
            <div class="sdetail">
                <p class="sdetail-title">目的</p>
                <p>{!! nl2br($policy->target) !!}</p>
                <p class="sdetail-title">対象者の詳細</p>
                <p>{!! nl2br($policy->info) !!}</p>
                <p class="sdetail-title">支援内容</p>
                <p>{!! nl2br($policy->support_content) !!}</p>
                <p class="sdetail-title">支援規模</p>
                <table class="table table-bordered support-scale">
                    <tbody>
                        <tr>
                            <td width="33%">下限</td>
                            <td width="33%">上限</td>
                            <td width="33%">助成率</td>
                        </tr>
                        <tr>
                            <td class="text-center std">
                                <span class="fake-input">{{ $policy->support_scale_lower_limit }}</span>
                            </td>
                            <td class="text-center std">
                                <span class="fake-input">{{ $policy->support_scale_upper_limit }}</span>
                            </td>
                            <td class="text-center std">
                                <span class="fake-input">{{ $policy->support_scale_subsidy_duration }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>{!! nl2br($policy->support_scale) !!}</p>
                <p class="sdetail-title">募集期間</p>
                <p>{{ $policy->subscript_duration }}</p>
                <p class="sdetail-title">対象地域</p>
                @foreach ($policy->cities as $city)
                    {{ $city->province ? $city->province->province_name :'' }}
                     {{ $city->city_name }}
                @endforeach
                <p class="sdetail-title">採択結果</p>
                <p>{!! nl2br($policy->adopt_result) !!}</p>
                <p class="sdetail-title">掲載終了日</p>
                <p>{{ ol_get_date_string($policy->subscript_duration_detail) }}</p>
                <p>1</p>
                <p class="sdetail-title">pdfデータ</p>
                @foreach ($policy->register_pdf as $ite)
                    <p><a href="{{ @$ite[1] }}" download>{{ @$ite[0] }}</a></p>
                @endforeach
                @foreach ($policy->register_pdf1 as $ite)
                    <p><a href="{{ @$ite[1] }}" download>{{ @$ite[0] }}</a></p>
                @endforeach

                <p class="sdetail-title">お問い合せ</p>
                <p>{!! nl2br($policy->inquiry) !!}</p>
                

            </div><!-- end .sdetail -->
