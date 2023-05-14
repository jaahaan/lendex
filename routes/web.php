<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TechoficSettingsController;

use App\Http\Controllers\TechoficUserRoleController;

use App\Http\Controllers\ThemeSettingController;

use App\Http\Controllers\StatusController;

use App\Http\Controllers\TechoficAdminController;

use App\Http\Controllers\RouterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpecialSkillsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\StatisticsCountController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\TrustedCompanyController;


Route::middleware([CheckCustomAuth::class])->group(function () {
    Route::get('/app/getUser',  [HomeController::class, 'getUser']);
    Route::post('/app/updateInfo',  [HomeController::class, 'updateInfo']);

    //Attachment
    Route::post('/upload_attachment', [HomeController::class, 'uploadAttachment']);
    Route::post('/delete_attachment', [HomeController::class, 'deleteAttachment']);
    //image
    Route::post('/app/delete_image', [HomeController::class, 'deleteImage']);
    Route::post('/app/upload', [HomeController::class, 'upload']);

    //AboutMe 
    Route::get('/app/get_education',[AboutMeController::class,'getEducation']);
    Route::get('/app/get_experience',[AboutMeController::class,'getExperience']);
    Route::post('/app/add_aboutme',[AboutMeController::class,'addAboutMe']);
    Route::put('/app/update_aboutme',[AboutMeController::class,'updateAboutMe']);
    Route::delete('/app/delete_aboutme',[AboutMeController::class,'deleteAboutMe']);
    Route::get('/app/get_aboutme/{id}',[AboutMeController::class,'getAboutMeDetail']);

    //Testimonial 
    Route::get('/app/get_testimonial',[TestimonialController::class,'getTestimonial']);
    Route::post('/app/add_testimonial',[TestimonialController::class,'addTestimonial']);
    Route::put('/app/update_testimonial',[TestimonialController::class,'updateTestimonial']);
    Route::delete('/app/delete_testimonial',[TestimonialController::class,'deleteTestimonial']);
    Route::get('/app/get_testimonial/{id}',[TestimonialController::class,'getTestimonialDetail']);

    //StatisticsCount 
    Route::get('/app/get_StatisticsCount',[StatisticsCountController::class,'getStatisticsCount']);
    Route::post('/app/add_StatisticsCount',[StatisticsCountController::class,'addStatisticsCount']);
    Route::put('/app/update_StatisticsCount',[StatisticsCountController::class,'updateStatisticsCount']);
    Route::delete('/app/delete_StatisticsCount',[StatisticsCountController::class,'deleteStatisticsCount']);
    Route::get('/app/get_StatisticsCount/{id}',[StatisticsCountController::class,'getStatisticsCountDetail']);

    //Project
    Route::get('/app/get_project',[ProjectController::class,'getProject']);
    Route::post('/app/add_project',[ProjectController::class,'addProject']);
    Route::put('/app/update_project',[ProjectController::class,'updateProject']);
    Route::delete('/app/delete_project',[ProjectController::class,'deleteProject']);
    Route::get('/app/get_project/{id}',[ProjectController::class,'getProjectDetail']);

    //Special Skills
    Route::get('/app/get_skills',[SpecialSkillsController::class,'getSkills']);
    Route::post('/app/add_skill',[SpecialSkillsController::class,'addSkill']);
    Route::put('/app/update_skill',[SpecialSkillsController::class,'updateSkill']);
    Route::delete('/app/delete_skill',[SpecialSkillsController::class,'deleteSkill']);
    Route::get('/app/get_skill/{id}',[SpecialSkillsController::class,'getSkillDetail']);
    Route::put('/app/resetSkillPosition', [SpecialSkillsController::class, 'resetSkillPosition']);

    //Service 
    Route::get('/app/get_service_title',[ServiceController::class,'getServiceTitle']);
    Route::post('/app/add_service_title',[ServiceController::class,'addServiceTitle']);
    Route::put('/app/update_service_title',[ServiceController::class,'updateServiceTitle']);
    Route::delete('/app/delete_service_title',[ServiceController::class,'deleteServiceTitle']);
    Route::get('/app/get_service_title/{id}',[ServiceController::class,'getServiceTitleDetail']);
    Route::put('/app/resetServiceTitlePosition', [ServiceController::class, 'resetServiceTitlePosition']);

     //Service 
     Route::get('/app/get_service_point',[ServiceController::class,'getServicePoint']);
     Route::post('/app/add_service_point',[ServiceController::class,'addServicePoint']);
     Route::put('/app/update_service_point',[ServiceController::class,'updateServicePoint']);
     Route::delete('/app/delete_service_point',[ServiceController::class,'deleteServicePoint']);
     Route::get('/app/get_service_point/{id}',[ServiceController::class,'getServicePointDetail']);
     Route::put('/app/resetServicePointPosition', [ServiceController::class, 'resetServicePointPosition']);

    //TrustedCompany
    Route::get('/app/get_trusted_company',[TrustedCompanyController::class,'getTrustedCompany']);
    Route::post('/app/add_trusted_company',[TrustedCompanyController::class,'addTrustedCompany']);
    Route::put('/app/update_trusted_company',[TrustedCompanyController::class,'updateTrustedCompany']);
    Route::delete('/app/delete_trusted_company',[TrustedCompanyController::class,'deleteTrustedCompany']);
    Route::get('/app/get_trusted_company/{id}',[TrustedCompanyController::class,'getTrustedCompanyDetail']);

    //ContactMe 
    Route::get('/app/get_contact_me',[ContactMeController::class,'getContactMe']);
    Route::post('/app/add_contact_me',[ContactMeController::class,'addContactMe']);
    Route::delete('/app/delete_contact_me',[ContactMeController::class,'deleteContactMe']);

    // Route::post('/app/add_router',[RouterController::class,'addRouter']);
    // Route::put('/app/update_router',[RouterController::class,'updateRouter']);
    // Route::delete('/app/delete_router/{id}',[RouterController::class,'deleteRouter']);





    // Vue routes
    Route::get('/app/router',[RouterController::class,'index']);
    Route::get('/app/router/sidebar',[RouterController::class,'sidebar']);
    Route::get('/app/router/autorized/sidebar',[RouterController::class,'autorizedSidebar']);
    Route::get('/app/central/search',[RouterController::class,'getCentralSearch']);



    /********************************   Dashboard    ************************************************/
    /********************************   Settings    ************************************************/
    // Company Settings
    Route::get('/app/setting',[TechoficSettingsController::class,'index']);
    Route::put('/app/setting',[TechoficSettingsController::class,'update']);
    Route::post('/app/setting/upload',[TechoficSettingsController::class,'upload']);

    //	theme setting
    Route::get('/app/getThemeSetting',[TechoficSettingsController::class,'getThemeSetting']);
    Route::put('/app/themeSettingUpdate',[TechoficSettingsController::class,'themeSettingUpdate']);

    /********************************   Report    *********************************************/
    /********************************   Admistrations    *********************************************/
    // Editors
    Route::get('/app/allAdmins',[TechoficAdminController::class,'allAdmins']);
    Route::get('/app/userList',[TechoficAdminController::class,'userList']);
    Route::get('/app/getSingleUser/{id}',[TechoficAdminController::class,'getSingleUser']);
    Route::post('/app/newUser',[TechoficAdminController::class,'newUser']);
    Route::post('/app/userUpdate',[TechoficAdminController::class,'userUpdate']);
    Route::post('/app/user/password/change',[TechoficAdminController::class,'userPasswordChange']);
    Route::delete('/app/userRemove/{id}',[TechoficAdminController::class,'userRemove']);


    // user role
    Route::get('/app/userRole',[TechoficUserRoleController::class,'getUserRole']);
    Route::get('/app/userRole/{id}',[TechoficUserRoleController::class,'singleUserRole']);
    Route::post('/app/userRole',[TechoficUserRoleController::class,'addUserRole']);
    Route::put('/app/userRole',[TechoficUserRoleController::class,'updateUserRole']);
    Route::delete('/app/userRole/{id}',[TechoficUserRoleController::class,'deleteUserRole']);


    // vue router
    Route::get('/app/get_router',[RouterController::class,'getRouter']);
    Route::get('/app/parentRoute/{id}',[RouterController::class,'getParentRoute']);
    Route::get('/app/get_router/{id}',[RouterController::class,'getRouterDetail']);
    Route::get('/app/getParentMenu',[RouterController::class,'getParentMenu']);
    Route::post('/app/add_router',[RouterController::class,'addRouter']);
    Route::put('/app/update_router',[RouterController::class,'updateRouter']);
    Route::put('/app/resetRoutesPosition',[RouterController::class,'resetRoutesPosition']);
    Route::delete('/app/delete_router/{id}',[RouterController::class,'deleteRouter']);



    Route::get('/app/authUser',[SettingController::class,'authUser']);
    Route::post('/app/changePassword',[SettingController::class,'changePassword']);


 

});
// Logins
Route::post('/app/login',[LoginController::class,'login']);
// Forgot Password
Route::post('/forgetPassword',[LoginController::class,'forgetPassword']);
Route::post('/change-Password',[LoginController::class,'changePassword']);
Route::post('/reset-password',[LoginController::class,'resetpassword']);

Route::get('/forgot-password', function () {
    return view("auth/forgot");
});
Route::get('/check-OTP', function () {
    return view("auth/submit");
});
Route::get('/reset-password', function () {
    return view("auth/reset");
});

Auth::routes();

Route::get('/logout', function () {
	Auth::logout();
    Session::flush();
	Session::forget('url.intented');
	return redirect("/login");

});

Route::get('/login', [StatusController::class,'login'])->name('login');

Route::any('{slug}', [StatusController::class,'index'])->where('slug', '([A-z_\0-9-\s]+)?')->middleware('auth');







