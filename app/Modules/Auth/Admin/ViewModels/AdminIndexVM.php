<?php

namespace App\Modules\Auth\Admin\ViewModels;

use App\Modules\Auth\Admin\Models\Admin;

class AdminIndexVM
{

  public static function handle()
  {
    $admins = Admin::all();
    $arr = [];
    foreach ($admins as $admin) {
      $adminVM = new AdminShowVM();
      array_push($arr, $adminVM->toAttr($admin));
    }
    return $arr;
  }

  public static function toArray()
  {
    return ['admins' => self::handle()];
  }
}
