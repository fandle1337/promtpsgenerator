export default class {
    static getMarkerList() {
        return [
            {code: "original_message", name: "Весь текст сообщения, набранный в поле", btn: "info"},
            {code: "user_message", name: "Выделенный текст сообщения, набранный в поле", btn: "info"},
            {code: "role", name: "Роль", btn: "info"},
            {code: "author_message", name: "Текст оригинального поста живой ленты или описание задачи", btn: "warning"},
            {code: "context_message", name: "Текст инструмента + контекст", btn: "warning"},
            {code: "language", name: "Язык портала", btn: "warning"},
            {code: "author.name", name: "Имя автора поста", btn: "help"},
            {code: "author.work_position", name: "Должность автора поста", btn: "help"},
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

    static getSectionList() {
        return [
            {name: 'Без секции', code: null},
            {name: 'Создать из текста', code: 'create'},
            {name: 'Подготовка писем', code: '010_emails'},
            {name: 'Улучши описание задачи', code: '020_task-description'},
            {name: 'Быстрые ответы', code: '030_reactions'},
            {name: 'Уточнения по тексту', code: '040_help'},
            {name: 'Измени текст', code: '050_edit'},
            {name: 'Тон текста', code: '060_tone'},
            {name: 'Напиши для меня', code: '070_write'},
        ]
    }
}