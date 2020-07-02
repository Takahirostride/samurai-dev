<?php

namespace App\Helpers;
use DB;
use URL;
class Button {
	protected static $userCheckList = [];
	public static function getFavourButtons($id) {
		$subsidychecklist  =   AuthSam::getSubsidychecklist();
		if (in_array($id, $subsidychecklist[0])) {
			$class_button	=	'btn-warning';
			$data_active	=	'1';
		} else {
			$class_button	=	'btn-style-grey';
			$data_active	=	'0';
		} 
		$button1 = '<button id="recom1" data-id="'.$id.'" data-type="0" data-active="'.$data_active.'" type="button" class="btn btn-default '.$class_button .' btn-subsidychecklist" data-toggle="tooltip" data-placement="bottom" data-original-title="お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">
						<strong>提案を検討</strong>
					</button>';
		if (in_array($id, $subsidychecklist[1])) {
			$class_button	=	'btn-success';
			$data_active	=	'1';
		} else {
			$class_button	=	'btn-style-grey';
			$data_active	=	'0';
		}
		$button2 = 	'<button id="recom2" data-id="'.$id.'" data-type="1" data-active="'.$data_active.'" type="button" class="btn btn-default '.$class_button.' btn-subsidychecklist" style="margin: 0 5px;"  data-toggle="tooltip" data-placement="bottom" data-original-title="お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。">
								<strong>興味あり</strong>
							</button>';
		if (in_array($id, $subsidychecklist[2])) {
			$class_button	=	'btn-default-select';
			$data_active	=	'1';
		} else {
			$class_button	=	'btn-style-grey';
			$data_active	=	'0';
		}
		$button3 = 	'<button id="recom3" data-id="'.$id.'" data-type="2" data-active="'.$data_active.'" type="button" class="btn btn-defaul '.$class_button.' btn-subsidychecklist" data-toggle="tooltip" data-placement="bottom" data-original-title="必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。">
								<strong>非表示</strong>
							</button>';
		return $button1.$button2.$button3;
	}

	public static function getLikeButtons($id) {
		$user_id = AuthSam::getUser()->id;
		$checklist_data = DB::table('checklist_policy_user')->where('user_id',$user_id)->where('policy_id',$id)->first();
		if($checklist_data && $checklist_data->type == 1) {
			$like = '<button data-uid="'.$user_id.'" data-pid="'.$id.'" data-like="1" type="button" class="btn btn-default btn-start"><span></span>お気に入り</button>';
		}else{
			$like = '<button data-uid="'.$user_id.'" data-pid="'.$id.'" data-like="0" type="button" class="btn btn-default btn-start"><span></span>お気に入り</button>';
		}
		
		return $like;
	}

	public static function getFollowButtons($id) {
		$followlist  =   AuthSam::getFollowlist();
		if (in_array($id, $followlist)) {
			$class_button	=	'';
			$data_active	=	'1';
			
		} else {
			$class_button	=	'btn-style-grey';
			$data_active	=	'0';
		} 
		$html = '<button type="button" data-id="'.$id.'" data-active="'.$data_active.'" class="btn-primary btn-follow '.$class_button.'">フォロー</button>';
		return $html;
	}
	public static function getBookmarkButton($policy)
	{
		// if(!self::$userCheckList)
		// {
		// 	self::$userCheckList = $policy->checklist_policy_user->where('user_id', session('user_id'));
		// }
		$user_id = (session('user_id')?session('user_id'):1);
		$check = $policy->checklist_policy_user->where('user_id', $user_id)->first();
		if($check) $iClass = 'fa-star';
		else $iClass = 'fa-star-o';
		return '<button type="button" data-policyid="'.$policy->id.'" class="btn btn-default btn-bookmark"><i class="fa '.$iClass.'"></i> お気に入り</button>';
	}
	/**
	 * call rating star div
	 * @param  integer $index         Index of Rating - not duplite
	 * @param  integer $currentRating $user->evaluate
	 * @return [type]                 HTML string
	 */
	public static function getRatingStar($index = 0, $currentRating = 0)
	{
		$html = '<div class="dstar-rating" data-id="fbrtdiv-'.$index.'">
				    <select id="fbrtsl-'.$index.'" data-current-rating="'.(float)$currentRating.'" name="rating" autocomplete="off">
				        <option value=""></option>
				        <option value="1">1</option>
				        <option value="2">2</option>
				        <option value="3">3</option>
				        <option value="4">4</option>
				        <option value="5">5</option>
				    </select>
				</div>';
		return $html;
	}

	public static function getRating($value) {
		$checked1 = ($value > 1) ? 'checked' : '';
		$checked2 = ($value > 1) ? 'checked' : '';
		$checked3 = ($value > 2) ? 'checked' : '';
		$checked4 = ($value > 3) ? 'checked' : '';
		$checked5 = ($value > 4) ? 'checked' : '';
		$html = '<span class="fa fa-star '.$checked1.'"></span>
				<span class="fa fa-star '.$checked2.'"></span>
				<span class="fa fa-star '.$checked3.'"></span>
				<span class="fa fa-star '.$checked4.'"></span>
				<span class="fa fa-star '.$checked5.'"></span>';
		return $html;
	}

	public static function showPolicyList($policyItem = [], $urlRoute = '')
	{
		if(is_array($policyItem)) $policyItem = (object)$policyItem;
		if($urlRoute == '') $urlRoute = 'subsidydetail';
		$html = '<table class="table table-bordered subsidylist subsidylist-2">
			<tbody>
				<tr>
					<td rowspan="2">';
						if($policyItem->image_id) {
							$html .= '<img src="'.URL::to($policyItem->image_id).'" alt="'.str_limit($policyItem->name,34).'">';
						}
					$html .= '</td>
					<td>
						<p><a href="'.URL::route($urlRoute, ['policy_id' => $policyItem->id]).'"><span class="sidy-tbig">'.str_limit($policyItem->name, 34).'</span></a></p>
						<p class="text-right text-primary">
							<strong>発行機関:</strong><span>'.str_limit($policyItem->minitry_text(), 18).'</span>/
							<strong>対象地域:</strong><span>'.str_limit($policyItem->region_text() , 40).'</span>
							<strong>募集時期:</strong><span>'.str_limit($policyItem->subscript_duration , 8).'</span>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<ul class="tag-list">';
							if ($policyItem->tags) {
								foreach($policyItem->tags as $key => $tag) {
									$html .='<li><span>'.str_limit($tag->tag,10).'</span></li>';
								}
							}

						$html .='</ul>
					</td>
				</tr>
				<tr>
					<td style="border-left: none" colspan="2">
						<div class="row">
							<div class="dpolicylist-ctleft">
								<div class="dpleft-bottom">
									<div class="dp-sp-content">
										<span class="rounder-sp"><span></span>支援内容</span>
										<p>'.str_limit(strip_tags($policyItem->support_content), 100).'</p>
									</div>
									<div class="dp-sp-scale">
										<span class="rounder-sp"><span></span>支援規模</span>
										<p>'.str_limit(strip_tags($policyItem->support_scale), 100).'</p>
									</div>
									<div class="dp-sp-price">
										<span class="rounder-sp"><span></span>施策種別</span>
										<p class="dsp-price">'.$policyItem->acquire_budget_text().'</p>
									</div>
								</div>
							</div>
							<div class="dpolicylist-ctright text-right create-link-box-x">';
							
	$cls = 'client-suggest';
	$onclick = 'return true;';
	$link = URL::route($urlRoute,['id'=>$policyItem->id,'register'=>1]);

	// if(array_key_exists('matchingUser', $element->getRelations())&& !$element->matchingUser->isEmpty()){
	if($policyItem->matchingUser && !$policyItem->matchingUser->isEmpty()){
		$cls = 'gray';
		$onclick = 'return false;';
	}


							$html .= '<a href="'.$link.'" onclick="'.$onclick.'" class="btn btn-default btn-suggest '.$cls.'">見積依頼</a>'.
								 Button::getBookmarkButton($policyItem) .'
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>';

		return $html;
	}

	/* backup old XD
	public static function showPolicyList($policyItem = [], $urlRoute = '')
	{
		if(is_array($policyItem)) $policyItem = (object)$policyItem;
		if($urlRoute == '') $urlRoute = 'subsidydetail';
		$html = '<div class="dpolicy-item">
					<div class="dpleft">
						<div class="dpleft-top">
							<div class="dp-top-image">
								<img src="'.URL::to($policyItem->image_id).'" alt="'.$policyItem->name.'">
							</div> <!-- end .dp-top-image -->
							<div class="dp-top-meta">
								<h2 class="dp-title"><a href="'.URL::route($urlRoute, [$policyItem->id] ).'">'.$policyItem->name.'</a></h2>
								<div class="dmeta-content">
									<p>発行機関：<strong>'.str_limit($policyItem->minitry_text(), 18).'</strong></p>
									<p>対象地域：<strong>'.$policyItem->region_text().'</strong></p>
									<p>募集時期：<strong>'.str_limit($policyItem->subscript_duration, 20).'</strong></p>
								</div>
								<div class="dmeta-tags">
								';
								foreach($policyItem->tags as $tag)
								{
									$html .= '<a href="#" onclick="return false;" class="dptag">'.$tag->tag.'</a>';
								}
						$html .= '</div> <!-- end .dmeta-tags -->
							</div> <!-- end .dp-top-meta -->
						</div> <!-- end .dpleft-top -->
						<div class="dpleft-bottom">
							'.self::getBookmarkButton($policyItem).'
							<div class="dp-sp-content">
								<span class="rounder-sp"><span></span>支援内容</span>
								<p>'.str_limit(strip_tags($policyItem->support_content), 100).'</p>
							</div>
							<div class="dp-sp-scale">
								<span class="rounder-sp"><span></span>支援規模</span>
								<p>'.str_limit(strip_tags($policyItem->support_scale), 100).'</p>
							</div>
							<div class="dp-sp-price">
								<span class="rounder-sp"><span></span>施策種別</span>
								<p class="dsp-price">'.$policyItem->acquire_budget_text().'</p>
							</div>
						</div> <!-- end .dpleft-bottom -->
					</div> <!-- end .dpleft -->
					<div class="dpright">
						<div class="dagency-info">';
					if($policyItem->matching_user) {
						$html .='<img class="dagency-image" src="'. URL::to($policyItem->first_matching_user()->image) .'" alt="">
								<div class="ditemav-info">
									<p>事業者名 : '.$policyItem->first_matching_user()->user_name().'</p>
									<div class="clearfix"></div>
									評価 : '.self::getRatingStar( ($policyItem->id+rand(0,999)), $policyItem->first_matching_user()->evaluate).'
									<p>実績 : '.$policyItem->first_matching_user()->result.'件</p>
								</div>
								<p class="dself-intro">'.str_limit($policyItem->first_matching_user()->self_intro, 100).'</p>
						</div> <!-- end .agency-info -->
						<div class="total-client-right">
							<img src="'.URL::to("/assets/photo/clienticon.png").'" alt="">
							<p><a href="'.URL::route($urlRoute, [$policyItem->id] ).'">他'.$policyItem->matching_user->count().'社</a></p>
						</div> <!-- end .dagency-info -->';
					}
				$html .= '</div><!-- end .dpright -->
				</div> <!-- end .dpolicy-item -->';

		return $html;
	}
	*/
}