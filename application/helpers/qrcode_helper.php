<?php


function generate_qrcode($text)
{
  $CI = &get_instance();
  $CI->load->library('ciqrcode');

  $params['data'] = $text;
  $params['level'] = 'H';
  $params['size'] = 10;
  $params['savename'] = FCPATH . 'assets/images/qrcode/' . $text . '.png';

  $CI->ciqrcode->generate($params);

  return base_url('assets/images/qrcode/') . $text . '.png';
}
