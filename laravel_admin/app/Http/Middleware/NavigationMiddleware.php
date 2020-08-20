<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Closure;

class NavigationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permissions = [];

        if (Auth::check()) {
            $keyName = "user-permissions-" . Auth::id();
            if (Cache::has($keyName)) {
                $userPermissions = Cache::get($keyName);
            } else {
                $userPermissions = Auth::user()->role->permissions->pluck('name')->toArray();
                Cache::put($keyName, $userPermissions, 120);
            }
            $permissions = array_merge($permissions, $userPermissions);
        }

        if(Cache::has('navigation')) {
            $navigation = Cache::get('navigation');
        } else {
            $navigation = config('navigation');
            //cms dynamic menu starts
            Cache::put('navigation', $navigation, 120);
        }

        foreach($navigation as $menuName => $menuConfig) {
            \Menu::make($menuName . "Navigation", function($menu) use ($menuConfig) {
                $this->generateMenuRecursive($menu, $menuConfig);
            })->filter(function($item) use ($permissions) {
                // Filter out links on which current user don't have permission.
                if($item->data('permission') != null) {
                    if(in_array($item->data('permission'), $permissions)) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return true;
            });
        }
        return $next($request);
    }

    protected function generateMenuRecursive($menuItem, $config, $isRoot = true) {
        if(is_array($config) && count($config) > 0) {
            foreach($config as $itemConfig) {
                if(isset($itemConfig['options'])) {
                    // Create Menu link
                    $itemConfig['title'] = '<span class="nav-label">'.trans($itemConfig['title'])."</span>";

                    $item = $menuItem->add($itemConfig['title'],
                        $itemConfig['options']);

                    if(array_key_exists("url", $itemConfig['options'])) {
                        $item->active(str_replace('@', '\\@',rtrim($itemConfig['options']['url'], "/")) .'/*');
                    }
                    // Set link attributes
                    if(isset($itemConfig['attributes'])
                        && !empty($itemConfig['attributes'])) {
                        $item->attr($itemConfig['attributes']);
                    }

                    // Set menu icon if assigned
                    if(isset($itemConfig['icon'])) {
                        $item->prepend('<i class="'.$itemConfig['icon'].'"></i> ');
                    }

                    if(isset($itemConfig['restrict_sponsors'])) {
                        $item->data('restrict_sponsors',$itemConfig['restrict_sponsors']);
                    }

                    // Set menu permission
                    if(isset($itemConfig['permission'])) {
                        $item->data('permission',$itemConfig['permission']);
                    }

                    // Create child links, if childrens exsists
                    if(isset($itemConfig['childrens'])
                        && !empty($itemConfig['childrens'])) {
                        if($this->hasVisibleChildren($itemConfig['childrens'])) {
                            $item->data('openable',true);
                            $item->data('class','dropdown');
                        } else {
                            $item->data('openable',false);
                            $item->data('class','dropdown');
                        }

                        $this->generateMenuRecursive($item, $itemConfig['childrens'], false);
                    }
                }
            }
        }
    }

    protected function hasVisibleChildren($config) {
        foreach($config as $itemConfig) {
            if(isset($itemConfig['options']) && (!isset($itemConfig['visible']) || $itemConfig['visible'])) {
                return true;
            }
        }
    }
}
