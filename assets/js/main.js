const $ = require('jquery');

$(document).ready(function() {
    $('h1').on('click', function(e) {
        $(e.currentTarget).addClass('text-uppercase');
    });
});
