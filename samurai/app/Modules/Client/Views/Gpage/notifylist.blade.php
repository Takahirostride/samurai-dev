@extends('layouts.home')
@section('content')
<div class="mainpage">
	<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page-title">お知らせ</h2>
					<div class="row">
						<div class="col-sm-12">
							
							<div class="voice-list-detail">
								<table class="table table-hover table-bordered">
									<tbody>
										@foreach($notify as $no)
										<tr>
											<td width="15%">{{ date('Y年m月d日', strtotime($no->created_date) ) }}</td>
											<td><a href="{{URL::route('client.notify', [$no->id] )}}">{{ $no->title }}</a></td>
										</tr>
										@endforeach
									</tbody>
								</table>

							</div>
							
						</div>
					</div>
				</div>
			</div><!-- end .row -->
		</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix" style="margin-bottom: 50px;"></div>
@endsection