<?php

class Freenom extends Controller
{
    public $name = 'cards';

    public function index($e)
    {
      echo '
///////////////////////////////////////////////////////////////////////////////|
//                                           __________  __   __   __    __   ||
//  Cards.php                              / _________/ | |  / /  /  |  /  |  ||
//                                        / /_______    | | / /  /   | /   |  ||
//                                        \______   \   | |/ /  / /| |/ /| |  ||
//  Created: 2015/10/29 12:30:05         ________/  /   |   /  / / |   / | |  ||
//  Updated: 2015/10/29 21:45:22        /__________/    /  /  /_/  |__/  |_|  ||
//                                      ScrapYoMama    /__/    by barney.im   ||
//____________________________________________________________________________||
//-----------------------------------------------------------------------------*
    ';
    }

    public function createdom($e)
    {
        $json = json_decode(shell_exec('curl -X POST https://api.freenom.com/v2/domain/register -d "forward_url='.$e[0].'"'),true);
        $this->loadModel('Freenoms');
        $this->Freenoms->addDom($json['domain'][0]['domainname']);
        //print_r($json);
    }

    public function selectdom()
    {
      $this->loadModel('Freenoms');
      $dom = $this->Freenoms->findOneDom();
    //  $dom = "RWADW.TK";
      $c = shell_exec("curl http://".$dom." --verbose 2>&1");
      $findme   = 'curl: (';
      $pos = strpos($c, $findme);
      if ($pos === false) {
        return($dom);
      } else {
        return("error");
      }
    }
}