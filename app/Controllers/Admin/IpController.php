<?php

namespace App\Controllers\Admin;

use App\Models\Ip;
use App\Models\LoginIp;
use App\Models\BlockIp;
use App\Models\UnblockIp;
use App\Controllers\AdminController;
use App\Utils\QQWry;

class IpController extends AdminController
{
    public function index($request, $response, $args){
		$pageNum = 1;
        if (isset($request->getQueryParams()["page"])) {
            $pageNum = $request->getQueryParams()["page"];
        }
        $logs = Ip::orderBy('id', 'desc')->where("datetime",">",time()-60)->paginate(15, ['*'], 'page', $pageNum);
		$loc=array();
		
		$iplocation = new QQWry(); 
		foreach($logs as $log)
		{
			if(!isset($loc[$log->ip]))
			{
				$location=$iplocation->getlocation($log->ip);
				$loc[$log->ip]=iconv('gbk', 'utf-8//IGNORE', $location['country'].$location['area']);
			}
		}
		
		
		$logs->setPath('/admin/alive');
        return $this->view()->assign("loc",$loc)->assign('logs',$logs)->display('admin/ip/alive.tpl');
    }
	
    public function index1($request, $response, $args){
		$pageNum = 1;
        if (isset($request->getQueryParams()["page"])) {
            $pageNum = $request->getQueryParams()["page"];
        }
        $logs = LoginIp::orderBy('id', 'desc')->paginate(15, ['*'], 'page', $pageNum);
		$loc=array();
		
		$iplocation = new QQWry(); 
		foreach($logs as $log)
		{
			if(!isset($loc[$log->ip]))
			{
				$location=$iplocation->getlocation($log->ip);
				$loc[$log->ip]=iconv('gbk', 'utf-8//IGNORE', $location['country'].$location['area']);
			}
		}
		
		
		$logs->setPath('/admin/login');
        return $this->view()->assign("loc",$loc)->assign('logs',$logs)->display('admin/ip/login.tpl');
    }
	
	public function block($request, $response, $args){
		$pageNum = 1;
        if (isset($request->getQueryParams()["page"])) {
            $pageNum = $request->getQueryParams()["page"];
        }
        $logs = BlockIp::orderBy('id', 'desc')->paginate(15, ['*'], 'page', $pageNum);
		$loc=array();
		
		$iplocation = new QQWry(); 
		foreach($logs as $log)
		{
			if(!isset($loc[$log->ip]))
			{
				$location=$iplocation->getlocation($log->ip);
				$loc[$log->ip]=iconv('gbk', 'utf-8//IGNORE', $location['country'].$location['area']);
			}
		}
		
		
		$logs->setPath('/admin/block');
        return $this->view()->assign("loc",$loc)->assign('logs',$logs)->display('admin/ip/block.tpl');
    }
	
	public function unblock($request, $response, $args){
		$pageNum = 1;
        if (isset($request->getQueryParams()["page"])) {
            $pageNum = $request->getQueryParams()["page"];
        }
        $logs = UnblockIp::orderBy('id', 'desc')->paginate(15, ['*'], 'page', $pageNum);
		$loc=array();
		
		$iplocation = new QQWry(); 
		foreach($logs as $log)
		{
			if(!isset($loc[$log->ip]))
			{
				$location=$iplocation->getlocation($log->ip);
				$loc[$log->ip]=iconv('gbk', 'utf-8//IGNORE', $location['country'].$location['area']);
			}
		}
		
		
		$logs->setPath('/admin/unblock');
        return $this->view()->assign("loc",$loc)->assign('logs',$logs)->display('admin/ip/unblock.tpl');
    }

}