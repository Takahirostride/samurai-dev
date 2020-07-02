<?php 

//move category data to new table
foreach($add as $val)
{
    if(!in_array($val->category, $arr))
    {
        $arr[] = $val->category;
    }
}
foreach($add as $val)
{
    $cat = $val->category;
    if(!@in_array($val->detail, @$arr1[$cat] ))
    {
        $arr1[$cat][] = $val->detail;
        $dq[$cat][] = $val->detail_question;
    }
}

foreach($arr as $val)
{
    $id = DB::table('categories')->insertGetId(['category_name'=>$val, 'type'=>0, 'display'=>1, 'location'=>0], 'id');
    foreach($arr1[$val] as $k=>$v)
    {
        DB::table('sub_category')->insert( ['sub_name'=>$v, 'detail_value'=>'', 'detail_question'=>$dq[$val][$k], 'category_id'=>$id, 'type'=>0, 'display'=>1, 'location'=>0 ] );
    }
}





//region
$arr = $arr1 = $dq = array();
        $policy = DB::table('policy')->get();
        $province_list = DB::table('provinces')->get();
        $city_list = DB::table('cities')->get();
        foreach($policy as $po)
        {
            $register_insti_detail = $po->register_insti_detail;
            //if(!stristr($register_insti_detail, ' '))
            //{
                $tmp = explode(' ', $register_insti_detail);
                $province = $tmp[0];
                $province_id = 0;
                if(isset($tmp[1])) $city = $tmp[1];
                foreach($province_list as $kpr=>$pr)
                {
                    if($pr->province_name == $province)
                    {
                        $province_id = $pr->id;
                        break;
                    }
                }
                $city_id = 0;
                if($province_id != 0) 
                {
                    foreach($city_list as $c)
                    {
                        if($c->province_id == $province_id && $city == $c->city_name)
                        {
                            $city_id = $c->id;
                        }
                    }
                }
            //}
            
            if($city_id == 0)
            {
                var_dump($po->id);
                var_dump($register_insti_detail);
                var_dump($province);
                var_dump($province_id);
                var_dump($city_id);
                //die();
            }
            DB::table('policy_ins')->insert([
                'policy_id' => $po->id,
                'province_id' => $province_id,
                'city_id' => $city_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
        }
 



*
 //chia data column region/region_detail của policy qua bảng mới là policy_region
$arr = $arr1 = $dq = array();
        $policy = DB::table('policy')->get();
        $province_list = DB::table('provinces')->get();
        $city_list = DB::table('cities')->get();
        $region_arr = array();
        foreach($policy as $po)
        {
            $region_detail = $po->region_detail;
            //if(!stristr($register_insti_detail, ' '))
            //{
                $tmp = json_decode($region_detail);
                foreach($tmp as $rtmp) {
                    $province = $rtmp[0];
                    $province_id = 0;
                    if(isset($rtmp[1])) $city = $rtmp[1];
                    foreach($province_list as $kpr=>$pr)
                    {
                        if($pr->province_name == $province)
                        {
                            $province_id = $pr->id;
                            break;
                        }
                    }
                    $city_id = 0;
                    if($province_id != 0) 
                    {
                        foreach($city_list as $c)
                        {
                            if($c->province_id == $province_id && $city == $c->city_name)
                            {
                                $city_id = $c->id;
                            }
                        }
                    }
                    $region_arr[$po->id][] = array('province_id'=>$province_id, 'city_id' => $city_id);
                }

                if($city_id=0||$province_id==0)
                {
                    //echo $po->id.'---'.$province_id.'---'.$city_id.'---'.$region_detail."\r\n";
                }
                
            //}

 
            
        }
        die();

        foreach($region_arr as $id=>$val)
        {
            foreach ($val as $key => $value) {
                DB::table('policy_region')->insert([
                    'policy_id' => $id,
                    'province_id' => $value['province_id'],
                    'city_id' => $value['city_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        //var_dump($region_arr);
        die();
 


*
 //update minitry_id
 $arr = $arr1 = $dq = array();
        $policy = DB::table('policy')->get();
        $province_list = DB::table('provinces')->get();
        $city_list = DB::table('cities')->get();
        $region_arr = array();
        foreach($policy as $po)
        {
            $register_insti_detail = $po->register_insti_detail;
            //if(!stristr($register_insti_detail, ' '))
            //{
            $rtmp = explode(' ', $register_insti_detail);
                    $province = $rtmp[0];
                    $province_id = 0;
                    if(isset($rtmp[1])) $city = $rtmp[1];
                    foreach($province_list as $kpr=>$pr)
                    {
                        if($pr->province_name == $province)
                        {
                            $province_id = $pr->id;
                            break;
                        }
                    }
                    $city_id = 0;
                    if($province_id != 0) 
                    {
                        foreach($city_list as $c)
                        {
                            if($c->province_id == $province_id && $city == $c->city_name)
                            {
                                $city_id = $c->id;
                            }
                        }
                    }
                    $region_arr[$po->id][] = array('province_id'=>$province_id, 'city_id' => $city_id, 'policy_id'=>$po->id);
                
            //}

 
        
        }

        foreach($region_arr as $id=>$val)
        {
            foreach ($val as $key => $value) {
                DB::table('policy')->where('id', $value['policy_id'])->update([
                    'minitry_id' => $value['province_id'],
                    'sub_minitry_id' => $value['city_id']
                ]);
                
            }
        }
        //var_dump($region_arr);
        die();
 



*
 //change category name
 $sql = "SELECT * FROM `policy` where category like '%研究開発 \/ 商品・サービス開発%'";
        $result = DB::select($sql);
        foreach($result as $row)
        {
            $category_detail = json_decode($row->category_detail);
            if(!count($category_detail)) continue;
            $catss = [];
            foreach($category_detail as $key=>$val)
            {
                if($val[0] == '研究開発 / 商品・サービス開発'){
                    $category_detail[$key][0] = '設備導入・研究開発';
                }

                $catss[] = $category_detail[$key][0];
            }
            DB::table('policy')->where('id', $row->id)->update(['category'=> implode('AND', $catss), 'category_detail'=>json_encode($category_detail,JSON_UNESCAPED_UNICODE) ] );
        }

        die();
 




//move category_detail to new table (policy_category)
$arr = $arr1 = $dq = array();
        $policy = DB::table('policy')->get();
        $category_list = DB::table('categories')->get();
        $sub_list = DB::table('sub_category')->get();
        $cat_arr = $test_arr = array();
        foreach($policy as $kk=>$po)
        {
            $category_detail = $po->category_detail;
            //if(!stristr($register_insti_detail, ' '))
            //{
                $tmp = json_decode($category_detail);
                $test_arr[] = $tmp;
                foreach($tmp as $row) {
                    $p_cat = $row[0];
                    
                    $p_cat_id = 0;
                    //find parent cate
                    foreach($category_list as $vcat)
                    {
                        if($p_cat == $vcat->category_name)
                        {
                            $p_cat_id = $vcat->id;
                            break;
                        }
                    }

                    //loop sub_cat
                    $s_cat_id = array();
                    foreach($row[1] as $scat)
                    {
                        $tmp_s_cat_id = 0;
                        foreach($sub_list as $srow)
                        {
                            if($scat == $srow->sub_name && $p_cat_id == $srow->category_id)
                            {
                                $tmp_s_cat_id = $srow->id;
                                $s_cat_id[] = $tmp_s_cat_id;
                                break;
                            }
                        }

                        
                    }
                    // if(count($s_cat_id) == 0)
                    // {
                    //     var_dump($po->id);
                    //     var_dump($p_cat_id);
                    //     var_dump($s_cat_id);
                    //     //die();
                    // }
                    $cat_arr[$po->id] = array('p_id'=>$po->id, 'cat'=>$p_cat_id, 'sub'=>$s_cat_id);
                    
                }
            
        }
        

        foreach($cat_arr as $id=>$val)
        {
            foreach ($val['sub'] as $key => $value) {
                DB::table('policy_category')->insert([
                    'policy_id' => $id,
                    'category_id' => $val['cat'],
                    'sub_category_id' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }


        die();
 


//update user location / munipacity
        $arr = $arr1 = $dq = array();
        $user = DB::table('users')->get();
        $province_list = DB::table('provinces')->get();
        $city_list = DB::table('cities')->get();
        $region_arr = array();
        foreach($user as $po)
        {
            $location = $po->location;
            //if(!stristr($register_insti_detail, ' '))
            //{
            $province = $location;
            $province_id = 0;
            $province_name = '';
            $city_name = '';
            $city = $po->municipality;
                    foreach($province_list as $kpr=>$pr)
                    {
                        if($pr->province_name == $province)
                        {
                            $province_id = $pr->id;
                            break;
                        }
                    }
                    $city_id = 0;
                    if($province_id != 0) 
                    {
                        foreach($city_list as $c)
                        {
                            if($c->province_id == $province_id && $city == $c->city_name)
                            {
                                $city_id = $c->id;
                            }
                        }
                    }


            if($province != '' && $province_id == 0) $province_name = $province;
            if($city != '' && $city_id == 0) $city_name = $city;

                    $region_arr[] = array('province_id'=>$province_id, 'city_id' => $city_id, 'user_id'=>$po->id, 'province_name'=>$province_name, 'city_name'=>$city_name);
                
            //}
            //
        
        }
        foreach($region_arr as $id=>$val)
        {
                DB::table('user_location')->insert([
                    'user_id' => $val['user_id'],
                    'province_id' => $val['province_id'],
                    'province_name' => $val['province_name'],
                    'city_id' => $val['city_id'],
                    'city_name' => $val['city_name'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }
        //var_dump($region_arr);
        die();
        
       

// move user category to new table
        $arr = $arr1 = $dq = array();
        $users = DB::table('users')->get();
        $category_list = DB::table('categories')->get();
        $sub_list = DB::table('sub_category')->get();
        $cat_arr = $test_arr = array();
        foreach($users as $kk=>$po)
        {
            $category_detail = $po->category_detail;
            //if(!stristr($register_insti_detail, ' '))
            //{
            

                $tmp = json_decode($category_detail);
                //dd($tmp);
                foreach($tmp as $row) {
                    $p_cat = $row[0];
                    
                    $p_cat_id = [0];
                    //find parent cate
                    foreach($category_list as $vcat)
                    {
                        if($p_cat == $vcat->category_name)
                        {
                            $p_cat_id = $vcat->id;
                            break;
                        }
                    }

                    //loop sub_cat
                    $s_cat_id = array();
                    foreach($row[1] as $scat)
                    {
                        $tmp_s_cat_id = 0;
                        foreach($sub_list as $srow)
                        {
                            if($scat == $srow->sub_name && $p_cat_id == $srow->category_id)
                            {
                                $tmp_s_cat_id = $srow->id;
                                $s_cat_id[] = $tmp_s_cat_id;
                                break;
                            }
                        }

                        
                    }
                    $cat_arr[$po->id][] = array('p_id'=>$po->id, 'cat'=>$p_cat_id, 'sub'=>$s_cat_id);
                }

            
        }
        foreach($cat_arr as $id=>$val)
        {
            foreach($val as $us)
            {
                foreach ($us['sub'] as $key => $value) {
                DB::table('user_category')->insert([
                    'user_id' => $id,
                    'category_id' => $us['cat'],
                    'sub_category_id' => $value,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            }
            
        }


        die();
        

//update user agency_type_id
        $arr = $arr1 = $dq = array();
        $user = DB::table('users')->get();
        $agency_list = DB::table('admin_agency_type')->get();
        foreach($user as $po)
        {
            $agency_type = $po->agency_type;
            $agency_type_id = 0;
            foreach($agency_list as $kpr=>$pr)
            {
                if($pr->agency_type == $agency_type)
                {
                    $agency_type_id = $pr->id;
                    break;
                }
            }

            DB::table('users')->where('id', $po->id)->update(['agency_type_id'=>$agency_type_id]);
        }
        die();
 


//users.business_type -> user_business (trades.id)
        $arr = $arr1 = $dq = array();
        $user = DB::table('users')->get();
        $up_list = DB::table('trades')->get();
        foreach($user as $po)
        {
            $up_json = json_decode($po->business_type);
            if(!count($up_json)) continue;
            foreach($up_json as $val) {
                $up_id = 0;
                foreach($up_list as $kpr=>$pr)
                {
                    if($pr->trade == $val)
                    {
                        $up_id = $pr->id;
                        break;
                    }
                }

                DB::table('user_business')->insert([
                    'user_id'=>$po->id, 
                    'trade_id'=>$up_id, 
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        die();
 



//users.pro_part -> user_pro_part (tags.id)
        $arr = $arr1 = $dq = array();
        $user = DB::table('users')->get();
        $up_list = DB::table('tags')->get();
        foreach($user as $po)
        {
            $up_json = json_decode($po->pro_part);
            if(!count($up_json)) continue;
            foreach($up_json as $val) {
                $up_id = 0;
                foreach($up_list as $kpr=>$pr)
                {
                    if($pr->tag == $val)
                    {
                        $up_id = $pr->id;
                        break;
                    }
                }

                DB::table('user_pro_part')->insert([
                    'user_id'=>$po->id, 
                    'tag_id'=>$up_id, 
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        die();
 


//users.address1 -> user_address (provinces.id cities.id)
        $arr = $arr1 = $dq = array();
        $user = DB::table('users')->get();
        $up_list = DB::table('provinces')->get();
        $up_list2 = DB::table('cities')->get();
        foreach($user as $po)
        {
            $up_json = json_decode($po->address1);
            
            if(!count($up_json)) continue;
            //dd($up_json);die();
            foreach($up_json as $val) {
                $up_id = 0;
                $up_id2 = 0;
                foreach($up_list as $kpr=>$pr)
                {
                    if($pr->province_name == $val[0])
                    {
                        $up_id = $pr->id;
                        break;
                    }
                }
                foreach($up_list2 as $kpr=>$pr)
                {
                    if($pr->city_name == $val[1])
                    {
                        $up_id2 = $pr->id;
                        break;
                    }
                }

                DB::table('user_address')->insert([
                    'user_id'=>$po->id, 
                    'province_id'=>$up_id, 
                    'city_id'=>$up_id2, 
                    'address_type'=>1, 
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        die();
 


//policy.business_type -> policy_business table
        $arr = $arr1 = $dq = array();
        $from_list = DB::table('policy')->get();
        $up_list = DB::table('trades')->get();
        foreach($from_list as $po)
        {
            $up_json = json_decode($po->business_type);
            if(!count($up_json)) continue;
            foreach($up_json as $val) {
                $up_id = 0;
                foreach($up_list as $kpr=>$pr)
                {
                    if($pr->trade == $val)
                    {
                        $up_id = $pr->id;
                        break;
                    }
                }

                DB::table('policy_business')->insert([
                    'policy_id'=>$po->id, 
                    'trade_id'=>$up_id, 
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        die();
 


//policy.tag -> policy_tag table
        $arr = $arr1 = $dq = array();
        $from_list = DB::table('policy')->get();
        $up_list = DB::table('tags')->get();
        foreach($from_list as $po)
        {
            $up_json = json_decode($po->tag);
            if(!count($up_json)) continue;
            foreach($up_json as $val) {
                $up_id = 0;
                foreach($up_list as $kpr=>$pr)
                {
                    if($pr->tag == $val)
                    {
                        $up_id = $pr->id;
                        break;
                    }
                }

                DB::table('policy_tag')->insert([
                    'policy_id'=>$po->id, 
                    'tag_id'=>$up_id, 
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        die();
 