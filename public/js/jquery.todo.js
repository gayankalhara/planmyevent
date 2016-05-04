var todoAjax = [];

//AJAX CSRF Setup
// $.ajaxSetup(
// {
//     headers:
//     {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

(function($){
"use strict";

//Show Preloader
showPreloader()

 $.ajax({
        url:"todoList",
        type:"get",
        data:{},
        success:function(data){
            todoAjax  = data;

            hidePreloader();

            for(var i = 0; i < data.length; i++) {
                var obj = data[i];
                $.TodoApp.addTodo(obj.description, obj.todo_id, obj.status);
            }

            //reinitButtons();

        },
        error: function(err){

        }
    });
})(window.jQuery),

function($) {
    "use strict";

    var TodoApp = function() {
        this.$body = $("body"),
        this.$todoContainer = $('#todo-container'),
        this.$todoMessage = $("#todo-message"),
        this.$todoRemaining = $("#todo-remaining"),
        this.$todoTotal = $("#todo-total"),
        this.$archiveBtn = $("#btn-archive"),
        this.$todoDelAllBtn = $("#todo-delAll"),
        this.$todoList = $("#todo-list"),
        this.$todoDonechk = ".todo-done",
        this.$todoForm = $("#todo-form"),
        this.$todoInput = $("#todo-input-text"),
        this.$todoBtn = $("#todo-btn-submit"),

        this.$todoData = todoAjax ;

        this.$todoCompletedData = [];
        this.$todoUnCompletedData = [];
    };

    //mark/unmark - you can use ajax to save data on server side
    TodoApp.prototype.markTodo = function(todoId, complete) {
       for(var count=0; count<this.$todoData.length;count++) {
            if(this.$todoData[count].id == todoId) {
                document.getElementById('preloader').style.visibility="visible";
                var data = new FormData();

                data.append('todoId', this.$todoData[count].id);
                data.append('todoStatus', this.$todoData[count].done);

                var url= "todoTickToggle";

                $.ajax({
                    url: url,
                    type: "post",
                    data: data,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,

                    success: function (data, status){
                        document.getElementById('preloader').style.visibility="hidden";
                    },

                    error: function (data){
                        document.getElementById('preloader').style.visibility="hidden";
                        
                        if (data.status === 422) {
                            swal(
                              'Something went wrong!',
                              'Unexpected error occured. Please try again!',
                              'error'
                            )
                        } else {
                            reinitButtons();
                        }
                    }
                });

                this.$todoData[count].done = complete;


            }
       }
    },
    //move todo items
    TodoApp.prototype.move = function (old_index, new_index) {
        if (new_index >= this.length) {
            var k = new_index - this.length;
            while ((k--) + 1) {
                $.TodoApp.$todoData.push(undefined);
            }
        }
        $.TodoApp.$todoData.splice(new_index, 0, $.TodoApp.$todoData.splice(old_index, 1)[0]);
            return this; // for testing purposes
    },
    //adds new todo
    TodoApp.prototype.addTodo = function(todoText, todoId, todoDone) {
        this.$todoData.push({'id': todoId, 'text': todoText, 'done': todoDone});

        //regenerate list
        this.generate();
    },
    //removes todo
    TodoApp.prototype.removeTodo = function(todoId) {
        this.$todoData.pop({'id': todoId});

        //regenerate list
        this.generate();
    },
    //Archives the completed todos
    TodoApp.prototype.archives = function() {
        swal({
          title: 'Are you sure?',
          text: "All your todo items that are marked as complete will be archieved. You can goto todo history page to see the deleted items.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Archieve Now',
          closeOnConfirm: false
        },
        function(isConfirm) {
          if (isConfirm) {
                    var url= "todoArchieve";
                    var data = new FormData();
                    

                    document.getElementById('preloader').style.visibility="visible";


                    $.TodoApp.$todoUnCompletedData = [];
                    for(var count=0; count<$.TodoApp.$todoData.length;count++) {
                        //geretaing html
                        var todoItem = $.TodoApp.$todoData[count];
                        if(todoItem.done == "true") {
                            $.TodoApp.$todoCompletedData.push(todoItem);
                        } else {
                            $.TodoApp.$todoUnCompletedData.push(todoItem);
                        }
                    }
                    $.TodoApp.$todoData = [];
                    $.TodoApp.$todoData = [].concat($.TodoApp.$todoUnCompletedData);


                    data.append('todo', JSON.stringify($.TodoApp.$todoUnCompletedData));

                  $.ajax({
                    url: url,
                    type:"post",
                    data: data,
                    dataType:"JSON",
                    processData: false,
                    contentType: false,
                      success: function (data, status) {
                        $.TodoApp.$todoData = [];
                        $.TodoApp.$todoList.html("");

                      }, 
                      error: function() {
                        if (data.status === 422) {
                          sweetAlert(
                            'Error Occured!',
                            'Something went wrong. Please try again!',
                            'error'
                          );
                        } else {
                            
                            
                            //regenerate todo list
                            $.TodoApp.generate();

                            document.getElementById('preloader').style.visibility="hidden";

                            swal(
                              'Archieved!',
                              'All your todo items that are marked as complete has been archieved.',
                              'success'
                            );
                        }
                      }
                  }); //AJAX End
          }
        })
        
        
    },
    //Generates todos
    TodoApp.prototype.generate = function() {
        //clear list
        this.$todoList.html("");
        var remaining = 0;
        for(var count=0; count<this.$todoData.length;count++) {
            //geretaing html
            var todoItem = this.$todoData[count];
            if(todoItem.done == "true")
                this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-success"><input class="todo-done" id="' + todoItem.id + '" type="checkbox" checked><label for="' + todoItem.id + '">' + todoItem.text + '</label><a data-id="' + todoItem.id + '" class="todo-del-btn btn btn-icon btn-custom btn-xs waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i></a><a data-id="' + count + '" data-todo-id="' + todoItem.id + '" class="todo-down btn btn-icon btn-custom btn-xs waves-effect waves-light btn-info m-b-5"><i class="fa fa-arrow-down"></i></a><a data-id="' + count + '" data-todo-id="' + todoItem.id + '" class="todo-up btn btn-icon btn-custom btn-xs waves-effect waves-light btn-info m-b-5"><i class="fa fa-arrow-up"></i></a></div></li>');
            else {
                remaining = remaining + 1;
                this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-success"><input class="todo-done" id="' + todoItem.id + '" type="checkbox"><label for="' + todoItem.id + '">' + todoItem.text + '</label><a data-id="' + todoItem.id + '" class="todo-del-btn btn btn-icon btn-custom btn-xs waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i></a><a data-id="' + count + '" data-todo-id="' + todoItem.id + '" class="todo-down btn btn-icon btn-custom btn-xs waves-effect waves-light btn-info m-b-5"><i class="fa fa-arrow-down"></i></a><a data-id="' + count + '" data-todo-id="' + todoItem.id + '" class="todo-up btn btn-icon btn-custom btn-xs waves-effect waves-light btn-info m-b-5"><i class="fa fa-arrow-up"></i></a></div></li>');
            }
        }

        //set total in ui
        this.$todoTotal.text(this.$todoData.length);
        //set remaining
        this.$todoRemaining.text(remaining);

        reinitButtons();
    },
    //init todo app
    TodoApp.prototype.init = function () {
        var $this = this;
        //generating todo list
        this.generate();

        //binding archive
        this.$archiveBtn.on("click", function(e) {
            e.preventDefault();
            $this.archives();
            return false;
        });

        //binding todo done chk
        $(document).on("change", this.$todoDonechk, function() {
            if(this.checked) 
                $this.markTodo($(this).attr('id'), "true");
            else
                $this.markTodo($(this).attr('id'), "false");
            //regenerate list
            $this.generate();
        });

        //binding todo Delete All
        this.$todoDelAllBtn.on("click", function() {
            if($.TodoApp.$todoData.length == 0){
                sweetAlert("Oops...", "You don't have any todo items to delete.", "error");
            } else {
                var todoID = $(this).attr("data-id");

              sweetAlert({
                title: 'Are you sure?',
                text: "All of your todo items will be permenently deleted.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#2379CE',
                confirmButtonColor: '#E02222',
                confirmButtonText: 'Yes, delete all!',
                closeOnConfirm: true
              },
              function(isConfirm) {
                if (isConfirm) {
                    var url= "todoDeleteAll";
                    var data = new FormData();

                    document.getElementById('preloader').style.visibility="visible";

                  $.ajax({
                    url: url,
                    type:"post",
                    data: data,
                    dataType:"JSON",
                    processData: false,
                    contentType: false,
                      success: function (data, status) {
                        $.TodoApp.$todoData = [];
                        $.TodoApp.$todoList.html("");
                      }, 
                      error: function() {
                        if (data.status === 422) {
                          sweetAlert(
                            'Error Occured!',
                            'Something went wrong. Please try again!',
                            'error'
                          );
                        } else {
                            $.TodoApp.$todoData = [];
                            $.TodoApp.$todoList.html("");
                            //set total in ui
                            $.TodoApp.$todoTotal.text(0);
                            //set remaining
                            $.TodoApp.$todoRemaining.text(0);

                            document.getElementById('preloader').style.visibility="hidden";

                            swal(
                              'Successfully Deleted',
                              'All of your todo items has been successfully deleted.',
                              'success'
                            )
                        }
                      }
                  }); //AJAX End

                }
              })
            }
            
        });

        //binding the new todo button
        this.$todoBtn.on("click", function() {
            if ($this.$todoInput.val() == "" || typeof($this.$todoInput.val()) == 'undefined' || $this.$todoInput.val() == null) {
                sweetAlert("Oops...", "You forgot to enter todo text", "error");
                $this.$todoInput.focus();
            } else {
                document.getElementById('preloader').style.visibility="visible";
                var data = new FormData();
                data.append('todoText', document.getElementById("todo-input-text").value);

                var url= "todoListAddNew";

                $.ajax({
                    url: url,
                    type:"post",
                    data: data,
                    dataType:"JSON",
                    processData: false,
                    contentType: false,

                    success: function (data, status){
                        document.getElementById('preloader').style.visibility="hidden";
                        $this.addTodo($this.$todoInput.val(), data, 'false');

                        //Empty todo input box entered text
                        document.getElementById("todo-input-text").value = "";
                    },

                    error: function (data){
                        document.getElementById('preloader').style.visibility="hidden";
                        
                        if (data.status === 422) {
                            swal(
                              'Something went wrong!',
                              'Unexpected error occured. Please try again!',
                              'error'
                            )
                        }
                    }
                });
            }

            
        });
    },
    //init TodoApp
    $.TodoApp = new TodoApp, $.TodoApp.Constructor = TodoApp
    
}(window.jQuery),

//initializing todo app
function($) {
    "use strict";
       $.TodoApp.init()
}(window.jQuery);


function reinitButtons(){
    todoDelClick();
    todoDownClick();
    todoUpClick();
}

function todoDelClick(){
    $(".todo-del-btn").click(function(){
                    var todoID = $(this).attr("data-id");

                      sweetAlert({
                        title: 'Are you sure?',
                        text: "Your todo item will be permenently deleted.",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#2379CE',
                        confirmButtonColor: '#E02222',
                        confirmButtonText: 'Yes, delete it!',
                        closeOnConfirm: true
                      },
                      function(isConfirm) {
                        if (isConfirm) {
                            document.getElementById('preloader').style.visibility="visible";

                            var data = new FormData();
                            data.append('todoId', todoID);

                            var url= "todoDelete";

                            $.ajaxSetup(
                            {
                                headers:
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                          $.ajax({
                              url: url,
                                type:"post",
                                data: data,
                                dataType:"JSON",
                                processData: false,
                                contentType: false,
                              success: function () {
                                  
                              }, 
                              error: function() {
                                  if (data.status === 422) {
                                    swal(
                                      'Something went wrong!',
                                      'Unexpected error occured. Please try again!',
                                      'error'
                                    )
                                  } else {
                                    swal(
                                      'Successfully Deleted',
                                      'Your todo item has been successfully deleted.',
                                      'success'
                                    )

                                    $.TodoApp.removeTodo(todoID);
                                    //$.TodoApp.$todoData.pop(todoID);
                                    //$.TodoApp.generate();
                                    document.getElementById('preloader').style.visibility="hidden";

                                  }
                              }
                          });

                          
                        }
                      })
            });
};


function todoDownClick(){
    $(".todo-down").click(function(){
        var downNo = parseInt($(this).attr("data-id"));
        var id = parseInt($(this).attr("data-todo-id"));

        $.TodoApp.move(downNo, ((parseInt(downNo-1)) < 0) ? 0 : (parseInt(downNo-1)));
        $.TodoApp.generate();

        //$(this).attr("data-id") = parseInt(downNo-1);

        var data = new FormData();
        data.append('todoId', id);

        var url= "todoMoveDown";

        $.ajax({
            url: url,
            type:"post",
            data: data,
            dataType:"JSON",
            processData: false,
            contentType: false,
          success: function () {
              
          }, 
          error: function() {
              if (data.status === 422) {
                swal(
                  'Something went wrong!',
                  'Unexpected error occured. Please try again!',
                  'error'
                )
              } else {
                //document.getElementById('preloader').style.visibility="hidden";
              }
          }
      }); //AJAX End

    });
};

function todoUpClick(){
    $(".todo-up").click(function(){
        var upNo = parseInt($(this).attr("data-id"));
        var id = parseInt($(this).attr("data-todo-id"));

        $.TodoApp.move(upNo, ((parseInt(upNo-1)) < 0) ? 0 : (parseInt(upNo+1)));
        $.TodoApp.generate();

        var data = new FormData();
        data.append('todoId', id);

        var url= "todoMoveUp";

        $.ajax({
            url: url,
            type:"post",
            data: data,
            dataType:"JSON",
            processData: false,
            contentType: false,
          success: function () {
              
          }, 
          error: function() {
              if (data.status === 422) {
                swal(
                  'Something went wrong!',
                  'Unexpected error occured. Please try again!',
                  'error'
                )
              } else {
                //document.getElementById('preloader').style.visibility="hidden";
              }
          }
      }); //AJAX End
    });
};