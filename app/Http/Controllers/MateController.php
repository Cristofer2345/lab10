<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateController extends Controller
{
 public function suma(int $num1,  $num2){
  return   $num1 + $num2;
 }
 public function multiplicacion(int $num1,  $num2){
    return   $num1 * $num2;
   }
}
