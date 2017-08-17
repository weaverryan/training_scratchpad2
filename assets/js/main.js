const $ = require('jquery');
const upperCaseElement = require('./lib/uppercase_element');
require('../css/global.scss');

$(document).ready(function() {
    $('h1').on('click', function(e) {
        upperCaseElement($(e.currentTarget));
    });
});
