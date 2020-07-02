    @php
    $request = request();
    @endphp
{!! Form::open(['method'=>'GET','class'=>'fr-clients']) !!}
    <table class="table table-bordered table-blue">
        <tbody>
            <tr>
                <th>
                    <span>屋号または名称</span>
                </th>
                <td>
                    {!! Form::text('keyword',$request->query('keyword',null),['class'=>'form-control','placeholder'=>'例）株式会社SAMURAI']) !!}
                </td>
            </tr>
            <tr>
                <th><span>住所１（都道府県）</span></th>
                <td>
                    {!! Form::selectMinitry('province',$request->query('province',null)) !!}
                </td>
            </tr>
            <tr>
                <th><span>住所２（市区町村）</span></th>
                <td>
                    {!! Form::selectSubMinitry('city',$request->query('city',null)) !!}
                </td>
            </tr>

        </tbody>
    </table>
    <div class="text-center bsearch-btn-s">
        <button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-md">絞り込む</button>
    </div>
{!! Form::close() !!}