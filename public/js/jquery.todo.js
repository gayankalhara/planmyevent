var todoAjax = [];

(function($){
"use strict";
 $.ajax({

        url:"todoList",
        type:"get",
        data:{},
        success:function(data){
            todoAjax  = data;

            for(var i = 0; i < data.length; i++) {
                var obj = data[i];

                $.TodoApp.addTodo(obj.text, obj.id, obj.done);
                //console.log(obj.name);
            }
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
        this.$todoList = $("#todo-list"),
        this.$todoDonechk = ".todo-done",
        this.$todoForm = $("#todo-form"),
        this.$todoInput = $("#todo-input-text"),
        this.$todoBtn = $("#todo-btn-submit"),

        console.log(todoAjax);

        this.$todoData = todoAjax ;

        this.$todoCompletedData = [];
        this.$todoUnCompletedData = [];
    };

    //mark/unmark - you can use ajax to save data on server side
    TodoApp.prototype.markTodo = function(todoId, complete) {
       for(var count=0; count<this.$todoData.length;count++) {
            if(this.$todoData[count].id == todoId) {
                //alert(this.$todoData[count].id);
                //todoCompleteSuccess();
                this.$todoData[count].done = complete;
            }
       }
    },
    //adds new todo
    TodoApp.prototype.addTodo = function(todoText) {
        this.$todoData.push({'id': this.$todoData.length, 'text': todoText, 'done': false});
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
            swal(
              'Archieved!',
              'All your todo items that are marked as complete has been archieved.',
              'success'
            );

            $.TodoApp.$todoUnCompletedData = [];
            for(var count=0; count<$.TodoApp.$todoData.length;count++) {
                //geretaing html
                var todoItem = $.TodoApp.$todoData[count];
                if(todoItem.done == true) {
                    $.TodoApp.$todoCompletedData.push(todoItem);
                } else {
                    $.TodoApp.$todoUnCompletedData.push(todoItem);
                }
            }
            $.TodoApp.$todoData = [];
            $.TodoApp.$todoData = [].concat($.TodoApp.$todoUnCompletedData);
            //regenerate todo list
            $.TodoApp.generate();
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
            if(todoItem.done == true)
                this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-success"><input class="todo-done" id="' + todoItem.id + '" type="checkbox" checked><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');
            else {
                remaining = remaining + 1;
                this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-success"><input class="todo-done" id="' + todoItem.id + '" type="checkbox"><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');
            }
        }

        //set total in ui
        this.$todoTotal.text(this.$todoData.length);
        //set remaining
        this.$todoRemaining.text(remaining);
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
                $this.markTodo($(this).attr('id'), true);
            else
                $this.markTodo($(this).attr('id'), false);
            //regenerate list
            $this.generate();
        });

        //binding the new todo button
        this.$todoBtn.on("click", function() {
            if ($this.$todoInput.val() == "" || typeof($this.$todoInput.val()) == 'undefined' || $this.$todoInput.val() == null) {
                sweetAlert("Oops...", "You forgot to enter todo text", "error");
                $this.$todoInput.focus();
            } else {
                document.getElementById('preloader').style.visibility="visible";
                $this.addTodo($this.$todoInput.val());
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

function todoCompleteSuccess(){
    swal(
      'Good job!',
      'Your todo item has been marked as complete!',
      'success'
    )
}