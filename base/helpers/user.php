<?php
use app\models\CompanyProfile;
use Carbon\Carbon;
// Get current user


function tariffUsers($tariff_id)
{
    $tariff = \app\models\Tariffs::findOne($tariff_id);
    return $tariff;
}

function allTariffUsers($subscription_id, $tariff_id, $role_name)
{
    $tariffAllowedUser = (\app\models\Tariffs::findOne($tariff_id))->$role_name;
    $additionalBoughtUser = \app\models\AdditionalUsersTable::findOne(
        [
            'subscription_id' => $subscription_id,
            'role' => $role_name,
        ]
    );
    if (!empty($additionalBoughtUser)) {
        return $tariffAllowedUser + $additionalBoughtUser->quantity;
    } else {
        return $tariffAllowedUser;
    }
}

function extraUserPrices($key,$in_tariff=false)
{
    $extraUserPrice = \app\models\UnitPrices::findOne(['unit_key'=>$key]);

    if($in_tariff) {
        $subscription = \app\models\Subscriptions::findOne(company_info()['subscription_id']);
        $tariff = \app\models\Tariffs::findOne($subscription->tariff_id);
        $overallDays = $tariff->months_quantity*30;
        $daysLeft = Carbon::now()->diffInDays($subscription->subscription_end_date);

        $quarterPeriod = intval( $overallDays / 4);
        $halfPeriod =  intval($overallDays /2);

        if($daysLeft  <= $quarterPeriod) {
            return number_format($extraUserPrice->unit_value / 4,2);
        } elseif($daysLeft <= $halfPeriod) {
            return number_format($extraUserPrice->unit_value / 2,2);
        } else {
            return number_format($extraUserPrice->unit_value,2);
        }
    }

    return $extraUserPrice->unit_value;
}



function check_tariff($user_id)
{
    $company = CompanyProfile::findOne(['user_id'=>$user_id]);
    if ($company->free_trial == CompanyProfile::TRIAL_ACTIVE) {
        if(Carbon::now()<= $company->free_triel_end_date) {
            return [
              'status'=>'active',
              'leftDays'=>Carbon::now()->diffInDays($company->free_triel_end_date, false)
            ];
        } else {
            return  [
                'status'=>'inactive',
                'finished_date'=>$company->free_triel_end_date
            ];
        }
    }
}


function company_name()
{
    $user_id = current_user_id();
    $company = \app\models\CompanyProfile::findOne(['user_id'=>$user_id]);
    return $company->company_name??'-';
}

function company_info()
{
    $user_id = current_user_id();
    $company = \app\models\CompanyProfile::findOne(['user_id'=>$user_id]);
    return $company;
}

function userRoles()
{
    $roles = Yii::$app->authManager->getRoles();
    unset($roles['cadmin']);
    unset($roles['superadmin']);
    return $roles;
}


function current_user()
{
    return \Yii::$app->user->identity->id;
}

// Get current user id
function current_user_id()
{
    $user = \Yii::$app->user;
    $user_id = $user->getId();
    return is_numeric($user_id) ? $user_id : 0;
}

// Get current user profile
function current_user_profile($user_id = null)
{
    if (is_null($user_id)) {
        $user_id = current_user_id();
    }

//    return \base\libs\Redis::getUserProfile($user_id);
}

function getUserRole()
{
   return array_keys(current_user_roles(current_user()))[0];
}

// Get current user roles
function current_user_roles($user_id = null)
{
    if (!is_null($user_id)) {
       return \Yii::$app->authManager->getRolesByUser($user_id);
    }

//    return \base\libs\Redis::getUserRoles($user_id);
}

// Check user logged in
function is_user_logged_in()
{
    $isGuest = Yii::$app->user->isGuest;
    return $isGuest ? false : true;
}

