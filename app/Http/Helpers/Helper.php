<?php

use App\Http\Helpers\UserPermissionHelper;
use App\Models\Language;
use App\Models\Page;
use App\Models\PaymentGateway;
use App\Models\User;
use App\Models\User\PaymentGateway as UserPaymentGateway;
use App\Models\User\Product;
use App\Models\User\ProductInformation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue(array $values): bool
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }
}


if (!function_exists('replaceBaseUrl')) {
    function replaceBaseUrl($html)
    {
        $startDelimiter = 'src="';
        $endDelimiter = '/assets/front/img/summernote';
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($html, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($html, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $html = substr_replace($html, url('/'), $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }
        return $html;
    }
}


if (!function_exists('convertUtf8')) {
    function convertUtf8($value)
    {
        return mb_detect_encoding($value, mb_detect_order(), true) === 'UTF-8' ? $value : mb_convert_encoding($value, 'UTF-8');
    }
}


if (!function_exists('make_slug')) {
    function make_slug($string): array|string|null
    {
        $slug = preg_replace('/\s+/u', '-', trim($string));
        $slug = str_replace("/", "", $slug);
        return str_replace("?", "", $slug);
    }
}


if (!function_exists('make_input_name')) {
    function make_input_name($string): array|string|null
    {
        return preg_replace('/\s+/u', '_', trim($string));
    }
}

if (!function_exists('hasCategory')) {
    function hasCategory($version): bool
    {
        if (str_contains($version, "no_category")) {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('isDark')) {
    function isDark($version): bool
    {
        if (str_contains($version, "dark")) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('slug_create')) {
    function slug_create($val): array|string|null
    {
        $slug = preg_replace('/\s+/u', '-', trim($val));
        $slug = str_replace("/", "", $slug);
        return str_replace("?", "", $slug);
    }
}

if (!function_exists('hex2rgb')) {
    function hex2rgb($colour): bool|array
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('red' => $r, 'green' => $g, 'blue' => $b);
    }
}


if (!function_exists('format_price')) {
    function format_price($value): string
    {
        return $value;
    }
}

if (!function_exists('upload_picture')) {
    function upload_picture($directory, $img): string
    {
        $directory = public_path($directory);
        $file_name = time();
        $file_name .= rand();
        $file_name = sha1($file_name);
        if (!file_exists($directory)) mkdir($directory, 0777, true);
        $ext = $img->getClientOriginalExtension();
        $newFileName = $file_name . "." . $ext;
        $img->move($directory, $newFileName);
        return $newFileName;
    }
}

if (!function_exists('update_picture')) {
    function update_picture($directory, $img, $old_img): string
    {
        $directory = public_path($directory);
        $file_name = sha1(time() . rand());
        if (!file_exists($directory)) mkdir($directory, 0777, true);
        $ext = $img->getClientOriginalExtension();
        $newFileName = $file_name . "." . $ext;
        $oldImgPath = $directory . '/' . $old_img;
        if (file_exists($oldImgPath)) @unlink($oldImgPath);
        $img->move($directory, $newFileName);
        return $newFileName;
    }
}
if (!function_exists('deleteFile')) {
    function deleteFile($path, $file): bool
    {
        if (!$file) return false;
        $oldImgPath = $path . '/' . $file;
        if (file_exists($oldImgPath)) @unlink($oldImgPath);
        return true;
    }
}
