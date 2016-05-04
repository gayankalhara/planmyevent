<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/  

//Routes common to all users without any permission restriction
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'PageController@index');
    Route::get('/contact-us', 'PageController@ContactUs');
    Route::get('dashboard/permission-denied', 'PageController@PermissionDenied');
    Route::auth();
    Route::any('dashboard', 'AdminPageController@Dashboard');
    Route::get('dashboard/ToDo', 'AdminPageController@ToDo'); 
    Route::get('todoList','AdminPageController@todoList');
    Route::post('todoListAddNew','AdminPageController@todoListAddNew');
    Route::post('todoTickToggle','AdminPageController@todoTickToggle');
    Route::post('todoDelete','AdminPageController@todoDelete');
    Route::post('todoDeleteAll','AdminPageController@todoDeleteAll');
    Route::post('todoMoveUp','AdminPageController@todoMoveUp');
    Route::post('todoMoveDown','AdminPageController@todoMoveDown');
    Route::get('todoEmail','AdminPageController@todoEmail');
    Route::post('todoArchieve','AdminPageController@todoArchieve');
    Route::get('dashboard/events/categories', 'EveCategoryControllerU@EventCategoriesLoad');
    Route::get('dashboard/todo', 'AdminPageController@ToDo');
    Route::get('dashboard/profile', 'AdminPageController@Profile');
    Route::get('dashboard/settings', 'AdminPageController@Settings');
    Route::post('dashboard/settings', 'AdminPageController@SettingsSubmit');

    
});

//Routes that are available only for Admins
Route::group(['middleware' => ['web', 'App\Http\Middleware\AdminMiddleware']], function () {

    Route::get('auth/{provider?}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider?}/callback', 'Auth\AuthController@handleProviderCallback');
    Route::post('password/email/resend', 'AccountController@resendEmail');
    Route::post('change-email', 'AdminPageController@changeEmail');
    Route::get('dashboard/developers', 'AdminPageController@Developers');
    
    Route::get('dashboard/events/view-all', 'AdminPageController@ViewAllEvents');
    Route::get('dashboard/messages/new', 'AdminPageController@NewMessage');
    Route::get('dashboard/messages/inbox', 'AdminPageController@Inbox');
    Route::get('dashboard/messages/sent', 'AdminPageController@SentMessages');
    Route::get('dashboard/calendar', 'AdminPageController@Calendar');
    Route::get('dashboard/customers', 'AdminPageController@Customers');
    Route::get('dashboard/users', 'AdminPageController@Users');
    Route::get('dashboard/users/add-new', 'AdminPageController@AddNewUser');
    Route::get('dashboard/service-providers', 'AdminPageController@ServiceProviders');
    Route::get('dashboard/reviews', 'AdminPageController@Reviews');
    Route::get('dashboard/invoices', 'AdminPageController@Invoices');
    Route::get('dashboard/payments', 'AdminPageController@Payments');
    Route::get('dashboard/quote-requests', 'AdminPageController@QuoteRequests');
    Route::get('dashboard/statistics', 'AdminPageController@Statistics');
    Route::get('dashboard/about-us', 'AdminPageController@AboutUs');
    Route::get('dashboard/test', 'AdminPageController@Test');

    Route::post('dashboard/show_notification', 'NotificationController@ShowNotification');
    Route::get('dashboard/setReadStatus', 'NotificationController@setStatus');

    Route::get('dashboard/sendmail', function () {
        Mail::send('emails.register-success', [], function($message) {
            $message->to('gayan.csnc@gmail.com')
                ->subject('Welcome to PlanMyEvent.me');
        });

        return "Your email has been sent successfully";
    });

    Route::get('dashboard/deactivate', 'UserController@Deactivate');
    Route::get('dashboard/events/add', 'AdminPageController@EventAdd');
    Route::get( 'dashboard/users/role/switch/{role}', 'AdminPageController@SwitchUser' );
    Route::get( 'dashboard/users/role/switch/reset', 'AdminPageController@SwitchUserReset' );
    Route::get('dashboard/dbmigrate', 'DbmigrateController@index');
    Route::get('dashboard/question-builder','AdminPageController@Questionnaire');   
    Route::post('dashboard/question-builder/xml-post','AdminPageController@XmlPost');   

    /**
     * Udesh Routes
     */
    

    //***************************************new***********************************************

    Route::get('dashboard/events/categories/add','EveCategoryControllerU@AddEventCategoriesLoad');   

    Route::post('dashboard/events/categories/add','EveCategoryControllerU@AddEventCategoriesPost');   

    Route::get('dashboard/events/categories/edit','EveCategoryControllerU@EditEventCategoriesLoad');

    Route::post('dashboard/events/categories/edit', 'EveCategoryControllerU@EditEventCategoriesPost');  
    Route::get('dashboard/events/categories/success', function(){return  view('event_types.success'); });

    Route::post('dashboard/events/categories/edit{id}', 'EveCategoryControllerU@EditEventCategoriesPost');

    Route::post('dashboard/events/categories/check_catname', 'EveCategoryControllerU@CheckEventCatName');




    Route::get('dashboard/services', 'ServicesControllerU@Services');

    Route::get('dashboard/services/add', 'ServicesControllerU@AddServices');

    Route::post('dashboard/services/add', 'ServicesControllerU@AddServicesSubmit');

    Route::get('dashboard/services/edit', 'ServicesControllerU@EditServices');

    Route::post('dashboard/services/edit', 'ServicesControllerU@EditServicesSubmit');



    Route::get('dashboard/service-providers', 'ServiceProviderControllerU@ServiceProviders');

    Route::get('dashboard/service-providers/add','ServiceProviderControllerU@AddServiceProviderLoad');

    Route::post('dashboard/service-providers/add','ServiceProviderControllerU@AddServiceProviderSubmit');

    Route::get('dashboard/service-providers/edit','ServiceProviderControllerU@EditServiceProviderLoad');

    Route::post('dashboard/service-providers/edit','ServiceProviderControllerU@EditServiceProviderSubmit');

    Route::post('dashboard/service-providers/check_service', 'ServiceProviderControllerU@CheckService');










    Route::get('dashboard/events/categories/tasks/add', 'TaskTemplateControllerU@TaskTemplateAddLoad');

    Route::post('dashboard/events/categories/tasks/add', 'TaskTemplateControllerU@TaskTemplateAddPost');

    Route::get('dashboard/events/categories/tasks/edit', 'TaskTemplateControllerU@TaskTemplateEditLoad');

    Route::post('dashboard/events/categories/tasks/edit', 'TaskTemplateControllerU@TaskTemplateEditPost');

    Route::get('dashboard/events/categories/tasks', 'TaskTemplateControllerU@TaskTemplateLoad');

    Route::post('dashboard/events/categories/tasks/check', 'TaskTemplateControllerU@GetTaskDetails');

 


    Route::get('dashboard/events/assign-tasks', 'TaskAssignControllerU@AssignTasks');


    Route::get('dashboard/events/assign', 'TaskAssignControllerU@Assign');


    Route::post('dashboard/events/assign', 'TaskAssignControllerU@AssignPOST');

    Route::get('dashboard/test', function(){ return view('emails.register-success') ;    });

   

    Route::post('dashboard/notifications', 'ControllerU@Notifications');

    Route::post('dashboard/checknotifications', 'ControllerU@CheckNotifications');
    
    /**
     * END Udesh Routes
     */


    /**
     * Hasitha Routes
     */

    Route::get('dashboard/quote-requests', 'hjController@ViewQuoteRequestsAdmin');
    Route::get('dashboard/quote-requests/view-pending', 'hjController@ViewPendingQuotesAdmin');
    Route::get('dashboard/quote-requests/view-approved', 'hjController@ViewApprovedQuotesAdmin');
    Route::get('dashboard/quote-requests/view-rejected', 'hjController@ViewRejectedQuotesAdmin');
    Route::get('dashboard/quote-requests/reject-message', 'hjController@ViewRejectMessageAdmin');
    Route::post('dashboard/quote-requests/approve-quote', 'hjController@ApproveQuoteAdmin');
    Route::get('dashboard/quote-requests/approve-quote', 'hjController@ApproveQuoteAdmin');
    Route::post('dashboard/quote-requests/send-quotation', 'hjController@SendQuotationAdmin');
    Route::get('dashboard/quote-requests/reject-quote', 'hjController@RejectQuoteAdmin');
    Route::post('dashboard/quote-requests/send-reject-quote', 'hjController@SendRejectQuoteAdmin');
    Route::get('dashboard/events/view-all', 'hjController@ViewAllEventsAdmin');

    /**
     * END Hasitha Routes
     */
});

//Routes that are only accessible by Customers (Admin also can access by changing the user role)
Route::group(['middleware' => ['web', 'App\Http\Middleware\CustomerMiddleware']], function () {

    Route::get('dashboard/request-a-quote', 'hjController@LoadEventTypes');
    Route::post('dashboard/request-a-quote/task', 'hjController@LoadServices');
    Route::post('dashboard/request-a-quote/addquote', 'hjController@AddQuoteCustomer');
    Route::get('dashboard/view-quote-requests', 'hjController@ViewQuoteRequestsCustomer');
    Route::get('dashboard/view-quote-requests/pending-quotes', 'hjController@ViewPendingQuotesCustomer');
    Route::get('dashboard/view-quote-requests/approved-quotes', 'hjController@ViewApprovedQuotesCustomer');
    Route::get('dashboard/view-quote-requests/rejected-quotes', 'hjController@ViewRejectedQuotesCustomer');
    Route::get('dashboard/view-quote-requests/reject-message', 'hjController@ViewRejectMessageCustomer');
    Route::post('dashboard/view-quote-requests/quote-payment', 'hjController@QuotePaymentDetailsCustomer');
    Route::post('dashboard/view-quote-requests/pay', 'PaymentController@store');
    Route::get('dashboard/view-quote-requests/pay/status', [
        'as' => 'payment-status', 'uses' => 'hjController@DisplayPaymentSuccess'
    ]);
    Route::post('dashboard/view-quote-requests/pay/error', [
        'as' => 'original-route', 'uses' => 'hjController@DisplayPaymentFail'
    ]);
    Route::get('dashboard/view-all-events', 'hjController@ViewAllEventsCustomer');

    Route::get('dashboard/events/customerevents', 'ProgressControllerU@CustomerEvents'); 
     Route::get('dashboard/events/progresscustomer', 'ProgressControllerU@ProgressCustomer'); 
});


//Routes that are only accessible by Event Planners (Admins also can access by changing the user role)
Route::group(['middleware' => ['web', 'App\Http\Middleware\EventPlannerMiddleware']], function () {

});


//Routes that are only accessible by Team Members (Admins also can access by changing the user role)
Route::group(['middleware' => ['web', 'App\Http\Middleware\TeamMemberMiddleware']], function () {
    Route::get('dashboard/events/progress', 'ProgressControllerU@Progress'); 
    Route::post('dashboard/events/progress', 'ProgressControllerU@EditProgress'); 
    Route::get('dashboard/events/myevents', 'ProgressControllerU@MyEvents');  
});

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});