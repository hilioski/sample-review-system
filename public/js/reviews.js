var page = 1;
var score = 0;
$('#review_list').html('');

loadData();

function loadData(page = 1){
    $.get("/api/reviews?page="+page, function(response, status){
        if(response.next_page_url === null){
            $('#load_more').hide();
        }

        $.each(response.data, function( index, review ) {
            $('#review_list').append(' <li class="media">\n' +
                '                                    <a href="#" class="pull-left">\n' +
                '                                        <p data-letters="'+review.name.charAt(0).toUpperCase()+'"></p>\n' +
                '                                    </a>\n' +
                '                                    <div class="media-body">\n' +
                '                                <span class="text-muted pull-right">\n' +
                '                                    <small class="text-muted">'+ moment(review.created_at, "YYYY-MM-DD H:i:s").fromNow() +'</small><br>\n' +
                '                                    <small class="text-muted">' + getScore(review.score) + '</small>\n' +
                '                                </span>\n' +
                '                                        <strong class="text-success">'+ review.name +'</strong>\n' +
                '                                        <p>\n' +
                '                                            '+ review.text +'\n' +
                '                                        </p>\n' +
                '                                    </div>\n' +
                '                                </li>');
        });
    });
}

function getScore(stars) {
    var scoreHtml = '';

    var i;
    for (i = 0; i < 5; i++) {
        if(i < stars){
            scoreHtml += '<span class="icon" style="color: blue">★</span>';
        }else{
            scoreHtml += '<span class="icon">★</span>';
        }
    }

    return scoreHtml;
}

$('#load_more').on('click', function () {
    page++;
    loadData(page);
});

$('#submit_review').on('click', function () {
    var error = false;
    var name = $('#name').val();
    var text = $('#text').val();

    if(name === ''){
        error = true;
        $('#name').addClass('error');
    }else{
        $('#name').removeClass('error');
    }

    if(text === ''){
        error = true;
        $('#text').addClass('error');
    }else{
        $('#text').removeClass('error');
    }

    if(score === 0){
        error = true;
        $('#error_star').html('Please select a star rating');
    }else{
        $('#error_star').html('');
    }

    if(error === false){
        $.post("/api/reviews", {name: name, text: text, score: score} , function(data, status){
            if(status === "success"){
                $('#review_list').html('');
                loadData();
            }
        });
    }
});

$(':radio').change(function() {
    score = this.value;
});
