<?php

namespace Addons\Cms\Controller;
use Home\Controller\AddonsController;

class CmsController extends AddonsController{
    public function getList()
    {
//        sleep(10);
        $limit = I('limit', 5, 'intval');
        $lastid = I('lastid', 0, 'intval');
        if ($lastid) {
            $map['id'] = array('lt', $lastid);
        }
        $list = M('cms')->where($map)->order('id desc')->field('id,title,img,cTime')->limit($limit)->select();
        foreach ($list as &$val) {
            $val['img'] = get_cover_url($val['img']);
            $val['cTime'] = time_format($val['cTime']);
        }
        return $this->ajaxReturn($list);
    }

    public function getDetail()
    {
        $map['id'] = I('id', 0, 'intval');
        $info = M('cms')->where($map)->find();
        $info['img'] = get_cover_url($info['img']);
        $info['cTime'] = time_format($info['cTime']);
        return $this->ajaxReturn($info);
    }
}
