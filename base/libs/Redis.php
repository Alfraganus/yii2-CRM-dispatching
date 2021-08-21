<?php

namespace base\libs;

use common\models\Profile;
use Yii;

class Redis extends RedisApp
{
    public static $key_user_roles = 'user-roles';
    public static $key_user_profile = 'user-profile';

    public static function brandItem($command = 'set', $id, $action = '', $object = null)
    {
        $prefix = "get-brand-item-id-{$id}-";
        return self::cachedItem($prefix, $command, $id, $action, $object);
    }

    public static function brandSqlQueries($command = 'set', $query_key = '', $result = null)
    {
        $prefix = "get-brand-sql-query-";
        return self::cachedSqlQueries($prefix, $command, $query_key, $result);
    }

    public static function contentItem($command = 'set', $id, $action = '', $object = null)
    {
        $prefix = "get-content-item-id-{$id}-";
        return self::cachedItem($prefix, $command, $id, $action, $object);
    }

    public static function contentSqlQueries($command = 'set', $query_key = '', $result = null)
    {
        $prefix = "get-content-sql-query-";
        return self::cachedSqlQueries($prefix, $command, $query_key, $result);
    }

    public static function segmentItem($command = 'set', $id, $action = '', $object = null)
    {
        $prefix = "get-segment-item-id-{$id}-";
        return self::cachedItem($prefix, $command, $id, $action, $object);
    }

    public static function segmentSqlQueries($command = 'set', $query_key = '', $result = null)
    {
        $prefix = "get-segment-sql-query-";
        return self::cachedSqlQueries($prefix, $command, $query_key, $result);
    }

    public static function productItem($command = 'set', $id, $action = '', $object = null)
    {
        $prefix = "get-product-item-id-{$id}-";
        return self::cachedItem($prefix, $command, $id, $action, $object);
    }

    public static function menuItem($command = 'set', $id, $action = '', $object = null)
    {
        $prefix = "get-menu-item-id-{$id}-";
        return self::cachedItem($prefix, $command, $id, $action, $object);
    }

    public static function productSqlQueries($command = 'set', $query_key = '', $result = null)
    {
        $prefix = "get-product-sql-query-";
        return self::cachedSqlQueries($prefix, $command, $query_key, $result);
    }

    public static function menuSqlQueries($command = 'set', $query_key = '', $result = null)
    {
        $prefix = "get-menu-sql-query-";
        return self::cachedSqlQueries($prefix, $command, $query_key, $result);
    }

    public static function wishlistSqlQueries($command = 'set', $user_id = 0, $result = null)
    {
        if (is_numeric($user_id) && $user_id > 0) {
            $prefix = "get-wishlist-sql-query-";
            return self::cachedSqlQueries($prefix, $command, $user_id, $result, 'single');
        }
    }

    private static function cachedItem($prefix, $command = 'set', $id, $action = '', $object = null)
    {
        if (is_string($prefix) && !empty($prefix) && is_numeric($id) && $id > 0) {
            $key = "{$prefix}{$action}";

            if ($command == 'get') {
                $cached_item = self::get($key);

                if (!is_null($cached_item) && is_string($cached_item) && !empty($cached_item)) {
                    $hash = self::crypt('decrypt', $cached_item);
                    return unserialize($hash);
                }
            } elseif ($command == 'set' && !is_null($object)) {
                $serialize = serialize($object);
                $hash = self::crypt('encrypt', $serialize);
                self::set($key, $hash);
            } elseif ($command == 'delete') {
                $cached_keys = self::keys($prefix . '*');

                if ($cached_keys && is_array($cached_keys)) {
                    foreach ($cached_keys as $cached_key) {
                        self::delete($cached_key, false);
                    }
                } elseif ($cached_keys && is_string($cached_keys)) {
                    self::delete($cached_keys, false);
                }
            }
        }
    }

    private static function cachedSqlQueries($prefix, $command = 'set', $query_key = '', $result = null, $delete = 'multi')
    {
        if (is_string($prefix) && !empty($prefix)) {
            $key = "{$prefix}{$query_key}";

            if ($command == 'get') {
                $cached_item = self::get($key);

                if (!is_null($cached_item) && is_string($cached_item) && !empty($cached_item)) {
                    $hash = self::crypt('decrypt', $cached_item);
                    return unserialize($hash);
                }
            } elseif ($command == 'set' && !is_null($result)) {
                $serialize = serialize($result);
                $hash = self::crypt('encrypt', $serialize);
                self::set($key, $hash);
            } elseif ($command == 'delete') {
                if ($delete == 'single') {
                    self::delete($key);
                } else {
                    $cached_keys = self::keys($prefix . '*');
    
                    if ($cached_keys && is_array($cached_keys)) {
                        foreach ($cached_keys as $cached_key) {
                            self::delete($cached_key, false);
                        }
                    } elseif ($cached_keys && is_string($cached_keys)) {
                        self::delete($cached_keys, false);
                    }
                }
            }
        }
    }

    public static function getUrlObjectKey()
    {
        $output = false;
        $url = Yii::$app->request->url;

        if ($url) {
            $redis_key = preg_replace("/\s+/", "", $url);
            $redis_key = trim($redis_key, '/');
            $redis_key = str_replace("/", "-", $redis_key);

            $output = $redis_key;
        }

        return $output;
    }

    public static function getUrlObjectsListKey($type)
    {
        $output = false;

        if ($type) {
            $output = $type . '-items-url-list';
        }

        return $output;
    }

    public static function getFrontendObjectKey($id, $type)
    {
        $output = false;

        if (is_numeric($id) && $type) {
            $output = $type . '-frontend-item-id-' . $id;
        }

        return $output;
    }

    public static function getFrontendObject($type)
    {
        $output = false;
        $list_key = self::getUrlObjectsListKey($type);

        if ($list_key) {
            $list_object = self::get($list_key);

            if ($list_object && !is_null($list_object)) {
                $unserialized = unserialize($list_object);

                if ($unserialized) {
                    $key = self::getUrlObjectKey();

                    if (isset($unserialized[$key]) && $unserialized[$key]) {
                        $redis_object_key = $unserialized[$key];
                        $output = self::get($redis_object_key);
                    }
                }
            }
        }

        return $output;
    }

    public static function setUrlObject($type, $id)
    {
        $url = Yii::$app->request->url;
        $list_key = self::getUrlObjectsListKey($type);

        if ($list_key && $url) {
            $redis_key = self::getFrontendObjectKey($id, $type);

            if ($redis_key) {
                $key = self::getUrlObjectKey();
                $redis_object = self::get($list_key);
                $redis_item[$key] = $redis_key;

                if ($redis_object && !is_null($redis_object)) {
                    $unserialized = unserialize($redis_object);
                    $redis_item = array_merge($unserialized, $redis_item);
                }

                self::set($list_key, serialize($redis_item));
            }
        }
    }

    public static function setFrontendObject($type, $id, $data)
    {
        $redis_key = self::getFrontendObjectKey($id, $type);

        if ($redis_key) {
            self::set($redis_key, serialize($data));
        }
    }

    public static function getUserProfile($user_id)
    {
        $output = false;

        if (is_numeric($user_id) && $user_id > 0) {
            // Check redis
            $is_active = self::is_active();
            $key = self::$key_user_profile . '-' . $user_id;

            if ($is_active) {
                $redis_object = self::get($key);

                if (!is_null($redis_object) && is_string($redis_object) && !empty($redis_object)) {
                    $hash = self::crypt('decrypt', $redis_object);
                    return unserialize($hash);
                }
            }

            $output = Profile::find()->where(['user_id' => $user_id])->one();

            // Set to redis
            $serialize = serialize($output);
            $hash = self::crypt('encrypt', $serialize);
            self::set($key, $hash);
        }

        return $output;
    }

    public static function getUserRoles($user_id)
    {
        $output = false;

        if (is_numeric($user_id) && $user_id > 0) {
            // Check redis
            $is_active = self::is_active();
            $key = self::$key_user_roles . '-' . $user_id;

            if ($is_active) {
                $redis_object = self::get($key);

                if (!is_null($redis_object) && is_string($redis_object) && !empty($redis_object)) {
                    $hash = self::crypt('decrypt', $redis_object);
                    return unserialize($hash);
                }
            }

            $output = Yii::$app->authManager->getRolesByUser($user_id);

            // Set to redis
            $serialize = serialize($output);
            $hash = self::crypt('encrypt', $serialize);
            self::set($key, $hash);
        }

        return $output;
    }
}
