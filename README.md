# Bnovo-task

Тестовое задание для компании [Bnovo](https://bnovo.ru/).

## Задание
Условия задания сохранены в соседнем файле [task.md](./task.md)

## API маршруты

| Тип запроса  | API                | Описание         |
|--------------|--------------------|------------------|
| GET \| HEAD  | api/guests         | Список гостей    |
| POST         | api/guests         | Добавление гостя |
| GET \| HEAD  | api/guests/{guest} | Вывод гостя      |
| PUT \| PATCH | api/guests/{guest} | Изменение гостя  |
| DELETE       | api/guests/{guest} | Удаление гостя   |

Сохранённые запросы для Postman находятся в соседнем файле [Bnovo-task.postman_collection.json](./Bnovo-task.postman_collection.json)

## Как разворачивать проект

Проект использует инструмент Sail для работы с Docker в Laravel. Для запуска на машине потребуется Docker. 