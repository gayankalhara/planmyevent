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

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::any('/', 'PageController@index');

    Route::get('auth/{provider?}', 'Auth\AuthController@redirectToProvider');

    Route::get('auth/{provider?}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/developers', 'PageController@Developers');

    Route::get('/profile', 'PageController@Profile');

    Route::get('/settings', 'PageController@Settings');

    Route::get('/events/view-all', 'PageController@ViewAllEvents');

    Route::get('/messages/new', 'PageController@NewMessage');

    Route::get('/messages/inbox', 'PageController@Inbox');

    Route::get('/messages/sent', 'PageController@SentMessages');

    Route::get('/calendar', 'PageController@Calendar');

    Route::get('/customers', 'PageController@Customers');

    Route::get('/team-members', 'PageController@TeamMembers');

    Route::get('/team-members/add-new', 'PageController@AddNewTeamMember');

    Route::get('/service-providers', 'PageController@ServiceProviders');

    Route::get('/reviews', 'PageController@Reviews');

    Route::get('/request-a-quote', 'PageController@RequestAQuote');

    Route::get('/quote-requests', 'PageController@QuoteRequests');

    Route::get('/invoices', 'PageController@Invoices');

    Route::get('/payments', 'PageController@Payments');

    Route::get('/statistics', 'PageController@Statistics');

    Route::get('/about-us', 'PageController@AboutUs');

    Route::get('/test', 'PageController@Test');

    Route::get('sendmail', function () {
        Mail::raw('Laravel with Mailgun is easy!', function($message)
        {
            $message->to('gayan.csnc@gmail.com')->subject('Learning Laravel test email');;
        });

        return "Your email has been sent successfully";
    });

    Route::get('/deactivate', 'UserController@Deactivate');

    Route::get('/events/add', 'PageController@EventAdd');

    Route::get( '/users/role/switch/{role}', 'PageController@SwitchUser' );
    Route::get( '/users/role/switch/reset', 'PageController@SwitchUserReset' );
        
    Route::get('dbmigrate', 'DbmigrateController@index');

    Route::get('/question-builder','PageController@Questionnaire');   

    Route::post('/question-builder/xml-post','PageController@XmlPost');   

    /**
     * Udesh Routes
     */
    
    Route::get('/events/categories', 'ControllerU@EventCategoriesLoad');

    Route::get('/events/categories/add','ControllerU@AddEventCategoriesLoad');   

    Route::post('/events/categories/add','ControllerU@AddEventCategoriesPost');   

    Route::get('/events/categories/edit','ControllerU@EditEventCategoriesLoad');

    Route::post('/events/categories/edit', 'ControllerU@EditEventCategoriesPost');

    Route::get('/events/categories/success', function(){    return  view('event_types.success');     });

    Route::post('/events/categories/edit{id}', 'ControllerU@EditEventCategoriesPost');

    Route::post('/events/categories/check_catname', 'ControllerU@CheckEventCatName');

    Route::get('/service-providers', 'ControllerU@ServiceProviders');

    Route::get('/service-providers/add','ControllerU@AddServiceProviderLoad');

    Route::post('/service-providers/add','ControllerU@AddServiceProviderSubmit');

    Route::get('/service-providers/edit','ControllerU@EditServiceProviderLoad');

    Route::post('/service-providers/edit','ControllerU@EditServiceProviderSubmit');
    
    Route::post('/service-providers/check_service', 'ControllerU@CheckService');
    
    /**
     * END Udesh Routes
     */


        /**
     * Hasitha Routes
     */
    Route::get('/request-a-quote', 'hjController@RequestAQuoteLoad');

    Route::post('/request-a-quote/task', 'hjController@RequestAQuoteGetTask');

    Route::post('/request-a-quote/addquote', 'hjController@RequestAQuoteAddQuote');

    Route::get('/view-quote-requests', 'hjController@ViewQuoteRequests');

    Route::get('/quote-requests', 'hjController@QuoteRequestsAdmin');

    Route::get('/quote-requests/view-pending', 'hjController@ViewPendingQuoteRequests');

    Route::post('/quote-requests/approve-quote', 'hjController@ApproveQuote');

    /**
     * END Hasitha Routes
     */

});