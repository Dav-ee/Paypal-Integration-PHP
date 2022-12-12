<?php
require_once 'a_config.php';
 
if (isset($_POST['submit'])) {
    try {
        $response = $gateway->purchase(array(
            'amount' => $_POST['amount'],
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
            'items' => array(
                array(
            'name' => 'Course Subscriptions',
            'price' => $_POST['amount'],
            'description' => 'Get access to premium courses.',
            'quantity' => 1
            ))
        ))->send();
 
        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}