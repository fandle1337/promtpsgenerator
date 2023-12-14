export default class {
    static getMarkerList() {
        return [
            {code: "original_message", name: "Весь текст сообщения, набранный в поле"},
            {code: "user_message", name: "Выделенный текст сообщения, набранный в поле"},
            {code: "role", name: "Роль"},
            {code: "author_message", name: "Текст оригинального поста ЖЛ или описание задачи"},
            {code: "language", name: "Язык портала"},
            {code: "context_message", name: "Текст инструмента + контекст"},
            {code: "author", name: "Автор"},
        ]
    }

    static getCategoryList() {
        return [
            {name: 'Новости (пост)', code: 'livefeed'},
            {name: 'Новости (комментарий)', code: 'livefeed_comments'},
            {name: 'Задачи (текст)', code: 'tasks'},
            {name: 'Задачи (комментарий)', code: 'tasks_comments'},
            {name: 'Чат', code: 'chat'},
            {name: 'Почта', code: 'mail'},
            {name: 'CRM (почта)', code: 'mail_crm'},
            {name: 'Сайты', code: 'landing'},
        ]
    }
}