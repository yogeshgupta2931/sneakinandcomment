require('./bootstrap');

$('.like_button').click(function() {
    let comment_container = $(this).closest('.comment_container');
    var comment_id = comment_container.find('.comment_id').first().val();
    let data = {
        comment_id: comment_id,
    };

    axios.post('comment/likecomment', data)
    .then(function (response) {
        if ( response.status == 200 ) {
            comment_container.find('.comment_like_count').html(response.data.html);
            console.log({ message : 'You liked the comment', priority : 'success' });
        } else {
            console.log({ message : 'Couldn\'t like the comment. Try again', priority : 'danger' });
        }
    })
    .catch(function (error) {
        console.log({ message : 'Something went wrong. Try refreshing the page', priority : 'danger' });
    });
});

$('.comment_container_actions').click(function() {
    let comment_container = $(this).closest('.comment_container');
    var comment_id = comment_container.find('.comment_id').first().val();
    let data = {
        comment_id: comment_id,
    };

    axios.post('comment/delete', data)
    .then(function (response) {
        if ( response.status == 200 ) {
            comment_container.remove();
            console.log({ message : 'You deleted the comment', priority : 'success' });
        } else {
            console.log({ message : 'Couldn\'t delete the comment. Try again', priority : 'danger' });
        }
    })
    .catch(function (error) {
        console.log({ message : 'Somethinh went wrong. Try refreshing the page', priority : 'danger' });
    });
});