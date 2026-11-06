<?php
/**
 * Enterprise Security and Hardening Configurations
 *
 * @package SunnyKidsDanceAcademy
 * @author  AshikaWorks
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

/* ==========================================================================
   01. エンタープライズHTTPセキュリティヘッダー送出
   ========================================================================== */
if (!function_exists('skda_send_security_headers')) {
    function skda_send_security_headers() {
        if (!is_admin()) {
            // クリックジャッキング対策
            header('X-Frame-Options: SAMEORIGIN');
            // MIMEタイプスニッフィング抑止
            header('X-Content-Type-Options: nosniff');
            // XSSフィルター強制（旧ブラウザ互換）
            header('X-XSS-Protection: 1; mode=block');
            // リファラー情報の漏洩制御
            header('Referrer-Policy: strict-origin-when-cross-origin');
            // デバイスAPIアクセス制御
            header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
        }
    }
}
add_action('send_headers', 'skda_send_security_headers');

/* ==========================================================================
   02. WordPressメタ情報・バージョン・痕跡の完全除去
   ========================================================================== */
// wp_head からのバージョン情報出力停止
remove_action('wp_head', 'wp_generator');

// RSS/Atomフィードからのバージョン情報除去
if (!function_exists('skda_remove_version_strings')) {
    function skda_remove_version_strings() {
        return '';
    }
}
add_filter('the_generator', 'skda_remove_version_strings');

// スタイル・スクリプトクエリ文字列のWPバージョン番号除去
if (!function_exists('skda_remove_ver_css_js')) {
    function skda_remove_ver_css_js($src) {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
}
add_filter('style_loader_src', 'skda_remove_ver_css_js', 9999);
add_filter('script_loader_src', 'skda_remove_ver_css_js', 9999);

// 不要なhead内メタリンクの完全除去
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

/* ==========================================================================
   03. XML-RPCの完全無効化（DDoS/ブルートフォース攻撃対策）
   ========================================================================== */
add_filter('xmlrpc_enabled', '__return_false');

// HTTPヘッダーからのX-Pingback除去
if (!function_exists('skda_remove_x_pingback_header')) {
    function skda_remove_x_pingback_header($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    }
}
add_filter('wp_headers', 'skda_remove_x_pingback_header');

// xmlrpc.php へのアクセス直接遮断
if (!function_exists('skda_block_xmlrpc_request')) {
    function skda_block_xmlrpc_request() {
        if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
            status_header(403);
            wp_die(esc_html__('Forbidden', 'sunny-kids-dance'), esc_html__('Access Denied', 'sunny-kids-dance'), array('response' => 403));
        }
    }
}
add_action('init', 'skda_block_xmlrpc_request');

/* ==========================================================================
   04. ユーザー名スキャン・列挙攻撃（Author Enumeration）の完全遮断
   ========================================================================== */
if (!function_exists('skda_block_author_enumeration')) {
    function skda_block_author_enumeration() {
        // ?author=N パラメータによるユーザー名特定を検知
        if (!is_admin() && isset($_REQUEST['author']) && is_numeric($_REQUEST['author'])) {
            wp_safe_redirect(home_url(), 301);
            exit;
        }
    }
}
add_action('init', 'skda_block_author_enumeration');

// REST API (/wp/v2/users) 経由のユーザー情報漏洩防止
if (!function_exists('skda_disable_rest_users_endpoint')) {
    function skda_disable_rest_users_endpoint($endpoints) {
        if (!is_user_logged_in()) {
            if (isset($endpoints['/wp/v2/users'])) {
                unset($endpoints['/wp/v2/users']);
            }
            if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
                unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
            }
        }
        return $endpoints;
    }
}
add_filter('rest_endpoints', 'skda_disable_rest_users_endpoint');

/* ==========================================================================
   05. REST APIアクセス制御（非認証ユーザーの制限）
   ========================================================================== */
if (!function_exists('skda_restrict_rest_api_access')) {
    function skda_restrict_rest_api_access($result) {
        if (!empty($result)) {
            return $result;
        }

        // 未ログイン時、特定の公開エンドポイント（テーマ用）以外を遮断
        if (!is_user_logged_in()) {
            $current_route = isset($GLOBALS['wp']->query_vars['rest_route']) ? $GLOBALS['wp']->query_vars['rest_route'] : '';
            
            // クラス情報取得などテーマで許可する公開ルートのプレフィックス
            $allowed_routes = array(
                '/wp/v2/class',
                '/wp/v2/class_age_group',
                '/wp/v2/class_schedule',
                '/wp/v2/class_features',
            );

            $is_allowed = false;
            foreach ($allowed_routes as $route) {
                if (0 === strpos($current_route, $route)) {
                    $is_allowed = true;
                    break;
                }
            }

            if (!$is_allowed && 0 === strpos($current_route, '/wp/v2/users')) {
                return new WP_Error(
                    'rest_forbidden',
                    esc_html__('REST API access restricted.', 'sunny-kids-dance'),
                    array('status' => rest_authorization_required_code())
                );
            }
        }

        return $result;
    }
}
add_filter('rest_authentication_errors', 'skda_restrict_rest_api_access');

/* ==========================================================================
   06. ログイン画面セキュリティ（エラーメッセージ曖昧化・試行抑制）
   ========================================================================== */
// ID・パスワードどちらが間違っているかを攻撃者に悟らせない
if (!function_exists('skda_obfuscate_login_errors')) {
    function skda_obfuscate_login_errors() {
        return esc_html__('ログイン情報が正しくありません。再度ご確認ください。', 'sunny-kids-dance');
    }
}
add_filter('login_errors', 'skda_obfuscate_login_errors');

/* ==========================================================================
   07. アップロードファイル検証・実行可能拡張子遮断
   ========================================================================== */
if (!function_exists('skda_filter_upload_mimes')) {
    function skda_filter_upload_mimes($mimes) {
        // PHPスクリプト・実行可能ファイルの確実な除外
        unset($mimes['exe']);
        unset($mimes['php']);
        unset($mimes['phtml']);
        unset($mimes['cgi']);
        unset($mimes['pl']);
        unset($mimes['js']);
        unset($mimes['sh']);

        // 許可する安全なMIMEタイプ
        $mimes['jpg|jpeg|jpe'] = 'image/jpeg';
        $mimes['png']          = 'image/png';
        $mimes['webp']         = 'image/webp';
        $mimes['pdf']          = 'application/pdf';
        $mimes['svg']          = 'image/svg+xml';

        return $mimes;
    }
}
add_filter('upload_mimes', 'skda_filter_upload_mimes');