# Contributing to Jain Enlightened

Thank you for your interest. Contributions are by invitation or through issues.

## Ways to help

- **Report a bug or suggest a feature:** open a GitHub issue using the templates. Include steps to reproduce and your environment.
- **Report a security problem:** do not open a public issue. See [SECURITY.md](SECURITY.md).
- **Code changes:** by invitation only. If you have been invited, follow the steps below.

## Development setup

Run `./setup.sh` from the repository root, then follow [README.md](README.md) for the web and mobile steps. Keep local configuration in `web/.env` and never commit it.

## Branch and pull request workflow (invited contributors)

1. Create a branch from the current default branch. Use a short, descriptive name, for example `fix/lesson-filter`.
2. Keep each pull request focused on one change.
3. Run the checks for the app you changed (see below) before you open the pull request.
4. In the pull request, describe what changed, why, and how you tested it. Include screenshots for UI changes.
5. Do not include `.env` files, keystores, credentials, uploaded media, or personal data in commits.

## Code style

- **Web (PHP):** format with Laravel Pint: `cd web && ./vendor/bin/pint`. Follow the existing controller and route patterns in `web/routes/`.
- **Mobile (TypeScript and JavaScript):** run `cd mobile && npm run lint`. Prettier settings in `mobile/.prettierrc.js` use single quotes, trailing commas, and no spaces inside object braces.

## Using Claude Code

This repository includes a `CLAUDE.md` with commands, architecture, and key files. Start Claude Code from the repository root with `claude`, and it will read that file automatically. Ask it to follow the code style above and to check the commands in `CLAUDE.md` before you rely on them.
