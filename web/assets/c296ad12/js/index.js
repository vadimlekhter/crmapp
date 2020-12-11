let search_box = $('#search_div');
let button = $('#search_button');
console.log(search_box);
console.log(button);
button.click(function () {
    search_box.toggle();
})