# Laravel CRM

A customer relationship management application built with Laravel 12.  
Manage clients, track orders, and control access with role-based authorization.

## Features

- **Authentication** — registration and login via Laravel Breeze
- **Customer Management** — full CRUD with live search, sorting, and pagination
- **Order Management** — full CRUD with live search, status/date filters, and sorting
- **Role-based Authorization** — admin and user roles with Laravel Policies
- **REST API** — JSON Resource API for customers and orders
- **Dashboard** — overview stats for customers, orders, and revenue

## Tech Stack

- **Backend:** Laravel 12, PHP 8.3
- **Frontend:** Vue 3, Inertia.js, Tailwind CSS, Vite
- **Database:** PostgreSQL
- **Auth:** Laravel Breeze

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- PostgreSQL

## Installation

```bash
# Clone the repository
git clone https://github.com/deniss87/learning-laravel-crud-api.git
cd learning-laravel-crud-api

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Configure your database in `.env`:

```env
APP_NAME="NextCRM"
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_crm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

```bash
# Run migrations and seed the database
php artisan migrate:fresh --seed

# Build assets
npm run build
```

## Development

```bash
# Start development server
php artisan serve

# Start Vite dev server
npm run dev

# Run with hot reload
composer run dev
```

## Default Admin Account

After seeding, an admin account is created automatically:

| Field    | Value          |
| -------- | -------------- |
| Email    | admin@mail.com |
| Password | admin123       |
| Role     | Administrator  |

## Database Structure

```
users
├── id, name, email, password
├── role (admin / user)
└── timestamps

customers
├── id, user_id (FK)
├── first_name, last_name
├── email, phone
└── timestamps

orders
├── id, customer_id (FK), user_id (FK)
├── order_number, total_amount
├── status (pending / processing / completed / cancelled)
└── timestamps
```

## Authorization

| Action          | Admin | User (owner) | User (other) |
| --------------- | ----- | ------------ | ------------ |
| Delete customer | ✅    | ❌           | ❌           |
| Edit customer   | ✅    | ✅           | ❌           |
| Edit order      | ✅    | ✅           | ❌           |
| Delete order    | ✅    | ✅           | ❌           |

## REST API

All endpoints return JSON. Include `Accept: application/json` header.

### GET /api/customers

Returns a list of all customers.

```bash
curl http://localhost:8000/api/customers \
  -H "Accept: application/json"
```

```json
{
    "data": [
        {
            "id": 1,
            "full_name": "John Doe",
            "email": "john@example.com",
            "phone": "+371 20000000",
            "created_at": "2026-01-01"
        }
    ]
}
```

### GET /api/customers/{id}/orders

Returns all orders for a specific customer.

```bash
curl http://localhost:8000/api/customers/1/orders \
  -H "Accept: application/json"
```

### POST /api/orders

Creates a new order. Returns `201 Created`.

```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "customer_id": 1,
    "order_number": "ORD-001",
    "total_amount": 150.00,
    "status": "pending"
  }'
```

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/                    # API controllers
│   │   ├── CustomerController.php
│   │   └── OrderController.php
│   ├── Requests/                   # Form validation
│   └── Resources/                  # JSON API resources
├── Models/
│   ├── Customer.php
│   ├── Order.php
│   └── User.php
└── Policies/
    ├── CustomerPolicy.php
    └── OrderPolicy.php

resources/
└── js/
    ├── Components/
    │   ├── CustomerForm.vue        # Shared form for Create/Edit
    │   ├── OrderForm.vue           # Shared form for Create/Edit
    │   ├── OrderFilterModal.vue    # Filter modal with status and date range
    │   ├── FilterButton.vue        # Filter toggle with active state indicator
    │   ├── SearchableSelect.vue    # Customer dropdown with live search
    │   ├── StatusSelect.vue        # Styled status dropdown with color indicators
    │   ├── SearchInput.vue         # Debounced search with clear button
    │   ├── FlashMessage.vue        # Auto-dismiss notifications (3s)
    │   ├── Pagination.vue          # Arrow-based pagination with page indicator
    │   └── SortableTh.vue          # Sortable column header
    ├── Layouts/
    │   └── AuthenticatedLayout.vue
    └── Pages/
        ├── Dashboard.vue
        ├── Customers/
        │   ├── Index.vue
        │   ├── Create.vue
        │   └── Edit.vue
        └── Orders/
            ├── Index.vue
            ├── Create.vue
            └── Edit.vue
```
