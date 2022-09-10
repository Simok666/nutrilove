<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menus = [
            "Dashboard" => [
                "url"   => "/admin/dashboard",
                "icon"   => "home"
            ],
            /* "Admin"     => [
                "url"   => "/admin/admin",
                "icon"  => "users"
            ], */
            "User"      => [
                "url"   => "/admin/users",
                "icon"  => "user"
            ],
            "Content"   => [
                "url"   => "/admin/content",
                "icon"  => "file"
            ],
            "Faq"   => [
                "url"   => "/admin/faq",
                "icon"  => "file"
            ],
            "Article"   => [
                "url"   => "#",
                "icon"  => "file",
                "childs"=> [
                    "Article"      => [
                        "url"   => "/admin/article",
                    ],
                    "Kategori"      => [
                        "url"   => "/admin/article/kategori",
                    ],
                ]
            ],
            "Gizi"      => [
                "url"   => "#",
                "icon"  => "droplet",
                "childs"=> [
                    "Riwayat Gizi"      => [
                        "url"   => "/admin/gizi",
                    ],
                    "Setting"      => [
                        "url"   => "/admin/setting/gizi",
                    ],
                ]
            ],
            "Setting"   => [
                "url"   => "#",
                "icon"  => "settings",
                "childs"=> [
                    "General" => [
                        "url"   => "/admin/setting/general"
                    ],
                    "Landing Page" => [
                        "url"   => "/admin/setting/landingpage"
                    ]
                ]
            ],
        ];
        return view('components.admin.navbar', ["menu" => $menus] );
    }
}
