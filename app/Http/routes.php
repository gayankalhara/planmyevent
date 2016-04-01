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
    Route::get('todoList','AdminPageController@todoList');
    Route::post('todoListAddNew','AdminPageController@todoListAddNew');
    Route::post('todoTickToggle','AdminPageController@todoTickToggle');
    Route::post('todoDelete','AdminPageController@todoDelete');
    Route::post('todoDeleteAll','AdminPageController@todoDeleteAll');
    Route::get('dashboard/events/categories', 'ControllerU@EventCategoriesLoad');
    Route::get('dashboard/todo', 'AdminPageController@ToDo');
});

//Routes that are available only for Admins
Route::group(['middleware' => ['web', 'App\Http\Middleware\AdminMiddleware']], function () {

    Route::get('auth/{provider?}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider?}/callback', 'Auth\AuthController@handleProviderCallback');
    Route::post('password/email/resend', 'AccountController@resendEmail');
    Route::post('change-email', 'AdminPageController@changeEmail');
    Route::get('dashboard/developers', 'AdminPageController@Developers');
    Route::get('dashboard/profile', 'AdminPageController@Profile');
    Route::get('dashboard/settings', 'AdminPageController@Settings');
    Route::post('dashboard/settings', 'AdminPageController@SettingsSubmit');
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
    

    Route::get('dashboard/events/categories/add','ControllerU@AddEventCategoriesLoad');   
    Route::post('dashboard/events/categories/add','ControllerU@AddEventCategoriesPost');   
    Route::get('dashboard/events/categories/edit','ControllerU@EditEventCategoriesLoad');
    Route::post('dashboard/events/categories/edit', 'ControllerU@EditEventCategoriesPost');
    Route::get('dashboard/events/categories/success', function(){return  view('event_types.success'); });
    Route::post('dashboard/events/categories/edit{id}', 'ControllerU@EditEventCategoriesPost');
    Route::post('dashboard/events/categories/check_catname', 'ControllerU@CheckEventCatName');
    Route::get('dashboard/services', 'ControllerU@Services');
    Route::get('dashboard/services/add', 'ControllerU@AddServices');
    Route::post('dashboard/services/add', 'ControllerU@AddServicesSubmit');
    Route::get('dashboard/services/edit', 'ControllerU@EditServices');
    Route::post('dashboard/services/edit', 'ControllerU@EditServicesSubmit');
    Route::get('dashboard/service-providers', 'ControllerU@ServiceProviders');
    Route::get('dashboard/service-providers/add','ControllerU@AddServiceProviderLoad');
    Route::post('dashboard/service-providers/add','ControllerU@AddServiceProviderSubmit');
    Route::get('dashboard/service-providers/edit','ControllerU@EditServiceProviderLoad');
    Route::post('dashboard/service-providers/edit','ControllerU@EditServiceProviderSubmit');
    Route::post('dashboard/service-providers/check_service', 'ControllerU@CheckService');
    Route::get('dashboard/events/categories/todotemp/add', 'ControllerU@ToDoTemplateAddLoad');
    Route::post('dashboard/events/categories/todotemp/add', 'ControllerU@ToDoTemplateAddPost');
    Route::get('dashboard/events/categories/todotemp/edit', 'ControllerU@ToDoTemplateEditLoad');
    Route::post('dashboard/events/categories/todotemp/edit', 'ControllerU@ToDoTemplateEditPost');
    Route::get('dashboard/events/categories/todotemp', 'ControllerU@ToDoTemplateLoad');
    Route::post('dashboard/events/categories/todotemp/check', 'ControllerU@GetToDoDetails');
    Route::get('dashboard/events/categories/tasks/add', 'ControllerU@TaskTemplateAddLoad');
    Route::post('dashboard/events/categories/tasks/add', 'ControllerU@TaskTemplateAddPost');
    Route::get('dashboard/events/categories/tasks/edit', 'ControllerU@TaskTemplateEditLoad');
    Route::post('dashboard/events/categories/tasks/edit', 'ControllerU@TaskTemplateEditPost');
    Route::get('dashboard/events/categories/tasks', 'ControllerU@TaskTemplateLoad');
    Route::post('dashboard/events/categories/tasks/check', 'ControllerU@GetTaskDetails');
    Route::post('dashboard/events/categories/tasks/check', 'ControllerU@GetTaskDetails');

    Route::get('dashboard/events/assign-tasks', 'ControllerU@AssignTasks');
    
    Route::get('dashboard/events/assign', 'ControllerU@Assign');

    Route::post('dashboard/events/assign', 'ControllerU@AssignPOST');
    Route::get('dashboard/test', function(){ return view('emails.register-success') ;    });

    Route::get('dashboard/events/progress', 'ControllerU@Progress');

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
});


//Routes that are only accessible by Event Planners (Admins also can access by changing the user role)
Route::group(['middleware' => ['web', 'App\Http\Middleware\EventPlannerMiddleware']], function () {

});


//Routes that are only accessible by Team Members (Admins also can access by changing the user role)
Route::group(['middleware' => ['web', 'App\Http\Middleware\TeamMemberMiddleware']], function () {
    
});

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});