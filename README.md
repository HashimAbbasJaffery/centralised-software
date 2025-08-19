# Centralised Software – Developer Onboarding Guide

This project is a Laravel 12 application for managing club memberships, family data, financial recovery schedules, receipts, complaints, and reciprocal privileges with partner clubs. The backend delivers both web views (Blade/Tailwind) and a JSON API secured with Sanctum. A minimal Vite/Tailwind asset pipeline powers the front end.

---

## 1. Quick Start

1. **System requirements**
   - PHP 8.2+
   - Composer
   - Node 18+ & npm
   - MySQL or compatible database
   - (Optional) Google service-account JSON for Sheets integration  
     `GOOGLE_SERVICE_ACCOUNT_PATH=/absolute/path/to/service-account.json`

2. **Initial setup**
   ```bash
   cp .env.example .env     # configure DB, mail, Google credentials
   composer install
   npm install
   php artisan key:generate
   php artisan migrate      # or import centralised_software.sql
   ```

3. **Run development stack** (serves app, queue worker, and Vite watcher):
   ```bash
   composer run dev
   ```

4. **Compile assets for production**
   ```bash
   npm run build
   ```

---

## 2. Project Structure

```
app/
 ├── Exceptions/                 – Custom exception handlers
 ├── Helpers/Helpers.php         – Utility functions
 ├── Http/
 │    ├── Controllers/           – Web and API controllers
 │    ├── Middleware/            – (auth, logging, etc.)
 │    ├── Requests/              – Form validation rules
 │    └── Resources/             – API resource transformers
 ├── Jobs/                       – Queueable background tasks
 ├── Mail/                       – Mailable classes
 ├── Models/                     – Eloquent models (DB layer)
 ├── Pipes/ & Preprocess/        – Request-cleanup utilities
 ├── Repository/                 – Query helpers
 ├── Service/ & Services/        – Business logic helpers
 ├── View/Components/            – Blade components
bootstrap/                       – Laravel boot files  
config/                          – Laravel & service configuration  
database/
 ├── migrations/                 – Schema definitions  
 ├── seeders/                    – Sample seed data  
front-end/                       – (empty placeholder)  
public/                          – Web root & compiled assets  
resources/
 ├── css/, js/                   – Tailwind/Vite sources  
 └── views/                      – Blade templates  
routes/
 ├── api.php                     – REST API routes  
 ├── web.php                     – Browser routes  
storage/                         – Logs, caches, generated PDFs  
tests/                           – Pest tests (sparse)
```

---

## 3. Core Domains & Models

| Model | Purpose | Key Relations |
|-------|---------|---------------|
| **Member** | Primary entity holding personal, contact, payment info | `hasMany Spouse`, `hasMany Child`, `belongsTo CardType`, `hasMany Receipt`, `hasMany RecoverySheet`, `hasOne Profession`, `hasOne Introletter` |
| **Spouse / Child** | Dependents of a member | `belongsTo Member`; children optionally `belongsTo CardType` |
| **CardType** | Membership categories (color, fees) | `hasMany Member`, `hasMany Child` |
| **RecoverySheet** | Payment schedule rows | `belongsTo Member` |
| **Receipt / PaymentMethod** | Recorded payments and method metadata | `belongsTo Member`, `belongsTo PaymentMethod` |
| **Club / Duration / Introletter** | Reciprocal-club handling (destination, visit duration) | `Introletter belongsTo Member, Club, Duration` |
| **ComplainType / ComplainQuestion / Complain** | Complaint management | Types → Questions → Complains |
| **User / Permission** | Admin users and ability-based permissions | `User belongsToMany Permission` via `user_permission` pivot |
| **Setting** | Stores Google Drive sheet ID and link |

---

## 4. Request Validation & Resources

- Validation rules reside in **app/Http/Requests** (e.g., `MemberRequest`, `ReceiptRequest`).
- API responses are normalized through **JsonResource** classes under **app/Http/Resources**.

---

## 5. Major Controllers & Endpoints

### Members

#### `GET /api/members`
- **Query**: `keyword` (optional search), `page` (pagination)
- **Response**: paginated `MemberResource` list

#### `POST /api/member/create`
- **Body (multipart)**: all fields in `MemberRequest` such as `member_name`, `date_of_birth`, `gender`, `marital_status`, `cnic_passport`, `phone_number`, `alternate_ph_number`, `email_address`, `residential_address`, `member_city`, `member_country`, `membership_type`, `membership_number`, `membership_status`, `file_number`, `date_of_applying`, `form_fee`, `processing_fee`, `first_payment`, `installment_month`, `total_installment`, `blood_group`, `emergency_contact`, `card_type`, `date_of_issue`, `validity`, `payment_status`, `locker_category`, `locker_number`, optional `company_name`, `company_designation`, `profession`, `profile_picture`, arrays of `spouses[]` and `children[]`
- **Response**: success message

#### `PUT /api/member/{member}/update`
- **Path**: `member` ID
- **Body**: same payload as creation
- **Response**: success message

#### `DELETE /api/member/{member}/delete`
- **Path**: `member` ID
- **Response**: success message

#### `GET /api/member/{member}/sheet`
- **Path**: `member` ID
- **Response**: PDF download of family sheet

#### `GET /api/single-member/{user_token}/get`
- **Path**: `user_token` (UUID)
- **Response**: member record or 404

### Recovery & Receipts

#### `POST /api/recovery/{member}/create`
- **Path**: `member` ID
- **Body**: `rows` array of objects `{month, due_date, payment_description, current_month_payable, late_month_charges, payable, paid, due, due_amount, balance, total_balance}`
- **Response**: success message

#### `GET /api/recovery/{member}/get`
- **Path**: `member` ID
- **Response**: `RecoveryResource` collection

#### `POST /api/member/{member}/receipt/create`
- **Path**: `member` ID
- **Body**: `paid_amount`, `reference_number`, `payment_method_id`, `date`
- **Response**: success message; receipt PDF generated and mailed

#### `GET /api/receipts/get`
- **Query**: `keyword` (optional search), `page`
- **Response**: paginated `ReceiptResource` list

#### Payment Methods
- `GET /api/payment-methods` – query `keyword`, returns list
- `POST /api/payment-method/create` – body `payment_method`, returns new ID
- `DELETE /api/payment-method/{paymentMethod}/delete` – path `paymentMethod` ID

### Reciprocal Clubs & Intro Letters

#### Clubs
- `POST /api/club/create` – body `club_name`, `country`, `city`
- `GET /api/clubs` – query `keyword`, paginated list
- `DELETE /api/club/{club}/delete` – path `club` ID

#### Durations
- `GET /api/durations` – query `keyword`, paginated list
- `POST /api/duration/create` – body `months`, `fee`
- `PUT /api/duration/{duration}/update` – path `duration` ID, body `months`, `fee`
- `DELETE /api/duration/{duration}/delete` – path `duration` ID

#### Introletters
- `GET /api/introletters` – query `keyword`, paginated list
- `POST /api/introletter/create` – body `membership_number`, `club` name, `duration` text, optional `spouse`, `children`
- `DELETE /api/introletter/{introletter}/delete` – path `introletter` ID

### Complaints

- `GET /api/complain-types` – query `keyword`, paginated list
- `POST /api/complain-type/create` – body `complain_type`
- `PUT /api/complain-type/{complainType}/update` – path `complainType` ID, body `complain_type`
- `DELETE /api/complain-type/{complainType}/delete` – path `complainType` ID
- `GET /api/complain-type/{complainType}/questions` – path ID
- `POST /api/complain-type/{complainType}/question/create` – body `question`, `is_relevant`, optional `answer`
- `PUT /api/complain-type/{complainQuestion}/question/update` – path `complainQuestion` ID, body `question`, `is_relevant`, optional `answer`
- `DELETE /api/complain-type/{complainQuestion}/question/delete` – path `complainQuestion` ID
- `GET /api/complains` – paginated list
- `DELETE /api/complain/{complain}/delete` – path `complain` ID

### Users & Auth

- `GET /api/otp/{username}/create` – path `username`, query `password`; sends OTP
- `GET /api/otp/{username}/check` – path `username`, query `otp`
- `POST /api/login` – body `username`, `password`; returns bearer token
- `POST /api/logout` – bearer token in header
- `GET /api/check-token` – bearer token; validates token
- `GET /api/users` – query `keyword`, paginated `UserResource` list
- `POST /api/user/create` – body `username`, `fullname`, `email`, `password`, `permissions` (JSON array)
- `PUT /api/user/{user}/update` – path `user` ID, same body as create
- `DELETE /api/user/{user}/delete` – path `user` ID
- `GET /api/user/priveleges` – returns ability list

### Misc

- `PATCH /api/member/{member}/patch`, `PATCH /api/child/{child}/patch`, `PATCH /api/spouse/{spouse}/patch` – body `attribute` and `value` or file to update single field
- `POST /deploy` – no body; triggers `git pull` on server

---

## 6. Background Jobs & Queue

| Job | Trigger | Summary |
|-----|---------|---------|
| **CreateFamilySheet** | Member created/updated | Generates PDF family sheet and stores under `storage/app/public/members/FamilySheet/` |
| **CreateReceipt** | Receipt created/updated | Renders receipt PDF under `storage/app/recovery/receipts/` |
| **SaveInGoogleDrive** | Member events or explicit call | Exports all members to Google Sheets & shares document |
| **CalculateFees/GenerateRecoveryPDF/PrepareRecoveryData** | Recovery report generation | Computes balances & PDF schedules |
| **ImportingJob** | Manual dispatch (debug/test routes) | Data import (implementation not shown) |

Ensure a queue worker is running (`php artisan queue:listen`).

---

## 7. Services & Utilities

- **ImageService** – central file uploader to `storage/app/public/profile_pictures/`.
- **UniqueCodeService** – generates unique numeric codes (used for `receipt_id`).
- **UserService** – permission checks (currently returns `true`; intended to verify Sanctum ability).
- **Helpers** – text width splitting for card PDFs.

---

## 8. Mail

- **SendOTP** – sends login OTP using `Invoices/Text/otp` Blade view.
- **ReceiptMail** – emails receipt PDF to member.

Configure mail transport in `.env` (`MAIL_MAILER`, `MAIL_HOST`, etc.).

---

## 9. Views & Assets

- Blade templates under `resources/views` cover all UI: member forms, recovery reports, receipt PDFs (`Invoices/*`), complaint forms, etc.
- Tailwind CSS and minimal JS under `resources/css` and `resources/js`.
- Use `npm run build` for production or `composer run dev` for live compilation.

---

## 10. Testing

- Uses Pest (`tests/`) but current coverage is minimal (placeholder tests).  
  Extend with feature tests around API endpoints and model logic.

---

## 11. Deployment Notes

- `DeploymentController` allows `POST /deploy` to run a `git pull`. Secure this route behind server-level auth or remove in production.
- Jobs that interact with Google APIs need the service account file path and network access.

---

## 12. Additional Tips

- A large SQL dump (`centralised_software (3).sql`) is included for reference data.
- The `front-end/windmill-dashboard` directory is currently empty; all UI resides in Blade/Tailwind.
- Review and harden debug routes in `routes/web.php` (e.g., `/testing-url`, `/sheets`) before production use.
- Queue, mail, and Google integrations require appropriate credentials and CRON/worker setup in the deployment environment.

---

This guide should provide the next developer with a solid understanding of the system’s structure, dependencies, and workflows, enabling smooth continuation of maintenance and feature development.
