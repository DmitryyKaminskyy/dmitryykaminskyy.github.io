$(document).ready(function () {

  //Validating and sending form data
  $('[data-submit]').on('click', function(){
      $(this).closest('form').submit();
    })
  $.validator.addMethod(
    "regex",
    function(value, element, regexp) {
      var re = new RegExp(regexp);
      return this.optional(element) || re.test(value);
    },
    "Please check your input."
    );
  function valEl(el){
   el.validate({
    rules:{
      tel:{
        required:true,
        regex: '^([\+]+)*[0-9\x20\x28\x29\-]{5,20}$'
      },
      name:{
        required:true
      },
      email:{
        required: true,
        email:true
      }
    },
     messages:{
        tel:{
            required:'Поле обязательно для заполнения',
            regex:'Телефон может содержать символы + - ()'
        },
        name:{
            required:'Поле обязательно для заполнения',
        },
        email:{
          required:'Поле обязательно для заполнения', 
          email:'Неверный формат E-mail'
        }
      },      
    submitHandler: function (form) {
      $('#loader').fadeIn();
      var $form = $(form);
      var $formId = $(form).attr('id'),
        f = $form[0],
        fd = new FormData(f);
      $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: fd,
        processData: false,
        contentType: false
      })
      .always(function (response) {
        setTimeout(function (){
          $('#loader').fadeOut();
        },1500);
         setTimeout(function (){
          $('#overlay').fadeIn();
        },1100);
        setTimeout(function (){
          $('#modal_consultation').modal('hide');
          $form.trigger('reset');
        },10);
         $('#overlay').on('click', function(e) {
          $('#overlay').fadeOut();
        });
      });
      }
    })
   }
  $('.js-form').each(function() {
    valEl($(this));
  });

});

