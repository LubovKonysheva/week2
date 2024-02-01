<?php

class TariffHour extends TariffAbstract {

  protected $pricePerKilometr = 0;
  protected $pricePerMinute = 200/60;

  public function __construct(int $distance, int $minutes) {

    parent::__construct($distance, $minutes);
      $rest = $this->minutes % 60;
      $this->minutes = $this->minutes - $rest + 60;
  }

}