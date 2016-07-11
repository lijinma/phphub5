<?php
// 如：db:seed 或者 清空数据库命令的地方调用
function insanity_check()
{
    if (App::environment('production')) {
        exit('别傻了? 这是线上环境呀。');
    }
}

function cdn($filepath)
{
    if (config('app.url_static')) {
        return config('app.url_static') . $filepath;
    } else {
        return config('app.url') . $filepath;
    }
}

function getCdnDomain()
{
    return config('app.url_static') ?: config('app.url');
}

function getUserStaticDomain()
{
    return config('app.user_static') ?: config('app.url');
}

function lang($text)
{
    return str_replace('phphub.', '', trans('phphub.'.$text));
}

function admin_link($title, $path, $id = '')
{
    return '<a href="'.admin_url($path, $id).'" target="_blank">' . $title . '</a>';
}

function admin_url($path, $id = '')
{
    return env('APP_URL') . "/admin/$path" . ($id ? '/'.$id : '');
}

function isAdmin()
{
    if (!\Auth::check()) {
        return false;
    }

    if (\Auth::user()->may('manage_users') || \Auth::user()->may('manage_topics')) {
        return true;
    }

    return false;
}