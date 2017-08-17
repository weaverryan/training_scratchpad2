const $ = require('jquery');
require('../css/global.scss');

$(document).ready(function() {
    $('h1').on('click', function(e) {
        $(e.currentTarget).addClass('text-uppercase');
    });
});
