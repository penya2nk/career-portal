<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ValidationController extends Controller
{
  public function count_null($email)
  {
    $user = User::where('email', $email)->first();
    $attributes = $user->getattributes();

    $null=0;
    $juml=0;

    foreach ($attributes as $key => $attribute) {
          if ($attribute == NULL && $attribute !==0) {
            $null++;
            $notif[]= "Kolom $key belum diisi";
            $juml++;
          }
          else {
            $juml++;
          }
        }


        $result = round(($juml-$null)/$juml * 100);

        $data = array(
          'null_count' => $null,
          'juml' => $juml,
          'fill_percent' =>$result ,
          'notification' =>$notif,
         );

    return $data;

  }
}
