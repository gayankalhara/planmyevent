<?php
 
//
// NOTE Migration Created: 2016-02-09 19:53:15
// --------------------------------------------------
 
class CreateSepDatabase {
//
// NOTE - Make changes to the database.
// --------------------------------------------------
 
public function up()
{

//
// NOTE -- event_types
// --------------------------------------------------
 
Schema::create('event_types', function($table) {
 $table->increments('EventName', 50);
 $table->increments('Task', 50);
 $table->string('Icon', 6000)->nullable();
 });


//
// NOTE -- password_resets
// --------------------------------------------------
 
Schema::create('password_resets', function($table) {
 $table->string('email', 255);
 $table->string('token', 255);
 $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
 });


//
// NOTE -- services
// --------------------------------------------------
 
Schema::create('services', function($table) {
 $table->increments('CompanyName', 50);
 $table->increments('Service', 50);
 $table->string('Address', 100);
 $table->unsignedInteger('TelNo');
 $table->string('Email', 50);
 });


//
// NOTE -- sessions
// --------------------------------------------------
 
Schema::create('sessions', function($table) {
 $table->increments('id', 255);
 $table->unsignedInteger('user_id')->nullable();
 $table->string('ip_address', 45)->nullable();
 $table->text('user_agent')->nullable();
 $table->text('payload');
 $table->unsignedInteger('last_activity');
 });


//
// NOTE -- team_members
// --------------------------------------------------
 
Schema::create('team_members', function($table) {
 $table->increments('id');
 $table->string('Name', 45)->nullable();
 $table->string('Email', 45)->nullable()->unique();
 $table->string('Address', 45)->nullable();
 $table->string('specializations', 500)->nullable();
 $table->string('username', 45)->nullable()->unique();
 });


//
// NOTE -- users
// --------------------------------------------------
 
Schema::create('users', function($table) {
 $table->increments('id')->unsigned();
 $table->string('name', 255);
 $table->string('email', 255)->unique();
 $table->string('avatar', 255);
 $table->string('password', 60);
 $table->string('remember_token', 100)->nullable();
 $table->timestamp('created_at')->default("CURRENT_TIMESTAMP");
 $table->timestamp('updated_at')->default("0000-00-00 00:00:00");
 $table->string('provider', 255);
 $table->string('provider_id', 255)->unique();
 $table->string('role', 255);
 });



}
 
//
// NOTE - Revert the changes to the database.
// --------------------------------------------------
 
public function down()
{

Schema::drop('event_types');
Schema::drop('password_resets');
Schema::drop('services');
Schema::drop('sessions');
Schema::drop('team_members');
Schema::drop('users');

}
}