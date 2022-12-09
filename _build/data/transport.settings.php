<?php

/**
 * Loads system settings into build
 * @var modX $modx
 * @package msprobokassa
 * @subpackage build
 */
$settings = [];

$tmp = [
    'ms2_payment_paypal_api_url' => [
        'value' => 'https://api-3t.paypal.com/nvp',
        'xtype' => 'textfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_checkout_url' => [
        'value' => 'https://www.paypal.com/webscr?cmd=_express-checkout&token=',
        'xtype' => 'textfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_currency' => [
        'value' => 'USD',
        'xtype' => 'textfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_user' => [
        'value' => '',
        'xtype' => 'textfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_pwd' => [
        'value' => '',
        'xtype' => 'text-password',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_signature' => [
        'value' => '',
        'xtype' => 'text-password',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_success_id' => [
        'value' => '',
        'xtype' => 'numberfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_cancel_id' => [
        'value' => '',
        'xtype' => 'numberfield',
        'area' => 'ms2_payment',
    ],
    'ms2_payment_paypal_cancel_order' => [
        'value' => false,
        'xtype' => 'combo-boolean',
        'area' => 'ms2_payment',
    ],
];

foreach ($tmp as $k => $v) {
    /* @var modSystemSetting $setting */
    $setting = $modx->newObject(modSystemSetting::class);
    $setting->fromArray(array_merge(
        [
            'key' => $k,
            'namespace' => 'minishop2',
            'editedon' => date('Y-m-d H:i:s'),
        ],
        $v
    ), '', true, true);

    $settings[] = $setting;
}

unset($tmp);
return $settings;
