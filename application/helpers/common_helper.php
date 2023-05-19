<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

if (! function_exists('get_settings')) {
  function get_settings($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();

    $CI->db->where('type', $type);
    $result = $CI->db->get('settings')->row('description');
    return $result;
  }
}

if (! function_exists('get_frontend_settings')) {
  function get_frontend_settings($type = '') {
    $CI	=&	get_instance();
    $CI->load->database();

    $CI->db->where('type', $type);
    $result = $CI->db->get('frontend_settings')->row('description');
    return $result;
  }
}

if ( ! function_exists('slugify'))
{
  function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
            return 'n-a';
        return $text;
    }
}

if ( ! function_exists('get_video_extension'))
{
    // Checks if a video is youtube, vimeo or any other
    function get_video_extension($url) {
        if (strpos($url, '.mp4') > 0) {
            return 'mp4';
        } elseif (strpos($url, '.webm') > 0) {
            return 'webm';
        } else {
            return 'unknown';
        }
    }
}

// Currency helpers
if (! function_exists('currency')) {
  function currency($price = "") {
    $CI	=&	get_instance();
    $CI->load->database();
		if ($price != "") {
			$CI->db->where('type', 'system_currency');
			$currency_code = $CI->db->get('settings')->row()->description;

			$CI->db->where('code', $currency_code);
			$symbol = $CI->db->get('currency')->row()->symbol;

			$CI->db->where('type', 'currency_position');
			$position = $CI->db->get('settings')->row()->description;

			if ($position == 'right') {
				return $price.$symbol;
			}elseif ($position == 'right-space') {
				return $price.' '.$symbol;
			}elseif ($position == 'left') {
				return $symbol.$price;
			}elseif ($position == 'left-space') {
				return $symbol.' '.$price;
			}
		}
  }
}
if (! function_exists('currency_code_and_symbol')) {
  function currency_code_and_symbol($type = "") {
    $CI	=&	get_instance();
    $CI->load->database();
		$CI->db->where('type', 'system_currency');
		$currency_code = $CI->db->get('settings')->row()->description;

		$CI->db->where('code', $currency_code);
		$symbol = $CI->db->get('currency')->row()->symbol;
		if ($type == "") {
			return $symbol;
		}else {
			return $currency_code;
		}

  }
}

// Sanitize input fields
if (! function_exists('sanitizer')) {
  function sanitizer($string = "") {
    //$sanitized_string = preg_replace("/[^@ -.a-zA-Z0-9]+/", "", html_escape($string));
    $sanitized_string = html_escape($string);
    return $sanitized_string;
  }
}

// Get the businsess name
if (! function_exists('getBusinessTypeName')) {
  function getBusinessTypeName($type_id) {
     if ($type_id == 1) {
       return "Product Oriented";
    }elseif ($type_id == 2) {
        return "Service Oriented";
    }elseif ($type_id == 3) {
        return "Product & Service Oriented";
    }
  }
}


// Get the businsess group
if (! function_exists('getBusinessGroup')) {
  function getBusinessGroup($id) {
     if ($id == 1) {
       return "Sole trading Concern";
    }elseif ($id == 2) {
        return "Partnership firm";
    }elseif ($id == 3) {
        return "Joint stock company";
    }
    elseif ($id == 4) {
        return "Corporation";
    }
    elseif ($id == 5) {
        return "Multi National company";
    }
    elseif ($id == 6) {
        return "Franchise";
    }
    elseif ($id == 7) {
        return "NGO/INGO";
    }
    elseif ($id == 8) {
        return "Others";
    }
  }
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/common.php */
