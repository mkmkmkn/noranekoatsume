
// いいね機能
$(function () {
    var like = $(".js-nice-toggle");
    var likePostId;

    like.on("click", function () {
        likePostId = $(this).data("postid");
        thisNice = $(this);

        console.log(likePostId);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "{{ route('nice') }}",
            type: "POST",
            data: {
                id: likePostId,
            },
            dataType: "json",
        })
            .done(function (data) {
                thisNice.toggleClass("niced");

                if (data.niced) {
                    thisNice.children(".niceText").text("いいね削除");
                } else {
                    thisNice.children(".niceText").text("いいね");
                }
                thisNice.children(".badge").text(data.countNices);
            })
            .fail(function (data, xhr, err) {
                console.log("エラー");
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
