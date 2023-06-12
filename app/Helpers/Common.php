<?php

use Carbon\Carbon;
use App\Core\Support\PageTitle;
use App\Facades\PageTitleFacade;
use Illuminate\Support\Collection;

if (!function_exists('page_title')) {
    /**
     * @return PageTitle
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}
if (!function_exists('get_admin_email')) {
    /**
     * get admin email(s)
     *
     * @return Collection
     */
    function get_admin_email() : Collection
    {
        $email = setting('admin_email');

        if (!$email) {
            return collect([]);
        }

        $email = is_array($email) ? $email : (array)json_decode($email, true);

        return collect(array_filter($email));
    }
}

if (!function_exists('human_file_size')) {
    /**
     * @param $bytes
     * @param int $precision
     * @return string
     * @author Sang Nguyen
     */
    function human_file_size($bytes, $precision = 2)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return number_format($bytes, $precision, ',', '.') . ' ' . $units[$pow];
    }
}
if (!function_exists('format_time')) {
    /**
     * @param Carbon $timestamp
     * @param $format
     * @return mixed
     * @author Sang Nguyen
     */
    function format_time(Carbon $timestamp, $format = 'j M Y H:i')
    {
        $first = Carbon::create(0000, 0, 0, 00, 00, 00);
        if ($timestamp->lte($first)) {
            return '';
        }

        return $timestamp->format($format);
    }
}
if (!function_exists('is_image')) {
    /**
     * Is the mime type an image
     *
     * @param $mimeType
     * @return bool
     * @author Sang Nguyen
     */
    function is_image($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}
if (!function_exists('getClassBody')) {
    function getClassBody()
    {
        $class = '';
        $routeName = request()->route()->getName();
        if ($routeName == 'home.index') {
            $class .= 'homepage';
        } else if ($routeName == 'page.contestants') {
            $class .= 'pape-contestants';
        } else {
            $class .= 'PageInSide';
        }
        return $class;
    }
}

if (!function_exists('scan_folder')) {
    function scan_folder($path, $ignore_files = [])
    {
        try {
            if (is_dir($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                natsort($data);
                return $data;
            }
            return [];
        } catch (Exception $ex) {
            return [];
        }
    }
}

if (!function_exists('cut_string')) {
    function cut_string($string, $length, $string_end = '...')
    {
        if (strlen($string) <= $length) {
            return $string;
        } else {
            if (strpos($string, " ", $length) > $length) {
                $newLenght = strpos($string, " ", $length);
                $new_string = substr($string, 0, $newLenght) . $string_end;
                return $new_string;
            }
            $new_string = substr($string, 0, $length) . $string_end;
            return $new_string;
        }
    }
}

if (!function_exists('date_from_database')) {
    function date_from_database($time, $format = 'Y-m-d')
    {
        if (empty($time)) {
            return $time;
        }
        return format_time(Carbon::parse($time), $format);
    }
}


if (!function_exists('get_image_url')) {
    /**
     * @param $url
     * @param $size
     * @param bool $relative_path
     * @param null $default
     * @return mixed
     * @author Sang Nguyen
     */
    function get_image_url($url, $size = null, $relative_path = false, $default = null)
    {
        if (empty($url)) {
            return $default;
        }

        if (array_key_exists($size, config('media.sizes'))) {
            $url = str_replace(File::name($url) . '.' . File::extension($url), File::name($url) . '-' . config('media.sizes.' . $size) . '.' . File::extension($url), $url);
        }

        if ($relative_path) {
            return $url;
        }

        if ($url == '__image__') {
            return url($default);
        }

        return url($url);
    }
}

if (!function_exists('get_object_image')) {
    /**
     * @param $image
     * @param null $size
     * @param bool $relative_path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function get_object_image($image, $size = null, $relative_path = false)
    {
        if (!empty($image)) {
            if (empty($size) || $image == '__value__') {
                if ($relative_path) {
                    return $image;
                }
                return url($image);
            }
            return get_image_url($image, $size, $relative_path);
        }

        return get_image_url(config('media.default-img'), null, $relative_path);
    }
}

if (!function_exists('get_file_data')) {
    /**
     * @param $file
     * @param $convert_to_array
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_file_data($file, $convert_to_array = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        if (!$convert_to_array) {
            return null;
        }
        return [];
    }
}
if (!function_exists('json_encode_prettify')) {
    /**
     * @param $data
     * @return string
     */
    function json_encode_prettify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
if (!function_exists('save_file_data')) {
    /**
     * @param $path
     * @param $data
     * @param $json
     * @return bool|mixed
     */
    function save_file_data($path, $data, $json = true)
    {
        try {
            if ($json) {
                $data = json_encode_prettify($data);
            }
            if (!File::isDirectory(dirname($path))) {
                File::makeDirectory(dirname($path), 493, true);
            }
            File::put($path, $data);

            return true;
        } catch (Exception $ex) {
            info($ex->getMessage());
            return false;
        }
    }
}


if (!function_exists('get_setting_email_template_content')) {
    /**
     * Get content of email template if module need to config email template
     *
     * @param $template string type of module is system or plugins
     * @param $email_template_key string key is config in config.email.templates.$key
     * @return bool|mixed|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    function get_setting_email_template_content($template, $email_template_key)
    {
        $default_path = base_path('public/emails/' . $template . '/' . $email_template_key . '.tpl');
        $storage_path = get_setting_email_template_path($template, $email_template_key);

        if ($storage_path != null && File::exists($storage_path)) {
            return get_file_data($storage_path, false);
        }

        return File::exists($default_path) ? get_file_data($default_path, false) : '';
    }
}

if (!function_exists('get_setting_email_template_path')) {
    /**
     * Get user email template path in storage file
     *
     * @param $template string
     * @param $email_template_key string key is config in config.email.templates.$key
     * @return string
     */
    function get_setting_email_template_path($template, $email_template_key)
    {
        return storage_path('app/emails/' . $template . '/' . $email_template_key . '.tpl');
    }
}


if (!function_exists('array_reset_index')) {
    /**
     * Reset numeric index of an array recursively.
     *
     * @param array $array
     * @return array|\Illuminate\Support\Collection
     *
     * @see https://stackoverflow.com/a/12399408/5736257
     */
    function array_reset_index($array)
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : $array;

        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = array_reset_index($val);
            }
        }

        if (isset($key) && is_numeric($key)) {
            return array_values($array);
        }

        return $array;
    }
}


if (!function_exists('rating_star_class')) {
    /**
     * Get class for rating star.
     *
     * @param int|float $rating
     * @param int $forStar
     * @return string
     */
    function rating_star_class($rating, $forStar)
    {
        $class = $rating >= $forStar ? 'fa fa-star rated' : 'fa fa-star-o';

        if (fmod($rating, 1) == 0) {
            return $class;
        }

        if (is_float($rating) && ceil($rating) === (float)$forStar) {
            $class = 'fa fa-star-half-o rated';
        }

        return $class;
    }
}
