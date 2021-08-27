<?php
// Get current user

function company_name()
{
    $user_id = current_user_id();
    $company = \app\models\CompanyProfile::findOne(['user_id'=>$user_id]);
    return $company->company_name;
}

function current_user()
{
    return \Yii::$app->user->identity;
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

// Get current user roles
function current_user_roles($user_id = null)
{
    if (is_null($user_id)) {
        $user_id = current_user_id();
    }

//    return \base\libs\Redis::getUserRoles($user_id);
}

// Check user logged in
function is_user_logged_in()
{
    $isGuest = Yii::$app->user->isGuest;
    return $isGuest ? false : true;
}

