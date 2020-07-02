<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('selectProvince','partials.admin.form.selectProvince',['name','value'=>null,'atb'=>['class'=>'form-control']]);
        Form::component('selectCity','partials.admin.form.selectCity',['name','value'=>null,'atb'=>['class'=>'form-control']]);
        //
        Form::component('selectMinitry','partials.admin.form.selectMinitry',['name','value'=>null,'atb'=>[]]);
        Form::component('selectMinitryProvince','partials.admin.form.selectMinitryProvince',['name','value'=>null,'atb'=>[]]);

        Form::component('selectSubMinitry','partials.admin.form.selectSubMinitry',['name','value'=>null,'atb'=>[]]);
        //
        Form::component('textareaTiny','partials.admin.form.textarea_tiny',['name','value'=>null,'atb'=>[]]);
        Form::component('uploadImage','partials.admin.form.upload_image',['name','value'=>null,'atb'=>[]]);        
        Form::component('uploadPdf','partials.admin.form.upload_pdf',['name','value'=>[],'atb'=>[]]);        
        Form::component('uploadPdfMulti','partials.admin.form.upload_pdf_multi',['name','value'=>[],'atb'=>[]]);        
        //
        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }
}
