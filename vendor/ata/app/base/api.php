<?php

namespace PolylangRestapiHelper\ATA;

class Api  extends Core
{
  protected $data = [];
  protected function __construct()
  {
    parent::__construct();
  }

  protected function response($code = 200)
  {
    return new \WP_REST_Response($this->data, $code);
  }
}
