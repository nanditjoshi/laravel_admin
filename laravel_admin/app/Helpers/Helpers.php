<?php
/**
 * Created by PhpStorm.
 * User: Jiten Patel
 * Date: 4/12/2019
 * Time: 6:10 PM
 */

namespace App\Helpers;

use App\Models\Company;
use App\Models\Role;
use Illuminate\Support\Facades\URL;

class Helpers {
    public static function getRoleList() {
        return Role::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function getCompanyList() {
        return Company::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function getGeneralActions($query, $module){
        $strHtml = '';
        foreach (self::getActions() as $action => $class) {
            if($action == 'edit') {
                $btnClass = 'btn-info';
                $href = URL::to('admin/'.$module.'/' . $query->id . '/edit');
                $strHtml .= '<a href="'.$href.'" class="btn grid-action '.$btnClass.' action-'.$action.'" title="'.$action.'"><i class="fa '.$class.'"></i></a>';
            } elseif ($action == 'delete') {
                $btnClass = 'btn-danger';
                $href = URL::to('admin/'.$module.'/' . $query->id);
                $strHtml .= '<a href="#" data-action-url="'.$href.'" class="btn grid-action '.$btnClass.' action-'.$action.'" title="'.$action.'"><i class="fa '.$class.'"></i></a>';
            }
        }
        return $strHtml;
    }

    public static function getActions(){
        return [
            'edit' => 'fa-pencil',
            /*'show' => 'fa-eye',*/
            'delete' => 'fa-trash'
        ];
    }
}