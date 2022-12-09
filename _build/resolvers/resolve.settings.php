<?php

/** @var xPDOSimpleObject $object */
if ($object->xpdo) {
    /* @var modX $modx */
    $modx = $object->xpdo;

    /** @var array $options */
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $payment = $modx->getObject(msPayment::class, ['class' => 'PayPal']);

            if (!$payment) {
                $q = $modx->newObject(msPayment::class);
                $q->fromArray([
                    'name' => 'PayPal',
                    'active' => 0,
                    'class' => 'PayPal'
                ]);
                $save = $q->save();
            }

            /* @var miniShop2 $miniShop2 */
            $miniShop2 = $modx->getService('minishop2');

            if ($miniShop2) {
                $miniShop2->addService(
                    'payment',
                    'PayPal',
                    '{core_path}components/minishop2/custom/payment/paypal.class.php'
                );
            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            $miniShop2 = $modx->getService('minishop2');
            $miniShop2->removeService(
                'payment',
                'PayPal'
            );
            $payment = $modx->getObject(msPayment::class, ['class' => 'PayPal']);
            if ($payment) {
                $payment->remove();
            }
            $modx->removeCollection(modSystemSetting::class, ['key:LIKE' => 'ms2\_payment\_rb\_%']);
            break;
    }
}
return true;
