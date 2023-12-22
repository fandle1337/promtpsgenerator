export default function expand(category) {
    switch (category) {
        case "livefeed":
            return {
                name: 'Новости (пост)',
                code: 'livefeed',
                icon: "pi pi-bookmark-fill",
                color: "teal-400",
            };

        case "livefeed_comments":
            return {
                name: 'Новости (комментарий)',
                code: 'livefeed_comments',
                icon: "pi pi-comment",
                color: "teal-300"
            };

        case "tasks":
            return {
                name: 'Задачи (текст)',
                code: 'tasks',
                icon: "pi pi-check-circle",
                color: "blue-400"
            };

        case "tasks_comments":
            return {
                name: 'Задачи (комментарий)',
                code: 'tasks_comments',
                icon: "pi pi-comment",
                color: "blue-300"
            };

        case "chat":
            return {
                name: 'Чат',
                code: 'chat',
                icon: "pi pi-comments",
                color: "red-400"
            };

        case "mail":
            return {
                name: 'Почта',
                code: 'mail',
                icon: "pi pi-at",
                color: "purple-400"
            };

        case "mail_crm":
            return {
                name: 'CRM (почта)',
                code: 'mail_crm',
                icon: "pi pi-envelope",
                color: "purple-300"
            };

        case "landing":
            return {
                name: 'Сайты',
                code: 'landing',
                icon: "pi pi-desktop",
                color: "pink-400"
            };

        default:
            return {
                name: 'Без названия',
                code: '',
                icon: "",
                color: ""
            };
    }
}