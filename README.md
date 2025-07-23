# Test Product Store

Проект на **Laravel** с модульной архитектурой (Modules) для управления продуктами и заказами.  
Используется **Docker + Nginx**, **DDD**, **OpenAPI (Swagger)** и **Sanctum** для авторизации.

---

## 🚀 Функционал
- Управление **продуктами** (список, фильтры).
- Управление **заказами** и **товарами в заказах**.
- Поддержка **Docker (PHP-FPM, MySQL, Nginx)**.
- **OpenAPI документация** для API.
- Unit и Feature тесты.

---

## ⚙️ Установка (через Docker)

### 1. Клонировать репозиторий
```bash
git clone https://github.com/HarAlb/test-product-store.git
cd test-product-store
```

### 2. Скопировать .env
```bash
cp .env.example .env
```

### 3. Поднять контейнеры
```bash
docker-compose up -d --build
```

### 4. Запустить контейнеры
```bash
docker-compose up -d --build
```

После запуска проект будет доступен по адресу:
http://test-pro.test/

## 🔑 Основные команды

### Запустить миграции и сиды
```bash
docker exec -it test-pro-php php artisan migrate --seed
```

### Запустить тесты
```bash
docker exec -it test-pro-php php artisan test
```

### Установить зависимости
```bash
docker exec -it test-pro-php composer install
```

## Сгенерировать Swagger документацию
```bash
docker exec -it test-pro-php php artisan l5-swagger:generate
```

## 📜 API Документация
### После генерации OpenAPI документация доступна по адресу:
http://test-pro.test/api/documentation

---

## 🧑‍💻 Автор

Альберт Арутюнян  
GitHub: [@HarAlb](https://github.com/HarAlb)
