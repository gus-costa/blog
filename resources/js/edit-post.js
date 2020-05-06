require('select2');
let SimpleMDE = require('simplemde');

$('.select2-multi').select2();

new SimpleMDE({ element: document.getElementById("post-editor") });