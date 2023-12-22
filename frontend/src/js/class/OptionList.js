export default class {
    static getMarkerList() {
        return [
            {
                code: "original_message",
                name: "Оригинальное сообщение для работы препромпта. В архитектуре редактора текста это весь набранный текст, либо выделенная руками часть набранного текста.",
                btn: "info"
            },
            {
                code: "user_message",
                name: "То, что ввел непосредственно пользователь.",
                btn: "info"
            },
            {
                code: "role",
                name: "Парный маркер, указывающий нейросети на её роль. Внутри текст задаётся в свободной форме, дающей нейронке какие-либо инструкции. Например, «говори как робот».",
                btn: "info"
            },
            {
                code: "author_message",
                name: "Текст оригинального поста живой ленты или описание задачи.",
                btn: "warning"
            },
            {
                code: "context_message",
                name: "Контекст «сколько вместится». Например оригинальный пост + все последние комментарии, или переписка чата за определенный срок. Или описание задачи + комментарии к ней.",
                btn: "warning"
            },
            {
                code: "language",
                name: "Язык портала (не пользователя!). Например, русский, english, español – именно на эти значения будет заменяться маркер.",
                btn: "warning"
            },
            {
                code: "author.name",
                name: "Имя автора поста.",
                btn: "help"
            },
            {
                code: "author.work_position",
                name: "Должность автора поста.",
                btn: "help"
            },
        ]
    }
    
    static getCategoryList() {
        return [
            {
                name: 'Новости (пост)',
                code: 'livefeed',
            },
            {
                name: 'Новости (комментарий)',
                code: 'livefeed_comments',
            },
            {
                name: 'Задачи (текст)',
                code: 'tasks',
            },
            {
                name: 'Задачи (комментарий)',
                code: 'tasks_comments',
            },
            {
                name: 'Чат',
                code: 'chat',
            },
            {
                name: 'Почта',
                code: 'mail',
            },
            {
                name: 'CRM (почта)',
                code: 'mail_crm',
            },
            {
                name: 'Сайты',
                code: 'landing',
            },
        ]
    }

    static getSectionList() {
        return [
            {
                name: 'Создать из текста',
                code: 'create'
            },
            {
                name: 'Подготовка писем',
                code: '010_emails'
            },
            {
                name: 'Улучши описание задачи',
                code: '020_task-description'
            },
            {
                name: 'Быстрые ответы',
                code: '030_reactions'
            },
            {
                name: 'Уточнения по тексту',
                code: '040_help'
            },
            {
                name: 'Измени текст',
                code: '050_edit'
            },
            {
                name: 'Тон текста',
                code: '060_tone'
            },
            {
                name: 'Напиши для меня',
                code: '070_write'
            },
        ]
    }
}