$(document).on('submit','.database_operation',function(){
    var url=$(this).attr('action');
    var data=$(this).serialize();
    $.post(url,data,function(fb){
        var resp=$.parseJSON(fb);
        if(resp.status=='true'){
            alert(resp.message);
            setTimeout(() => {
                window.location.href=resp.reload;
            }, 1000);
        }
        else{
            alert(resp.message);
        }
    });
    return false;
});

$(document).on('click','.apply_exam',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/student/apply_exam/'+id,function(fb){
        var resp=$.parseJSON(fb);
        if(resp.status=='true'){
            alert(resp.message);
            setTimeout(() => {
                window.location.href=resp.reload;
            }, 1000);
        }
        else{
            alert(resp.message);
        }
    })
})

$(document).on('click','.category_status',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/category_status/'+id,function(fb){
        alert("status successsfully changed");
    })
})


$(document).on('click','.exam_status',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/exam_status/'+id,function(fb){
        alert("status successsfully changed");
    })
})

$(document).on('click','.student_status',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/student_status/'+id,function(fb){
        alert("status successsfully changed");
    })
})

$(document).on('click','.portal_status',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/portal_status/'+id,function(fb){
        alert("status successsfully changed");
    })
})

$(document).on('click','.question_status',function(){
    var id=$(this).attr('data-id');
    $.get(BASE_URL+'/admin/question_status/'+id,function(fb){
        alert("status successsfully changed");
    })
})



var interval;
	function countdown() {
	  clearInterval(interval);
	  interval = setInterval( function() {
	      var timer = $('.js-timeout').html();
	      timer = timer.split(':');
	      var minutes = timer[0];
	      var seconds = timer[1];
	      seconds -= 1;
	      if (minutes < 0) return;
	      else if (seconds < 0 && minutes != 0) {
	          minutes -= 1;
	          seconds = 59;
	      }
	      else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

	      $('.js-timeout').html(minutes + ':' + seconds);

	      if (minutes == 0 && seconds == 0) { clearInterval(interval); alert('time UP'); myFunction() }
	  }, 1000);
	}

    var time = document.getElementById('timer').value;
	$('.js-timeout').text(time);
	countdown();


    function myFunction() {
        document.getElementById("myCheck").click();
      }
    

