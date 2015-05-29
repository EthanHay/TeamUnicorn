<?PHP
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function better_crypt($input, $rounds = 7)
  {
    $salt = "";
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 22; $i++) {
      $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
  }
?>