# 🧾 Enterprise GST Invoice Generator (Laravel v12)

A robust, full-stack MVC web application engineered in Laravel v12 designed to automate, calculate, and generate GST-compliant commercial invoices. The system features complete CRUD modules for inventory and client management, enterprise authentication, and a dynamic tax routing engine that programmatically splits taxes into CGST/SGST or IGST based on location constraints.

---

## 🚀 Key Features & Modules

### 1. Authentication & Secure Dashboard
* Protected state routes (`/dashboard`) utilizing Laravel's native authentication scaffolding and `auth` middleware.
* Secure multi-tenant architecture checking customer and invoice ownership against the currently logged-in user session.

### 2. Company Settings Management
* Single-entry system configuration mapping company metadata (`name`, `GSTIN`, `state`, `address`, `phone`).
* Profile file-upload pipeline routing corporate logos directly to `public/uploads/company/`.
* Strict system routing constraints enforcing a single-instance profile configuration.

### 3. Client & Inventory CRUD
* **Customer Management:** Comprehensive tracking of database records including `name`, `email`, `phone`, `address`, `gst_number`, and `state`.
* **Product Catalog:** Inventory manager tracking `name`, base `price`, `stock` thresholds, and distinct tax brackets via `gst_percent`.

### 4. Dynamic GST Calculation Engine
* **Intra-State Engine:** Automatically evaluates if `Company State == Customer State` to split the line-item tax threshold evenly into **CGST** and **SGST**.
* **Inter-State Engine:** Automatically routes the full tax threshold under **IGST** if states differ.
* **Auto-Sequence Generation:** Programmatically structures unique billing references using the format: `INV-{YYYY}-{database_sequence_id}`.

### 5. Document Export Rendering
* Integrated `barryvdh/laravel-dompdf` wrapper engine parsing specialized layout structures into print-ready PDF binary downloads (`/invoices/{id}/pdf`).
* Clean Blade presentation styles utilizing Bootstrap and print-media css variants for seamless physical printing.

---

## ⚙️ Core Tax Routing Logic

When processing transactions via `InvoiceController@store`, the application automatically calculates line-item breakdowns using the following tax rule matrices:

```text
                     [Invoice Submission]
                              |
               Is Company State == Customer State?
               /                                 \
            (YES)                                (NO)
             /                                     \
   [Intra-State Branch]                     [Inter-State Branch]
   - Split tax into CGST + SGST             - Route entire tax to IGST
   - cgst_percent = total / 2               - igst_percent = total
   - sgst_percent = total / 2               - igst_amount  = subtotal * tax%
```

### Formula Definitions:
* **Line Item Subtotal:**  
  \[\text{Line Subtotal} = \text{Price} \times \text{Quantity}\]
* **Cumulative Totals:**  
  \[\text{Grand Total} = \sum(\text{Line Subtotal}) + \sum(\text{CGST Amount} + \text{SGST Amount} + \text{IGST Amount})\]

---

## 🗄️ Relational Schema Mapping

The database layer consists of 5 core system tables linked via Eloquent ORM:

```text
 ┌──────────────┐       ┌──────────────┐       ┌──────────────┐
 │   Customer   │───►   │   Invoice    │───►   │ InvoiceItem  │
 └──────────────┘       └──────────────┘       └──────────────┘
        ▲                      ▲                      │
        │                      │                      ▼
  (belongsTo)             (belongsTo)          ┌──────────────┐
        │                      │               │   Product    │
 ┌──────────────┐       ┌──────────────┐       └──────────────┘
 │     User     │       │CompanySetting│
 └──────────────┘       └──────────────┘
```

* **`Customer`:** `hasMany` `Invoice` records.
* **`Invoice`:** `belongsTo` `Customer`, `hasMany` `InvoiceItem` records.
* **`InvoiceItem`:** `belongsTo` `Product` to extract baseline catalog specifications. Stores individual row snapshots (`cgst_percent`, `cgst_amount`, `sgst_percent`, `sgst_amount`, `igst_percent`, `igst_amount`, and unified `total_amount`).

---

## 🛠️ Tech Stack & Architecture

* **Backend Engine:** Laravel v12 (PHP)
* **Database Mapping:** Eloquent ORM (Resource Controllers, Migrations)
* **Asset Pipeline:** Vite + Tailwind CSS
* **View Layer:** Blade Templates + Bootstrap UI
* **PDF Compiler:** dompdf (`barryvdh/laravel-dompdf`)

---

## 🏃 Getting Started & Local Installation

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL or PostgreSQL Database

### Installation Steps

1. **Clone the project codebase:**
   ```bash
   git clone https://github.com
   cd YOUR_REPO_NAME
   ```

2. **Install core application package dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment Variables:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Open `.env` and set your local database connection values (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).*

4. **Run Database Migrations:**
   ```bash
   php artisan migrate
   ```

5. **Build Frontend Assets & Launch Web Servers:**
   ```bash
   # Compile asset pipeline
   npm run dev

   # Boot Laravel engine (in a separate terminal)
   php artisan serve
   
