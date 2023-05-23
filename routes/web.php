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
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpecialSkillsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\StatisticsCountController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\TrustedCompanyController;


Route::middleware([CheckCustomAuth::class])->prefix('/app')->group(function () {
    Route::get('/getUser',  [UserController::class, 'getUser']);
    Route::post('/updateInfo',  [UserController::class, 'updateInfo']);
    Route::post('/updateInfoRemove',  [UserController::class, 'updateInfoRemove']);
    

    //Attachment
    Route::post('/upload_attachment', [UserController::class, 'uploadAttachment']);
    Route::post('/delete_attachment', [UserController::class, 'deleteAttachment']);
    //image
    Route::post('/delete_image', [UserController::class, 'deleteImage']);
    Route::post('/upload', [UserController::class, 'upload']);

    //AboutMe 
    Route::get('/get_education',[AboutMeController::class,'getEducation']);
    Route::get('/get_experience',[AboutMeController::class,'getExperience']);
    Route::post('/add_aboutme',[AboutMeController::class,'addAboutMe']);
    Route::put('/update_aboutme',[AboutMeController::class,'updateAboutMe']);
    Route::delete('/delete_aboutme',[AboutMeController::class,'deleteAboutMe']);
    Route::get('/get_aboutme/{id}',[AboutMeController::class,'getAboutMeDetail']);

    //Testimonial 
    Route::get('/get_testimonial',[TestimonialController::class,'getTestimonial']);
    Route::post('/add_testimonial',[TestimonialController::class,'addTestimonial']);
    Route::put('/update_testimonial',[TestimonialController::class,'updateTestimonial']);
    Route::delete('/delete_testimonial',[TestimonialController::class,'deleteTestimonial']);
    Route::get('/get_testimonial/{id}',[TestimonialController::class,'getTestimonialDetail']);

    //StatisticsCount 
    Route::get('/get_StatisticsCount',[StatisticsCountController::class,'getStatisticsCount']);
    Route::post('/add_StatisticsCount',[StatisticsCountController::class,'addStatisticsCount']);
    Route::put('/update_StatisticsCount',[StatisticsCountController::class,'updateStatisticsCount']);
    Route::delete('/delete_StatisticsCount',[StatisticsCountController::class,'deleteStatisticsCount']);
    Route::get('/get_StatisticsCount/{id}',[StatisticsCountController::class,'getStatisticsCountDetail']);

    //Project
    Route::get('/get_project',[ProjectController::class,'getProject']);
    Route::post('/add_project',[ProjectController::class,'addProject']);
    Route::put('/update_project',[ProjectController::class,'updateProject']);
    Route::delete('/delete_project',[ProjectController::class,'deleteProject']);
    Route::get('/get_project/{id}',[ProjectController::class,'getProjectDetail']);

    //Special Skills
    Route::get('/get_skills',[SpecialSkillsController::class,'getSkills']);
    Route::post('/add_skill',[SpecialSkillsController::class,'addSkill']);
    Route::put('/update_skill',[SpecialSkillsController::class,'updateSkill']);
    Route::delete('/delete_skill',[SpecialSkillsController::class,'deleteSkill']);
    Route::get('/get_skill/{id}',[SpecialSkillsController::class,'getSkillDetail']);
    Route::put('/resetSkillPosition', [SpecialSkillsController::class, 'resetSkillPosition']);

    //Service Title
    Route::get('/get_service_title',[ServiceController::class,'getServiceTitle']);
    Route::post('/add_service_title',[ServiceController::class,'addServiceTitle']);
    Route::put('/update_service_title',[ServiceController::class,'updateServiceTitle']);
    Route::delete('/delete_service_title',[ServiceController::class,'deleteServiceTitle']);
    Route::get('/get_service_title/{id}',[ServiceController::class,'getServiceTitleDetail']);
    Route::put('/resetServiceTitlePosition', [ServiceController::class, 'resetServiceTitlePosition']);

     //Service Point
     Route::get('/get_service_point',[ServiceController::class,'getServicePoint']);
     Route::post('/add_service_point',[ServiceController::class,'addServicePoint']);
     Route::put('/update_service_point',[ServiceController::class,'updateServicePoint']);
     Route::delete('/delete_service_point',[ServiceController::class,'deleteServicePoint']);
     Route::get('/get_service_point/{id}',[ServiceController::class,'getServicePointDetail']);
     Route::put('/resetServicePointPosition', [ServiceController::class, 'resetServicePointPosition']);

    //TrustedCompany
    Route::get('/get_trusted_company',[TrustedCompanyController::class,'getTrustedCompany']);
    Route::post('/add_trusted_company',[TrustedCompanyController::class,'addTrustedCompany']);
    Route::put('/update_trusted_company',[TrustedCompanyController::class,'updateTrustedCompany']);
    Route::delete('/delete_trusted_company',[TrustedCompanyController::class,'deleteTrustedCompany']);
    Route::get('/get_trusted_company/{id}',[TrustedCompanyController::class,'getTrustedCompanyDetail']);

    //ContactMe 
    Route::get('/get_contact_me',[ContactMeController::class,'getContactMe']);
    Route::post('/add_contact_me',[ContactMeController::class,'addContactMe']);
    Route::delete('/delete_contact_me',[ContactMeController::class,'deleteContactMe']);

    // Route::post('/add_router',[RouterController::class,'addRouter']);
    // Route::put('/update_router',[RouterController::class,'updateRouter']);
    // Route::delete('/delete_router/{id}',[RouterController::class,'deleteRouter']);





    // Vue routes
    Route::get('/router',[RouterController::class,'index']);
    Route::get('/router/sidebar',[RouterController::class,'sidebar']);
    Route::get('/router/autorized/sidebar',[RouterController::class,'autorizedSidebar']);
    Route::get('/central/search',[RouterController::class,'getCentralSearch']);



    /********************************   Dashboard    ************************************************/
    /********************************   Settings    ************************************************/
    // Company Settings
    Route::get('/setting',[TechoficSettingsController::class,'index']);
    Route::put('/setting',[TechoficSettingsController::class,'update']);
    Route::post('/setting/upload',[TechoficSettingsController::class,'upload']);

    //	theme setting
    Route::get('/getThemeSetting',[TechoficSettingsController::class,'getThemeSetting']);
    Route::put('/themeSettingUpdate',[TechoficSettingsController::class,'themeSettingUpdate']);

    /********************************   Report    *********************************************/
    /********************************   Admistrations    *********************************************/
    // Editors
    Route::get('/allAdmins',[TechoficAdminController::class,'allAdmins']);
    Route::get('/userList',[TechoficAdminController::class,'userList']);
    Route::get('/getSingleUser/{id}',[TechoficAdminController::class,'getSingleUser']);
    Route::post('/newUser',[TechoficAdminController::class,'newUser']);
    Route::post('/userUpdate',[TechoficAdminController::class,'userUpdate']);
    Route::post('/user/password/change',[TechoficAdminController::class,'userPasswordChange']);
    Route::delete('/userRemove/{id}',[TechoficAdminController::class,'userRemove']);


    // user role
    Route::get('/userRole',[TechoficUserRoleController::class,'getUserRole']);
    Route::get('/userRole/{id}',[TechoficUserRoleController::class,'singleUserRole']);
    Route::post('/userRole',[TechoficUserRoleController::class,'addUserRole']);
    Route::put('/userRole',[TechoficUserRoleController::class,'updateUserRole']);
    Route::delete('/userRole/{id}',[TechoficUserRoleController::class,'deleteUserRole']);


    // vue router
    Route::get('/get_router',[RouterController::class,'getRouter']);
    Route::get('/parentRoute/{id}',[RouterController::class,'getParentRoute']);
    Route::get('/get_router/{id}',[RouterController::class,'getRouterDetail']);
    Route::get('/getParentMenu',[RouterController::class,'getParentMenu']);
    Route::post('/add_router',[RouterController::class,'addRouter']);
    Route::put('/update_router',[RouterController::class,'updateRouter']);
    Route::put('/resetRoutesPosition',[RouterController::class,'resetRoutesPosition']);
    Route::delete('/delete_router/{id}',[RouterController::class,'deleteRouter']);



    Route::get('/authUser',[SettingController::class,'authUser']);
    Route::post('/changePassword',[SettingController::class,'changePassword']);


 

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
Route::prefix('/api')->group(function(){
    Route::get('/user', [HomeController::class, 'getUserInfo']);
    Route::get('/download_attachment/{url}', [HomeController::class, 'downloadAttachment']);

    Route::get('/services', [HomeController::class, 'getServices']);
    Route::get('/special_skills', [HomeController::class, 'getSpecialSkills']);
    Route::get('/statistics_count', [HomeController::class, 'getStatisticsCount']);
    Route::get('/projects', [HomeController::class, 'getProjects']);
    Route::get('/project/{id}', [HomeController::class, 'getProjectDetails']);
    Route::get('/testimonials', [HomeController::class, 'getTestimonials']);
    Route::get('/trusted_companies', [HomeController::class, 'getTrustedCompanies']);
    Route::get('/educations', [HomeController::class, 'getEducations']);
    Route::get('/experiences', [HomeController::class, 'getExperiences']);
    Route::post('/contact_me', [HomeController::class, 'addContactMe']);
});

Route::any('{slug}', [StatusController::class,'index'])->where('slug', '([A-z_\0-9-\s]+)?')->middleware('auth');



