export default class ParseIconName {
    getContentFromCss() {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();

            xhr.open('GET', 'https://skyweb24.ru/bitrix/js/ui/icon-set/main/style.min.css', true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const cssContent = xhr.responseText;
                    resolve(cssContent);
                } else {
                    reject('Не удалось загрузить CSS файл');
                }
            };

            xhr.onerror = function () {
                reject('Произошла ошибка при выполнении запроса');
            };

            xhr.send();
        });
    }
}