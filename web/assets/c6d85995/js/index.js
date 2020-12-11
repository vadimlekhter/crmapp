let search_box = $('#search_div');
let search_button = $('#search_button');
let search = $('#search');


search_button.click(function () {
    if (search_button.text() === 'Поиск') {
        search_button.text('Скрыть поиск');
    } else if (search_button.text() === 'Скрыть поиск') {
        search_button.text('Поиск');
    }
    search_box.toggle();
})
