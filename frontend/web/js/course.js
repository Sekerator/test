function completeLesson(lessonId)
{
    $.ajax({
        url: 'lesson',
        method: 'get',
        dataType: 'html',
        data: {lessonId: lessonId},
        success: function(data){
            $('body').html(data);
        }
    });
}