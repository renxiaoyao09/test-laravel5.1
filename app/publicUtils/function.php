<?php

// function_exists检测函数是否存在
  if (!function_exists('love')) {
    function love()
    {
      echo 'wow';
    }
  }
  

  /**
 * 数组 转 对象
 *
 * @param array $arr 数组
 * @return object
 */
function array_to_object($arr) {
  if (gettype($arr) != 'array') {
      return;
  }
  foreach ($arr as $k => $v) {
      if (gettype($v) == 'array' || getType($v) == 'object') {
          $arr[$k] = (object)array_to_object($v);
      }
  }

  return (object)$arr;
}

/**
* 对象 转 数组
*
* @param object $obj 对象
* @return array
*/
function object_to_array($obj) {
  $obj = (array)$obj;
  foreach ($obj as $k => $v) {
      if (gettype($v) == 'resource') {
          return;
      }
      if (gettype($v) == 'object' || gettype($v) == 'array') {
          $obj[$k] = (array)object_to_array($v);
      }
  }

  return $obj;
}







  function merge_obj(){
    foreach (func_get_args() as $a) {
      # code...
    }
  }