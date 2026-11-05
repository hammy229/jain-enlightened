# Jain Enlightened

**Version:** Android 1.7 (mobile package 0.0.1) | **Port:** 8000 (`php artisan serve`) | **Stack:** Laravel 10 (PHP 8.1+) + MySQL, React Native 0.72

## What
A multilingual learning platform for Jain philosophy. `web/` is a Laravel website with a JSON API and an admin panel. `mobile/` is a React Native app that reads its content from that API.

## Quick Start

```bash
./setup.sh                          # First-time setup (creates web/.env, installs deps)
cd web && php artisan serve         # Web on http://127.0.0.1:8000 (admin at /admin)
cd mobile && npm start              # Metro bundler for the mobile app
```

## Commands

```bash
# Web (run from web/)
composer install                    # PHP dependencies
php artisan key:generate            # Set APP_KEY in web/.env
php artisan migrate                 # Create tables
php artisan db:seed                 # Seed admin user and roles (run once, fresh DB)
./vendor/bin/pint                   # Code style (Laravel Pint)
php artisan test                    # Not a working check: no phpunit.xml, only default examples

# Mobile (run from mobile/)
npm install                         # Install dependencies
npm start                           # Metro bundler
npm run android                     # Build and run on Android
bundle install && (cd ios && bundle exec pod install)   # iOS pods (once)
npm run ios                         # Build and run on iOS
npm run lint                        # ESLint
npm test                            # Jest (one render test)

# Release (run from mobile/android)
./gradlew assembleRelease           # Needs JAIN_RELEASE_* Gradle properties
```

## Architecture

```
web/
  app/Http/Controllers/API/    JSON API for mobile (routes/api.php, prefix /api)
  app/Http/Controllers/Admin/  Admin panel (routes/web.php, prefix /admin)
  app/Http/Controllers/Front/  Public website pages
  app/Models/                  Eloquent models (Admin, Master, Front)
  config/                      constant.php, services.php (chatbot id), database.php
  database/migrations/         32 migrations
  database/seeders/            DatabaseSeeder -> AdminSeeder, RolesAndPrivilegeSeeder
  resources/views/             Blade templates (Admin/, Front/)
mobile/
  App.tsx                      Fetches base URL, checks network, sets up navigation
  src/api/api.js               All HTTP calls to the web API (axios)
  src/navigation/              Main, drawer, and stack navigators
  src/screens/                 App screens (Home, Lessons, Blogs, Podcasts, ...)
  src/components/              Shared UI, cards, modals (ChatBotModal.tsx)
  android/ ios/                Native projects
```

The mobile app calls `GET /api/general-data` on launch, reads `base_url.live`, and stores it in AsyncStorage as `baseUrl`. Other screens then call `/api/*` endpoints under that base. Admins manage content in the Laravel admin panel, which writes to MySQL. Public web pages are rendered from Blade views.

## Key Files

```
web/routes/api.php                          Public API routes used by mobile
web/routes/web.php                          Website and admin panel routes
web/app/Http/Controllers/API/BaseController.php  general-data, app-update, store-link
web/config/constant.php                     Base URL options and enum-like lists
web/.env.example                            Web config template
web/database/seeders/DatabaseSeeder.php     Entry point for db:seed
mobile/App.tsx                              Root component and startup flow
mobile/src/api/api.js                       API client; BOOTSTRAP_URL is a placeholder
mobile/src/components/modal/ChatBotModal.tsx  Chatbot embed; YOUR_FASTBOTS_BOT_ID placeholder
mobile/android/app/build.gradle             Release signing via JAIN_RELEASE_* properties
```

## Configuration

Web config comes from `web/.env` (copy of `web/.env.example`). Never commit `.env`.

| Variable | Required | Description |
|----------|----------|-------------|
| APP_KEY | Yes | Set by `php artisan key:generate` |
| APP_URL | Yes | Public URL of the web app. Keep it accurate for your domain |
| DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD | Yes | MySQL connection (default connection is mysql) |
| SEED_ADMIN_EMAIL, SEED_ADMIN_PASSWORD | Yes (for seeding) | First admin login used by `db:seed` |
| FASTBOTS_BOT_ID | No | Enables the chatbot embed in the web footer |
| BASE_URL_STAGING, BASE_URL_TESTING | No | Extra base URLs returned by the API |

Many other keys in `.env.example` belong to optional services. Check `web/config/` before relying on one.

Mobile placeholders to replace: `BOOTSTRAP_URL` in `mobile/src/api/api.js`, `YOUR_FASTBOTS_BOT_ID` in `ChatBotModal.tsx`, and `DEVELOPMENT_TEAM = YOUR_TEAM_ID` in the iOS project.

## Notes

- This public copy excludes uploaded media, real data, a database dump, and credentials. Some images will be broken locally.
- `web/package.json` has Vite scripts, but there is no `vite.config.js`. Front-end asset builds are not set up.
- Contributions are by invitation or through issues. See [CONTRIBUTING.md](CONTRIBUTING.md).
