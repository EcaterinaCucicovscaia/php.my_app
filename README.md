# 📝 Индивидуальная работа: Веб-приложение для прохождения теста

## 📌 Описание индивидуальной работы

**Цель:**
Разработка веб-приложения на PHP, позволяющего пользователю анонимно пройти тест, а администратору — просматривать и управлять результатами через защищённую панель.

## ⚙️ Инструкция по запуску проекта

1. Установите [XAMPP](https://www.apachefriends.org/index.html) и запустите Apache и MySQL.
2. Скопируйте проект в `htdocs`, например: `C:\xampp\htdocs\my_app`
3. Создайте базу данных `my_app_db` через phpMyAdmin.
4. Выполните SQL-скрипт:

```sql
CREATE DATABASE my_app_db;
USE my_app_db;

CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100),
  score INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admins (username, password)
VALUES ('admin', SHA1('admin123'));
```

5. Отредактируйте `db.php`, если нужно: логин root, пароль "", база `my_app_db`.
6. Откройте: `http://localhost/my_app/index.php`

---

## 📄 Краткая документация

### Структура проекта

```
my_app/
├── index.php             // Главная страница
├── test.php              // Страница тестирования
├── result.php            // Пост-результат
├── dashboard.php         // Админ-панель
├── login.php             // Вход для админа
├── logout.php            // Выход
├── save_answer.php       // Сохранение ответов
├── database.php          // База данных
├── questions.json        // Вопросы
└── style.css             // Стили
```

### Форма ввода имени

```html
<form method="post" action="">
  <input type="text" name="username" placeholder="Введите имя" required>
  <input type="submit" value="Пройти тест">
</form>
```
![image](https://github.com/user-attachments/assets/45762e58-ff13-4142-823f-402795a5d00d)

### Структура `questions.json`

```json
[
  {
    "question": "Что такое PHP?",
    "type": "single",
    "options": ["\u042f\u0437\u044b\u043a \u043f\u0440\u043e\u0433\u0440\u0430\u043c\u043c\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u044f", "\u0411\u0440\u0430\u0443\u0437\u0435\u0440", "\u0420\u0435\u0434\u0430\u043a\u0442\u043e\u0440 \u043a\u043e\u0434\u0430"],
    "answer": [0]
  }
]
```
![image](https://github.com/user-attachments/assets/04e5627e-e7fe-4548-9e53-2c0bd6c84d90)
![image](https://github.com/user-attachments/assets/3f63484d-4c3f-4517-8e71-6f0b1033d2a2)
![image](https://github.com/user-attachments/assets/7b1f27a5-c908-4b4b-8d56-990c83c92071)
![image](https://github.com/user-attachments/assets/dfbc72cd-6ed9-49d3-955d-3a6968a0e91f)




---

## ❓ Ответы на контрольные вопросы

1. **Как осуществляется разграничение доступа?** Через сессию и аутентификацию admin/login.php.
2. **Какие типы вопросов поддерживаются?** `radio` (один ответ), `checkbox` (несколько ответов).
3. **Как хранятся результаты?** В MySQL базе `quiz_app`, таблица `results`.
4. **Защита данных?** Фильтрация, `htmlspecialchars`, ограничение доступа по сессии.

---

## 📚 Источники

* [PHP.net](https://www.php.net/manual/ru/)
* [W3Schools PHP](https://www.w3schools.com/php/)
* [MDN HTML Forms](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/form)
* [XAMPP Apache + MySQL](https://www.apachefriends.org/)

---
