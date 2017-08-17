import $ from 'jquery';
import upperCaseElement from './lib/uppercase_element';
import '../css/global.scss';

$(document).ready(function() {
    $('h1').on('click', function(e) {
        upperCaseElement($(e.currentTarget));
    });
});
