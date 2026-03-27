
/*

Нужно запрограммировать мессенджер. Как должна работать программа:

— Шаблон сообщения находится в теге template с идентификатором message-template.

— В блоке сообщения (класс chat-message) должен быть текст сообщения, кнопка удаления и имя пользователя.

— Новое сообщение добавляется в конец контейнера с классом chat-content.

— Чтобы добавить новое сообщение, нужно ввести текст в поле ввода (элемент с классом chat-form-input) и нажать кнопку «Отправить» (отправляет данные из формы с классом chat-form).

- Чтобы удалить сообщение, нужно кликнуть по кнопке с крестиком (элемент с классом chat-message-button). Эта кнопка появляется при наведении на сообщение.


*/

let form = document.querySelector('.chat-form');
let input = document.querySelector('.chat-form-input');
let chatContent = document.querySelector('.chat-content');
let template = document.querySelector('#message-template').content;

form.onsubmit = function(evt){
    evt.preventDefault();
    let text = input.value;
    if (!text) return;
    let fragment = template.cloneNode(true);
    let chatMessage = fragment.querySelector('.chat-message');
    chatMessage.querySelector('.chat-message-text').textContent = text;
    let deleteButton = chatMessage.querySelector('.chat-message-button');
    deleteButton.onclick = function() {
        chatMessage.remove();
    };
    chatContent.append(fragment);
    input.value = '';
    input.focus();
};