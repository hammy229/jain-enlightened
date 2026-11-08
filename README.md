# Jain Enlightened

**A multilingual learning platform for Jain philosophy, live at [jainenlightened.org](http://www.jainenlightened.org/): a Laravel website with a JSON API and an admin panel, and a React Native app for Android and iOS that reads from the same API.**

[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

**Links:** [Live site](http://www.jainenlightened.org/) · [Screenshots](#results) · [Setup](#getting-started) · [Arham Doshi](https://arhamdoshi.dev) · [LinkedIn](https://linkedin.com/in/arhamdoshi)

![Jain Enlightened home page](docs/screenshots/home.png)

## Results

| Claim | Measured | How it is checked |
|---|---|---|
| It is live | The production site at jainenlightened.org serves lessons, blogs, podcasts, research, and a gallery | Visit the site, or see the screenshots below |
| It reaches people in their own language | Lessons can be filtered by Gujarati, Hindi, and English | The lessons page and `web/resources/views` |
| It is a full platform, not a static site | 149 web routes, 22 JSON API routes, 56 controllers, and 32 database migrations | `web/routes`, `web/app/Http/Controllers`, `web/database/migrations` |
| One backend serves web and mobile | The React Native app's 25 screens load their content from the site's API | `mobile/src`, `mobile/src/api/api.js` |
| It was published without leaking anything | Credentials, uploads, real data, and the database dump were stripped and checked before release | [SANITIZATION_REPORT.md](SANITIZATION_REPORT.md) |

| Home | Lessons |
|---|---|
| ![Jain Enlightened home page](docs/screenshots/home.png) | ![Lessons page with language filter](docs/screenshots/lessons.png) |

| Blogs | Research |
|---|---|
| ![Blogs page](docs/screenshots/blogs.png) | ![Research page with books and publishing](docs/screenshots/research.png) |

## Why it matters

Jain philosophy is taught mostly in person and in Gujarati or Hindi, which makes it hard to reach for younger people abroad and for anyone outside a temple community. Jain Enlightened puts lessons, research, and talks in one place, in the language a learner reads best, on the web and on their phone. The admin panel lets editors keep it up to date without touching code.

## How it works

1. **Website.** Laravel renders the public pages: lessons, blogs, podcasts, research, gallery, impact, and contact and internship forms.
2. **Admin panel.** At `/admin`, editors manage every content type, enquiries, and system users.
3. **API.** The same Laravel app serves a JSON API at `/api`, with Sanctum for auth.
4. **Mobile app.** React Native fetches a bootstrap response, learns the API base URL from it, and renders the same content natively.

| Choice | Why |
|---|---|
| One Laravel app for site, admin, and API | One codebase and one database to run and deploy |
| The app reads its API URL from a bootstrap response | The backend can move without shipping a new app build |
| Secrets only through `.env` and Gradle properties | Nothing sensitive lives in the repository |

### Features

- Lessons, which can be filtered by language
- Blogs, podcasts, research, gallery (images and videos), and impact pages
- About, founder message, terms, and privacy content
- Contact and internship enquiry forms
- Admin panel for managing site content, enquiries, and system users
- Mobile app that reads its content from the web API
- Chatbot embed (Fastbots) in the mobile app and the web footer

## Tech stack

**Web (`web/`)**

- PHP 8.1 or newer, Laravel 10 (`composer.json`)
- Laravel Sanctum, maatwebsite/excel, yajra/laravel-datatables-oracle, stevebauman/location
- MySQL is the default database connection (`config/database.php`)
- Frontend: `package.json` lists Vite scripts (see the note under Development)

**Mobile (`mobile/`)**

- React Native 0.72.6 and React 18.2.0
- React Navigation (stack and drawer), axios, react-native-webview, react-native-reanimated
- Node.js 16 or newer (`engines` in `package.json`)
- Jest and ESLint

## Getting started

- Git
- Node.js 16 or newer, and npm
- PHP 8.1 or newer, and Composer (web)
- MySQL or a compatible database (web)
- For mobile builds: Android SDK and a JDK for Android, or Xcode and CocoaPods (via the `Gemfile`) for iOS

```bash
git clone https://github.com/hammy229/jain-enlightened.git
cd jain-enlightened
./setup.sh
```

`setup.sh` checks for the required tools, creates `web/.env` from `web/.env.example` if it does not exist, and installs the Composer and npm dependencies. It does not start any services.

### Setup: web

The public copy does not include a database. Set one up from the migrations and seeders.

1. Edit `web/.env`. Set at least `APP_URL`, the `DB_*` values, `SEED_ADMIN_EMAIL`, and `SEED_ADMIN_PASSWORD`.
2. Generate the application key and create the tables:

   ```bash
   cd web
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   ```

3. Start the server:

   ```bash
   php artisan serve
   ```

4. Open `http://127.0.0.1:8000` for the site and `http://127.0.0.1:8000/admin` for the admin login.

Run `php artisan db:seed` once on a fresh database. The seeders use plain inserts, so running them again creates duplicate rows.

### Setup: mobile

```bash
cd mobile
npm install
npm start                 # Metro bundler, in one terminal
npm run android           # Android build and run
```

For iOS:

```bash
cd mobile
bundle install            # Installs CocoaPods from the Gemfile
cd ios
bundle exec pod install
cd ..
npm run ios
```

More detail is in [mobile/README.md](mobile/README.md).

### Configuration

#### Web

All web configuration comes from `web/.env`. Copy from `web/.env.example`, which documents each key. Never commit `web/.env`.

Key settings: `APP_KEY`, `APP_URL`, `DB_*`, `SEED_ADMIN_EMAIL`, `SEED_ADMIN_PASSWORD`, and `FASTBOTS_BOT_ID` (optional, enables the chatbot embed in the web footer).

#### Mobile placeholders

The public copy uses placeholders. Replace them before you build the app for your own deployment.

- `mobile/src/api/api.js`: `BOOTSTRAP_URL` points to `https://your-domain.com/api/general-data`. Set it to your web deployment. The app reads its API base URL from this response (`base_url.live`), so make sure `APP_URL` in `web/.env` matches your public domain.
- `mobile/src/components/modal/ChatBotModal.tsx`: `YOUR_FASTBOTS_BOT_ID` in the chatbot embed URL.
- `mobile/ios/JainEnlightened.xcodeproj`: `DEVELOPMENT_TEAM = YOUR_TEAM_ID`. Set your team in Xcode under Signing & Capabilities for the JainEnlightened target rather than committing your team ID.

#### Release signing (Android)

Release builds read four Gradle properties: `JAIN_RELEASE_STORE_FILE`, `JAIN_RELEASE_STORE_PASSWORD`, `JAIN_RELEASE_KEY_ALIAS`, and `JAIN_RELEASE_KEY_PASSWORD` (see `mobile/android/app/build.gradle`). Put them in your user `~/.gradle/gradle.properties`, or pass them on the command line. Keep the keystore and passwords outside this repository.

```bash
cd mobile/android
./gradlew assembleRelease \
  -PJAIN_RELEASE_STORE_FILE=/absolute/path/to/your-release.keystore \
  -PJAIN_RELEASE_KEY_ALIAS=your-alias \
  -PJAIN_RELEASE_STORE_PASSWORD=your-store-password \
  -PJAIN_RELEASE_KEY_PASSWORD=your-key-password
```

## Project structure

```
web/      Laravel website, JSON API (/api), and admin panel (/admin)
mobile/   React Native app for Android and iOS
```

[CLAUDE.md](CLAUDE.md) describes the architecture and key files in more detail.

## Testing

```bash
# Web
cd web
./vendor/bin/pint         # Code style (Laravel Pint, from require-dev)
php artisan route:list    # List all routes

# Mobile
cd mobile
npm test                  # Jest (one render test for App)
npm run lint              # ESLint
```

Notes on the current state of the repository:

- The web `package.json` defines `dev` and `build` scripts that use Vite, but there is no `vite.config.js` in `web/`. `webpack.mix.js` refers to laravel-mix, which is not listed in `package.json`. Treat front-end asset builds as not set up.
- The web tests are the default Laravel examples. There is no `phpunit.xml`, so the test suite is not a working check of the app.

## Limitations and next steps

This repository does not include uploaded media (images, videos, and documents added through the admin panel), real data, a database dump, or credentials. Because of this, some images will appear broken when you run the site or app locally. Set up your own content through the admin panel, or add your own media.

- Front-end asset builds for the web app are not set up (see Testing).
- The web tests are Laravel's default examples, and the mobile app has one render test. Real test coverage is the main next step.

## License

MIT, see [LICENSE](LICENSE). Built by [Arham Doshi](https://arhamdoshi.dev).

Contributions are by invitation or through issues. See [CONTRIBUTING.md](CONTRIBUTING.md). To report a security problem, see [SECURITY.md](SECURITY.md).
