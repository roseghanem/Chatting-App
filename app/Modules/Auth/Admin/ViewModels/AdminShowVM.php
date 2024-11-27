<?php

namespace App\Modules\Auth\Admin\ViewModels;

use App\Modules\Auth\Admin\Models\Admin;

class AdminShowVM
{

  public static function handle($admin)
  {
    return $admin;
  }

  public static function toArray(Admin $admin)
  {
    return ['admin' => self::handle($admin)];
  }

  public static function toAttr(Admin $admin)
  {
    return self::handle($admin);
  }
}
