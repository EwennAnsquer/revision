<?php

function makeCurlRequest($url, $method = 'GET', $data = null, $headers = array('Content-Type: application/json')) {
    $curl = curl_init();

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    );

    if ($method == 'POST' && $data) {
        $options[CURLOPT_POSTFIELDS] = json_encode($data);
    }

    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        return array('error' => true, 'message' => $error_msg);
    }

    curl_close($curl);
    return json_decode($response, true);
}

function getProducts() {
    return makeCurlRequest('https://fakestoreapi.com/products');
}

function getAllCategories() {
    return makeCurlRequest('https://fakestoreapi.com/products/categories');
}

function addProduct($title, $price, $description, $image, $category) {
    $data = array(
        "title" => $title,
        "price" => $price,
        "description" => $description,
        "image" => $image,
        "category" => $category
    );
    $response = makeCurlRequest('https://fakestoreapi.com/products', 'POST', $data);
    echo json_encode($response);
}

?>