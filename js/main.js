//Вешаем событие на элементы палецВверх и палецВниз

    $(".containerPosts .voteInfo .icon-thumbs-up.pointer").on('click', function(){

        var self = $(this).parent();
        $.post("./up.php", {
            id:self.attr("id"),
            u_id:self.attr("u_id")
        }, function(data){
            location.reload();
        });
    });
    $(".containerPosts .voteInfo .icon-thumbs-down.pointer").on('click', function(e){

        var self = $(this).parent();
        $.post("./down.php", {
            id:self.attr("id"),
            u_id:self.attr("u_id")
        }, function(data){
            location.reload();
        });
    });
    $(".sendComment .sendButton").on("click", function(e){
        e.preventDefault();
        var self = $(this);
        $.post("./add_comment.php", {
            id   : self.attr("id"),
            text : $(".textareaStyle").val(),
            author_id : self.attr("u_id")
        }, function(data){
            location.reload();
        });
    });
