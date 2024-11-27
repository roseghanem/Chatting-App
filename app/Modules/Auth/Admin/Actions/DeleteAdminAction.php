<?php


namespace App\Modules\Auth\Admin\Actions;


use App\Modules\Auth\Admin\Models\Admin;

class DeleteAdminAction
{
  public static function execute(Admin $admin)
  {
    $admin->delete();
  }

}
