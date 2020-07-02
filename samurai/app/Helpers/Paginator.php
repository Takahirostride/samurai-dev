<?php
namespace App\Helpers;

class Paginator {
	//number limit of query
    //number page current
    //total record of query
	public static function show($limit, $page, $total, $list_class='paginate') {

		try {
			// $page = $page + 1;
			if ( $limit == 'all' ) {
		        return '';
		    }
		 
		    $last       = ceil( $total / $limit );
		 
		    $start      = ( ( $page ) > 2 ) ? $page - 1 : 1;
		    $end        = ( ( $page ) < $last ) ? $page + 1 : $last;

		    $html       = '<ul class="pagination" id="' . $list_class . '">';
		 
		    $class      = ( $page == 1 ) ? "disabled" : "";
		    $html       .= '<li class="' . $class . '"><button '. $class .' data-page="' . ( $page - 1 ) . '">最初</button></li>';
		 
		    if ( $start >= 2 ) {
		        $html   .= '<li><button data-page="1">1</button></li>';
		        $html   .= '<li class="disabled"><span>...</span></li>';
		    }
		 
		    for ( $i = $start ; $i <= $end; $i++ ) {
		        $class  	= ( $page == $i ) ? "active" : "";
		        $disabled  	= ( $page == $i ) ? "disabled" : "";
		        $html   .= '<li class="' . $class . '"><button ' . $disabled . ' class="' . $class . '" data-page="' . $i . '">' . $i . '</button></li>';
		    }
		 
		    if ( $end < $last ) {
		    	$html   .= '<li class="disabled"><span>...</span></li>';
		        $html   .= '<li><button data-page="' . $last . '">' . $last . '</button></li>';
		    }
		 
		    $class      = ( $page == $last ) ? "disabled" : "";
		    $html       .= '<li class="' . $class . '"><button '. $class .' class="' . $class . '" data-page="' . ( $page + 1 ) . '">最後</button></li>';
		 
		    $html       .= '</ul>';
		 
		    return  ($total > 0) ? $html : '';
		} catch (\Exception $e) {
            echo $e->getMessage();
        }
	}
}