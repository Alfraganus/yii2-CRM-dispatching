<?php

function checkSubscription()
{
    $checkIfCompany = \app\models\CompanyProfile::find()->where(['user_id' => current_user()]);
    $checkIfUser = \app\models\UserProfile::find()->where(['user_id' => current_user()]);
    if ($checkIfCompany->exists()) {
        $company = $checkIfCompany->one();

        if ($company->free_trial = 1 && $company->free_triel_end_date < \Carbon\Carbon::now()) {

        } elseif (!empty($company->subscription_id) && $company->subscription->subscription_end_date < \Carbon\Carbon::now()) {


        }
    } elseif ($checkIfUser->exists()) {
        $user = $checkIfUser->one();

        if ($user->company->free_trial = 1 && $user->company->free_triel_end_date < \Carbon\Carbon::now()) {
//            Yii::$app->user->logout();

            Yii::$app->session->remove('auth');
            Yii::$app->getResponse()->redirect(array('auth/warning'));
        }

        elseif (!empty($user->company->subscription_id) && $user->company->subscription->subscription_end_date < \Carbon\Carbon::now()) {
            var_dump( $user->company->subscription->subscription_end_date);die;
//            Yii::$app->user->logout();
            Yii::$app->session->remove('auth');
            Yii::$app->getResponse()->redirect(array('auth/warning'));
        }

    }
}

?>