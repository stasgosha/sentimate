<?php
add_action( 'wp_ajax_get_product_data', 'get_product_data' );
add_action( 'wp_ajax_nopriv_get_product_data', 'get_product_data' );

function get_product_data($id=0) {
    if(!$id){
        $id=$_POST['product_id'];
    }
    $product_id = $id;
    $response   = send_api($product_id , 'GET');
    return  $response;

}

function get_products($page) {
    $request     = 'products?page='.$page;
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

add_action( 'wp_ajax_get_competitive_products', 'get_competitive_products' );
add_action( 'wp_ajax_nopriv_get_competitive_products', 'get_competitive_products' );

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
    $request     = $product_id . '/topics/satisfaction?fromDate='.date("m/Y", mktime(0, 0, 0, date('m'), date('d') , date('Y')-1)).'&toDate=' . date("m/Y");
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

add_action( 'wp_ajax_get_monthly_reviews', 'get_monthly_reviews' );
add_action( 'wp_ajax_nopriv_get_monthly_reviews', 'get_monthly_reviews' );
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


function send_api( $request, $method ) {

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







        $headers = array(
        'Authorization:'.get_field('token','option'),
        'cache-control: no-cache',
        'content-type: application/json'
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-production.revuze.it/api/entities/' . $request,

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
    curl_close($curl);
    return $response;
}
