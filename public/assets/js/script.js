const delCat = document.querySelectorAll('#del-cat');
const delLinkCategory = document.querySelector('#del-link-category');
const delPost = document.querySelectorAll('#del-post');
const delLinkPost = document.querySelector('#del-link-post');

// Перебираем коллекцию
// Ставим обработчик на кнопку
// Получаем id
// Присваиваем id к переменной
// Выводим результат
delCat.forEach(function (del) {
    del.addEventListener('click', () => {
        delLinkCategory.innerHTML = '<a href="/admin/deleteCategory?id=' + del.dataset.id + '" class="btn btn-danger">Удалить</a>'
    });
});

delPost.forEach(function (del) {
    del.addEventListener('click', () => {
        delLinkPost.innerHTML = '<a href="/admin/deletePost?id=' + del.dataset.id + '" class="btn btn-danger">Удалить</a>'
    });
});