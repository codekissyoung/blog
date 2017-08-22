```
./main/user.php:82:    protected $_scenic2loction_tbname = '';
./main/user.php:173:        $this->_scenic2loction_tbname = $conf['mysql']['scenic2location_table_name'];
./main/user.php:1667:        $row = $this->_mysql->select($uid, [], ['sid' => $uid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:39:        $this->_scenic2loction_tbname = $userConf['mysql']['scenic2location_table_name'];
./admin/admin.php:406:        $row = $this->_mysql->select($sid, [], ['sid' => $sid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:420:                ], [], $this->_scenic2loction_tbname
./admin/admin.php:485:        $row = $this->_mysql->select($sid, [], ['sid' => $sid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:498:                ), [], $this->_scenic2loction_tbname
./admin/admin.php:501:            $this->_mysql->update($sid, $location_info, array('sid'=>$sid), [], $this->_scenic2loction_tbname);
```

# main/static.php
```php
<?php
public function set_scenic_struct($sid, $parent_id, $name)
{   
    $ret = $this->_mysql->select(0, array('sid', 'pid'), array('sid'=>$sid),
        array(), 0, 1, array(), "qy_scenic_struct");
    if ($ret === false) {
        return CommonConst::RET_CODE_SYS_FAILED;
    }   
    if (empty($ret)) {
        $ret = $this->_mysql->insert(0, array('sid'=>$sid,
            'pid'=>$parent_id, 'name'=>$name), NULL, "qy_scenic_struct");
        if (!$ret || empty($ret)) {
            log_err("insert scenic struct failed, sid:".$sid, __FILE__, __LINE__);
            return CommonConst::RET_CODE_SYS_FAILED;
        }   
    } else {
        $ret = $this->_mysql->update(0, array('pid'=>$parent_id, 'name'=>$name), array('sid'=>$sid),
            array(), "qy_scenic_struct");
        if (!$ret || empty($ret)) {
            log_err("update scenic struct failed, sid:".$sid, __FILE__, __LINE__);
            return CommonConst::RET_CODE_SYS_FAILED;
        }   
    }   
    return CommonConst::RET_CODE_OK;
}   

public function get_scenic_parent_id($sid, &$parent_id)
{   
    $ret = $this->_mysql->select(0, array('pid'), array('sid'=>$sid),
        array(), 0, 1, array(), "qy_scenic_struct");
    if ($ret === false) {
        return CommonConst::RET_CODE_SYS_FAILED;
    }   
    if (empty($ret)) {
        return CommonConst::RET_CODE_USER_NOT_EXIST;
    }   
    $parent_id = $ret[0]->pid;
    return CommonConst::RET_CODE_OK;
}   
```

# admin/admin.php
```php
<?php
public function admin_add_scenic($name, $english_name, $raw_img, $parent_id,
    $scenecover, $scenestd, $scenethumb, $latitude, $longitude, $ne_lat, $ne_long, $sw_lat, $sw_long, $homeabroad, &$sid)
{   
    $scenic_info = array('name'=>$name, 'english_name'=>$english_name,
        'raw_img'=>$raw_img, 'scenecover'=>$scenecover,
        'scenestd'=>$scenestd, 'scenethumb'=>$scenethumb);
    $ret = $this->_user->add_scenic($scenic_info, $sid);
    if ($ret !== CommonConst::RET_CODE_OK) {
        return $ret;
    }   
    $ret = $this->_static_data->set_scenic_struct($sid, $parent_id, $scenic_info['name']);
    $this->add_scenic2location($sid, $name, $latitude, $longitude, $ne_lat, $ne_long, $sw_lat, $sw_long, $homeabroad);
    return CommonConst::RET_CODE_OK;
}


public function admin_update_scenic($scenic_id, $name, $english_name,
    $raw_img, $parent_id, $scenecover, $scenestd, $scenethumb, $latitude, $longitude, $ne_lat, $ne_long, $sw_lat, $sw_long, $homeabroad)
{
    if ($parent_id != "0" && !$this->_user->is_user_exist($parent_id)) {
        log_err("parent uid is not exist, uid:$parent_id", __FILE__,
            __LINE__);
        return CommonConst::RET_CODE_PARAM_INVALID;
    }
    if ($parent_id === $scenic_id) {
        log_err("scenic_id equal parent_id:$parent_id", __FILE__,
            __LINE__);
        return CommonConst::RET_CODE_PARAM_INVALID;
    }
    $scenic_info = array();
    if (!empty($name)) {
        $scenic_info['name'] = $name;
    }   
    if (!empty($english_name)) {
        $scenic_info['english_name'] = $english_name;
    }   
    if (!empty($raw_img)) {
        $scenic_info['raw_img'] = $raw_img;
    }   
    if (!empty($scenecover)) {
        $scenic_info['scenecover'] = $scenecover;
    }   
    if (!empty($scenestd)) {
        $scenic_info['scenestd'] = $scenestd;
    }   
    if (!empty($scenethumb)) {
        $scenic_info['scenethumb'] = $scenethumb;
    }   
    $ret = $this->_user->update_scenic($scenic_id, $scenic_info);
    if ($ret !== CommonConst::RET_CODE_OK) {
        return $ret;
    }   
    $ret = $this->_static_data->set_scenic_struct($scenic_id,
        $parent_id, $name);
    $location_info['latitude'] = $latitude;
    $location_info['longitude'] = $longitude;
    $location_info['ne_lat'] = $ne_lat;
    $location_info['ne_long'] = $ne_long;
    $location_info['sw_lat'] = $sw_lat;
    $location_info['sw_long'] = $sw_long;
    $location_info['homeabroad'] = $homeabroad;
    $location_info['time'] = date('Y-m-d H:i:s');
    $ret = $this->update_scenic2location($scenic_id, $location_info);
    return CommonConst::RET_CODE_OK;
}

public function admin_get_scenic_detail($scenic_id, &$scenic)
{   
    $parent_id = 0;
    $ret = $this->_static_data->get_scenic_parent_id($scenic_id,
        $parent_id);
    if ($ret !== CommonConst::RET_CODE_OK) {
        return $ret;
    }   
    $ret = $this->_user->get_scenic_detail($scenic_id, $scenic, -1);
    if ($ret !== CommonConst::RET_CODE_OK) {
        return $ret;
    }   
    $scenic->parent_id = $parent_id;
    return CommonConst::RET_CODE_OK;
}   

```


# 查询 scenic_location 表使用到的地方
```
work@10-10-64-214:~/wind/is$ grep -inr "qy_scenic_location" ./|grep -v .svn|grep -v log
./main/conf/is.conf:18:            "scenic2location_table_name" => "qy_scenic_location",
work@10-10-64-214:~/wind/is$ grep -inr "scenic2location_table_name" ./|grep -v .svn|grep -v log
./main/conf/is.conf:18:            "scenic2location_table_name" => "qy_scenic_location",
./main/user.php:173:        $this->_scenic2loction_tbname = $conf['mysql']['scenic2location_table_name'];
./admin/admin.php:39:        $this->_scenic2loction_tbname = $userConf['mysql']['scenic2location_table_name'];
work@10-10-64-214:~/wind/is$ grep -inr "_scenic2location_tname" ./|grep -v .svn|grep -v log
work@10-10-64-214:~/wind/is$ grep -inr "_scenic2loction_tname" ./|grep -v .svn|grep -v log
work@10-10-64-214:~/wind/is$ grep -inr "_scenic2loction_tbname" ./|grep -v .svn|grep -v log
./main/user.php:82:    protected $_scenic2loction_tbname = '';
./main/user.php:173:        $this->_scenic2loction_tbname = $conf['mysql']['scenic2location_table_name'];
./main/user.php:1677:        $row = $this->_mysql->select($uid, [], ['sid' => $uid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:39:        $this->_scenic2loction_tbname = $userConf['mysql']['scenic2location_table_name'];
./admin/admin.php:406:        $row = $this->_mysql->select($sid, [], ['sid' => $sid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:420:                ], [], $this->_scenic2loction_tbname
./admin/admin.php:482:        $row = $this->_mysql->select($sid, [], ['sid' => $sid], null, 0, 1, [], $this->_scenic2loction_tbname);
./admin/admin.php:495:                ), [], $this->_scenic2loction_tbname
./admin/admin.php:498:            $this->_mysql->update($sid, $location_info, array('sid'=>$sid), [], $this->_scenic2loction_tbname);

```
