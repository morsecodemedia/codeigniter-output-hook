
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Display_Override {
  private $CI;

  public function __construct() {
    $this->CI =& get_instance();
  }


  public function displayOverrideRender() {
    $CI =& get_instance();
    $text = $this->CI->output->get_output();
    $this->CI->output->set_output($this->render($text));
    $this->CI->output->_display();
  }

  private function render($text) {
    $pos = strpos($text , "%%");
    if ($pos !== FALSE) {
      $endpos = strpos($text, "%%", ($pos + 2));
      $length = $endpos - $pos - 2;
      $match = substr($text, $pos + 2, $length);
      $newval = $this->CI->config->item($match);
      $newstr = substr_replace($text, $newval, $pos, ($length+4));
      return $this->render($newstr);
    } else {
      return $text;
    }
  }
}

?>
