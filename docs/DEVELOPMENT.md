# SINT — руководство для разработчиков

Документ описывает архитектуру, правила и журнал миграции MVC/SOLID.

---

## 1. Назначение

PHP-приложение OSINT-поиска + панель **IPso** (личные дела).

| Контур | Доступ | Страницы |
|--------|--------|----------|
| Поиск | `?token=` → `users` | `search.php`, `search_request.php`, `search_results.php` |
| IPso | сессия `ipso_user` | `login.php`, `ipso.php`, `single_person.php`, `ipso_users*.php` |
| Админ ключей | сессия `ipso_user` (role=admin) | `access_keys.php` |
| Админ организаций | сессия `ipso_user` (role=admin) | `criminal_organizations.php` |

**`config.php`** (вне git): `$pdo`, `$esia_tables`, `BASE_URL`.

---

## 2. Структура проекта

```
sint/
  dispatch.php              ← единая точка входа (роутер)
  db_migr.php               ← массив миграций БД по индексам
  bootstrap.php             ← config, search_functions, Autoloader
  auth.php                  ← legacy-обёртка AuthGate (если нужен отдельный include)
  app/
    Application.php         ← service locator
    Http/Router.php         ← маршруты → контроллеры
    Controllers/            ← тонкий HTTP-слой
    Services/               ← сценарии
    Repositories/           ← SQL
    Search/                 ← SearchSourceRegistry, SourceSearcherInterface
    View/View.php
    Security/LegacyPasswordHasher.php
    Infrastructure/
  views/
    layouts/                ← main, ipso, ipso_admin, ipso_person
    search/, search_results/, ipso/, manual/, auth/
  search_functions.php      ← legacy SQL (вызывается из registry)
```

**Composer не используется.** Autoload: `App\Infrastructure\Autoloader`.

---

## 3. Точка входа

Каждый публичный `*.php` в корне:

```php
<?php
require __DIR__ . '/dispatch.php';
```

`dispatch.php` → `Router::dispatch($route)` по имени скрипта.
Перед роутингом запускаются миграции из `db_migr.php` через `DbMigrator`.

`index.php` → маршрут `search`.

---

## 4. MVC-слои

| Слой | Где | Задача |
|------|-----|--------|
| Router | `app/Http/Router.php` | URL-скрипт → контроллер + auth |
| Controller | `app/Controllers/*` | HTTP, вызов сервиса, View |
| Service | `app/Services/*` | бизнес-логика |
| Repository | `app/Repositories/*` | PDO |
| View | `views/**` | HTML |

---

## 5. Поиск

| Сервис | Файл | Семантика POST | Сохранение |
|--------|------|----------------|------------|
| `SearchOrchestrator` | `search_request.php` | `!empty` | `search_requests` |
| `SyncSearchOrchestrator` | `search.php` (sync POST) | `isset` | нет |

Источники данных: `SearchSourceRegistry` + `LegacyCallableSourceSearcher` → функции в `search_functions.php`.

`LegacySearchAdapter` — фасад для оркестраторов (совместимость).

---

## 6. Auth

`App\Services\AuthGate` — логика бывшего `auth.php`:

- без `token` → IPso (логин / сессия / `die`)
- с `token` → пользователь `users`
- если `users.access_status = blocked` → `ACCESS BLOCKED`

Для `login.php` роутер выставляет `$_GET['page'] = 'login'`.

Пароли IPso: `LegacyPasswordHasher` (double SHA-256, как в legacy).

---

## 7. Правила (обязательно)

1. Не менять имена полей POST: `surname`, `firstname`, `patronymic`, `DOB`, `phone`, `email`.
2. Не менять ключи JSON в `search_requests.result` без регрессии.
3. Async-эталон — `SearchOrchestrator`; sync — `SyncSearchOrchestrator`.
4. Известные баги legacy SQL не чинить без отдельного тикета.
5. Новый код в `app/` — `declare(strict_types=1);`, без `global $pdo`.
6. Новые страницы: Controller + View + запись в `Router::ROUTES`.
7. Для токенов `users.access_status` используются только значения: `admin`, `user`, `blocked`.
8. Роли IPso: `admin`, `user`, `ipsoshnik`.
9. Для `ipsoshnik` показываются только списки преступников (общий пул + мои клиенты).
10. Преступные организации хранятся в `criminal_organizations`, связи с делами — `person_criminal_organizations`.

---

## 8. Этапы миграции

| Этап | Статус |
|------|--------|
| 1 — Orchestrator, bootstrap | ✅ |
| 2 — Views, SyncSearch | ✅ |
| 3 — Repositories, controllers, views IPso/search_results | ✅ |
| 4 — SearchSourceRegistry, SourceSearcherInterface | ✅ |
| 5 — dispatch.php, Router | ✅ |
| 6 — SqlLikeHelper, LegacyPasswordHasher (подготовка; SQL пока legacy) | ✅ частично |

Полный переход SQL на bound parameters — отдельная задача (`SqlLikeHelper`).

---

## 9. Добавление источника данных

1. Функция в `search_functions.php`.
2. Регистрация в `SearchSourceRegistry::createDefault()`.
3. Ветки в `SearchOrchestrator` и при необходимости `SyncSearchOrchestrator`.
4. Обновить счётчик источников для `nothing_found`.
5. Чеклист §10.

---

## 10. Чеклист регрессии

- [ ] `search.php?token=` — форма, AJAX → `search_request` → `search_results`
- [ ] Sync POST на `search.php`
- [ ] Список и деталь `search_results.php`
- [ ] `login.php` / `ipso.php` / `single_person.php`
- [ ] `ipso_users.php`, `ipso_users_list.php`
- [ ] `criminals_pool.php`, `my_clients.php` (роль `ipsoshnik`)
- [ ] Клиент со статусом `is_criminal=1`: взять/вернуть, недоступен другим ипсошникам после назначения
- [ ] `add_manual.php`, `getperson.php?hash=`
- [ ] JSON API `getperson` совпадает с эталоном

---

## 11. Журнал изменений

| Дата | Изменение |
|------|-----------|
| 2026-05-27 | Этапы 1–2 |
| 2026-05-27 | Убран Composer |
| 2026-05-27 | Этапы 3–6: repositories, controllers, views, Router, SearchSourceRegistry, SqlLikeHelper |
| 2026-05-27 | Добавлена админка `access_keys.php` для создания ключей и управления статусом (`admin`/`user`/`blocked`) |
| 2026-05-27 | Добавлены `db_migr.php` + `DbMigrator`, роль `ipsoshnik`, списки `criminals_pool.php` и `my_clients.php`, отметка `is_criminal` и распределение по ипсошнику |
| 2026-05-27 | Добавлен справочник преступных организаций, админ-редактор и экспорт организаций в `getperson` JSON |
