<?php
require_once "YahooFin.php";

YahooFin::intraday(['yhoo']);
YahooFin::future(['yhoo']);
YahooFin::fund(['yhoo']);  //fundamentals