<?php
  function view($view_name, $model=array())
  {
    if (strpos($view_name, '.') !== false)
      return view('error', array('message' => 'Invalid view name'));
    require 'templates/'.$view_name.'.php';
    exit(0);
  }
?>
