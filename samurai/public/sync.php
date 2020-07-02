<?php  
// đồng bộ dữ liệu question
// $questions = DB::table('category_content')->select(['detail','detail_question', 'type', 'display', 'location'])->where('detail_question', '<>', '')->get();
// foreach ($questions as $key => $question) {
//     $data = [];
//     $dl = [];
//     $dl['detail_question'] = $question->detail_question;
//     $dl['type'] = $question->type;
//     $dl['display'] = $question->display;
//     $dl['location'] = $question->location;
//     $data['question_id'] = DB::table('question')->insert($dl);
//     $data['sub_category_id'] = DB::table('sub_category')->where('sub_name', $question->detail)->first()->id;
//     DB::table('question_sub_category')->insert($data);
// }
?>