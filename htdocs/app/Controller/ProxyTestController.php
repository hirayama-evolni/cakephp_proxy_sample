<?php

App::uses('HttpSocket', 'Network/Http');
App::uses('HttpSocket2', 'Network/Http');

class ProxyTestController extends AppController {

    public function index()
    {
    }

    protected function access($http)
    {
        $url = 'https://www.google.com/';

        // via squid
        $http->configProxy('localhost', 3128);

        try{
            $res = $http->get($url);
        }catch(SocketException $e){
            $res = $e->getMessage();
        }

        return $res;
    }

    public function original()
    {
        $http = new HttpSocket();

        $res = $this->access($http);

        $this->set('res', $res);

        $this->render('proxy_test');
    }


    public function modified()
    {
        $http = new HttpSocket2();

        $res = $this->access($http);

        $this->set('res', $res);

        $this->render('proxy_test');
    }
}
