<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\Page;
use App\Models\Subcategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        if (Schema::hasTable('company_infos')) {
            $company = CompanyInfo::find(1);
            view()->share('company', $company);

        };
        $categories = Category::where('status', 1)->where('on_front',0)->with('subcategories')->get();
        view()->share('categories', $categories);

        $frontCategories = Category::where('status', 1)->where('on_front',1)->get();
        view()->share('frontCategories', $frontCategories);

        $frontSubcategories = Subcategory::with('category')->where('status', 1)->where('on_front',1)->get();
        view()->share('frontSubcategories', $frontSubcategories);

        $pages = Page::where('status', 1)->select(['id', 'title', 'slug'])->get();
        view()->share('pages', $pages);
        Paginator::useBootstrap();
    }
}
