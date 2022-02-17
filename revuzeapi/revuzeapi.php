<?php

function get_product_data($id) {

    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;

    $response   = send_api($product_id , 'GET');
    return  $response;

}


add_action( 'wp_ajax_get_product_data', 'get_product_dataajax' );
add_action( 'wp_ajax_nopriv_get_product_data', 'get_product_dataajax' );

function get_product_dataajax($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $response   = send_api($product_id , 'GET');
    echo  $response;
}

function get_products($page) {
    $request     = 'products?page='.$page;
    $response    = send_api($request, 'GET');
    return  $response;

}
function get_categoriesapi() {
    $request     = 'categories';
    $response    = send_api($request, 'GET');
    return  $response;

}

add_action( 'wp_ajax_get_industry_data', 'get_industry_data' );
add_action( 'wp_ajax_nopriv_get_industry_data', 'get_industry_data' );

function get_industry_data($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $industry_id = $_POST['industry_id'];
    $response    = send_api($product_id , 'GET');

    return  $response;

}



add_action( 'wp_ajax_get_auto', 'get_auto' );
add_action( 'wp_ajax_nopriv_get_auto', 'get_auto' );

function get_auto() {

    $request='autocomplete/'.$_POST['search'];
    $response    = send_api($request , 'GET');
    echo  $response;
    die();
}




function get_competitive_products($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }

    $product_id = $id;
    $request     = $product_id . '/competitiveProducts?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    //$request     = $product_id . 'competitiveProducts?fromDate=01/2020&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}
add_action( 'wp_ajax_get_competitive_products', 'get_competitive_productsajax' );
add_action( 'wp_ajax_nopriv_get_competitive_products', 'get_competitive_productsajax' );

function get_competitive_productsajax($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }

    $product_id = $id;
    $request     = $product_id . '/competitiveProducts?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    //$request     = $product_id . 'competitiveProducts?fromDate=01/2020&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    echo   $response;

}

add_action( 'wp_ajax_get_competitive_brands', 'get_competitive_brands' );
add_action( 'wp_ajax_nopriv_get_competitive_brands', 'get_competitive_brands' );

function get_competitive_brands($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/competitiveBrands?fromDate=01/2020&toDate=02/2021';
    $request     = $product_id . 'competitiveBrands?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}


function category_top_10_products_data($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id . '/competitive-landscape-products?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}

function category_top_10_brands($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id . '/competitiveBrands?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');
    return  $response;

}
function all_topics_data($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $date=mktime(0, 0, 0, date('m')-3, date('d') , date('Y'));
    $dateto=mktime(0, 0, 0, date('m')-0, date('d') , date('Y'));

    $request     = $product_id . '/topics/satisfaction?fromDate='.date("m/Y", $date).'&toDate=' . date("m/Y", $dateto);
    $response    = send_api($request, 'GET');
    return  $response;

}
function all_topics_data2($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $date=mktime(0, 0, 0, date('m')-4, date('d') , date('Y'));
    $dateto=mktime(0, 0, 0, date('m')-0, date('d') , date('Y'));

    $request     = $product_id . '/topics/satisfaction?fromDate='.date("m/Y", $date).'&toDate=' . date("m/Y", $dateto);
    $response    = send_api($request, 'GET');
    return  $response;

}



function product_monthly_star_rating($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id . '/monthlyStarRating?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}
function star_rating_drivers($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id . '/starRatingDrivers?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}
function monthly_number_of_verified_buyers($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id . '/monthlyVerifiedBuyers?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}

add_action( 'wp_ajax_get_overall_sentiment', 'get_overall_sentiment' );
add_action( 'wp_ajax_nopriv_get_overall_sentiment', 'get_overall_sentiment' );

function get_overall_sentiment($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/monthlyOverallSentiment?fromDate=01/2020&toDate=02/2021';
    $request     = $product_id . 'monthlyOverallSentiment?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}

add_action( 'wp_ajax_get_monthly_verified_buyers', 'get_monthly_verified_buyers' );
add_action( 'wp_ajax_nopriv_get_monthly_verified_buyers', 'get_monthly_verified_buyers' );

function get_monthly_verified_buyers($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/monthlyVerifiedBuyers?fromDate=01/2020&toDate=02/2021';
    $request     = $product_id . '/monthlyVerifiedBuyers?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}


add_action( 'wp_ajax_get_star_rating', 'get_star_rating' );
add_action( 'wp_ajax_nopriv_get_star_rating', 'get_star_rating' );
function get_star_rating($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/monthlyReviews?fromDate=01/2015&toDate=02/2021';
    $request     = $product_id . '/monthlyStarRating?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}


function get_monthly_reviews($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/monthlyReviews?fromDate=01/2015&toDate=02/2021';
    $request     = $product_id . '/monthlyReviews?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;
}

add_action( 'wp_ajax_get_monthly_reviews', 'get_monthly_reviewsajax' );
add_action( 'wp_ajax_nopriv_get_monthly_reviews', 'get_monthly_reviewsajax' );
function get_monthly_reviewsajax($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/monthlyReviews?fromDate=01/2015&toDate=02/2021';
    $request     = $product_id . '/monthlyReviews?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    echo   $response;

}

add_action( 'wp_ajax_get_monthly_rank', 'get_monthly_rank' );
add_action( 'wp_ajax_nopriv_get_monthly_rank', 'get_monthly_rank' );
function get_monthly_rank($id=0) {

    if(!$id){
        $id=$_POST['product_id'];
    }

    $product_id = $id;
    // $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=04/2021';
    $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=' . date("m/Y");



    $response    = send_api($request, 'GET');

    return  $response;

}
add_action( 'wp_ajax_get_topic_monthly_sentiment', 'get_topic_monthly_sentiment' );
add_action( 'wp_ajax_nopriv_get_topic_monthly_sentiment', 'get_topic_monthly_sentiment' );
function get_topic_monthly_sentiment($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=04/2021';
    $request     = $product_id . '/mega-topic/monthlySentiment?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');

    return  $response;

}
add_action( 'wp_ajax_get_topic_monthly_sentiment', 'get_topic_monthly_sentiment' );
add_action( 'wp_ajax_nopriv_get_topic_monthly_sentiment', 'get_topic_monthly_sentiment' );

function get_most_discussed_topics($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=04/2021';
    $request     = $product_id . '/topic/mostLiked?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET',1);
    $most_discussed_topics=array();
    $discussed_topics = json_decode($response);
    foreach($discussed_topics as $value){
        foreach($value as $val) {
            foreach ($val as $v) {
                if(!in_array($v,$most_discussed_topics) ){
                    $most_discussed_topics[]=$v;
                }

            }
        }
    }
    $topics_of_product_arr=array();
//    foreach($most_discussed_topics as $value){
//        $topics_of_product=get_most_discussed_topics_of_product($product_id,$value);
//        $topics_of_product_arr[$value]=json_decode($topics_of_product);
//    }

    $response='['.json_encode($topics_of_product_arr).']';
    return  $response;

}

function get_most_discussed_topics_of_product($topicUuid,$date1,$date2,$id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $request     = $product_id .'/topic/'.$topicUuid. '/sentiment?fromDate='.$date2.'&toDate=' . $date1;

    $response    = send_api($request, 'GET',1);

    return  $response;

}

function get_topicsAdvDisadv($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    // $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=04/2021';
    $request     = $product_id . '/topicsAdvDisadv?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET',1);

    return  $response;

}





add_action( 'wp_ajax_get_topic_monthly_sentiment_compare', 'get_topic_monthly_sentiment_compare' );
add_action( 'wp_ajax_nopriv_get_topic_monthly_sentiment_compare', 'get_topic_monthly_sentiment_compare' );
function get_topic_monthly_sentiment_compare($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $product_id_2  = $_POST['product_id_2'];
    // $request     = $product_id . '/getMonthlyRank?fromDate=01/2015&toDate=04/2021';
    $request     = $product_id . '/mega-topic/monthlySentiment?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response    = send_api($request, 'GET');
    $request2    = $product_id_2 . '/mega-topic/monthlySentiment?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
    $response2   = send_api($request2, 'GET');

    $main_response = array(
        "response_1" => $response,
        "response_2" => $response2,
    );
    echo json_encode($main_response);

}


function send_api( $request, $method , $newapi=0) {

    $curl = curl_init();
    $date = get_field('data_update_token', 'option', false);
    $date = new DateTime($date);
    $date_post=strtotime($date->format('Y-m-d H:i:s'));

    $now = time();
    $datediff = $now - $date_post;
    $days= $datediff / (60 * 60 * 24);

    if($days>1){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-production.revuze.it/api/auth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "username": "mr.rempel@gmail.com",
                "password": "maratrq1w2e3r4t5%"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $json=json_decode($response);
        $token=$json->token_type.'  '.$json->access_token;

        update_field('token', $token, 'option');
        update_field('data_update_token', date('Y-m-d H:i:s'), 'option');
    }

    $link='https://api-production.revuze.it/api/entities/';

//
//    if($newapi){
//        $link='https://api-production.revuze.it/api/entities/';
//    }else{
//        $link='https://api-production.revuze.it/api/entities/';
//    }



    $headers = array(
        'Authorization:'.get_field('token','option'),
        'cache-control: no-cache',
        'content-type: application/json'
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => $link . $request,

      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
    ));




    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

//    print_R('</br>');
//    print_R($method);
//    print_R('</br>');
//    print_R('</br>');
//    print_R($headers);
//    print_R('</br>');
//
//    print_R($request);
//    print_R('</br>');
//    print_R('</br>');
//    print_R($response);
//    if($request=='70625acbb6b2962a96e1572230bcc73162cbcd3ce9fbba3cc714b6059c41c2b4/topicsAdvDisadv?fromDate=12/2020&toDate=12/2021') {
//        echo get_field('token','option');
//        print_R('<strong>');
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        echo 'Status:'.$http_status;
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        print_R('Link request: '.$link . $request);
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        print_R('Response:'.$response);
//        print_R('</br>');
//        print_R('////////////////////////////////////////////////');
//        print_R('</br>');
//        print_R('</strong>');
//    }
    return $response;
}
