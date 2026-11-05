#!/usr/bin/env bash
# Jain Enlightened: first-time setup for the web app (web/) and the mobile app (mobile/).
# Usage: ./setup.sh
#
# What it does:
#   - checks that the required tools are installed
#   - creates web/.env from web/.env.example, only if web/.env does not exist
#   - installs Composer dependencies (web) and npm dependencies (web and mobile)
#
# What it does not do: start services, run migrations, build native apps, or
# contact any server other than the package managers (Composer and npm).

set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT_DIR"

echo "=== Jain Enlightened setup ==="

fail() {
  echo "Error: $1" >&2
  exit 1
}

require_tool() {
  local tool="$1"
  local hint="$2"
  if ! command -v "$tool" >/dev/null 2>&1; then
    fail "'$tool' is required but was not found on your PATH. $hint"
  fi
}

echo ""
echo "Checking prerequisites..."

require_tool node "Install Node.js 16 or newer, then run this script again."
require_tool npm "npm normally ships with Node.js. Reinstall Node.js, then run this script again."
require_tool php "Install PHP 8.1 or newer, then run this script again."
require_tool composer "Install Composer, then run this script again."

node_major="$(node -p 'process.versions.node.split(".")[0]')"
if [ "$node_major" -lt 16 ]; then
  fail "Node.js 16 or newer is required (found major version $node_major)."
fi

if ! php -r 'exit(version_compare(PHP_VERSION, "8.1.0", ">=") ? 0 : 1);'; then
  fail "PHP 8.1 or newer is required (found $(php -r 'echo PHP_VERSION;'))."
fi

echo "  node $(node -v), npm $(npm -v), php $(php -r 'echo PHP_VERSION;'), composer found"

echo ""
echo "Preparing web environment file..."
if [ ! -f web/.env ]; then
  cp web/.env.example web/.env
  echo "  Created web/.env from web/.env.example."
  echo "  Edit web/.env before running migrations (DB_* and SEED_ADMIN_* values)."
else
  echo "  web/.env already exists. Leaving it unchanged."
fi

echo ""
echo "Installing web dependencies (Composer)..."
(cd web && composer install --no-interaction)

install_npm_deps() {
  local dir="$1"
  echo ""
  echo "Installing $dir dependencies (npm)..."
  if [ -f "$dir/package-lock.json" ]; then
    (cd "$dir" && npm ci)
  else
    (cd "$dir" && npm install)
  fi
}

install_npm_deps web
install_npm_deps mobile

echo ""
echo "=== Setup complete! ==="
echo ""
echo "Next steps:"
echo "  1. Edit web/.env (APP_URL, DB_*, SEED_ADMIN_EMAIL, SEED_ADMIN_PASSWORD)."
echo "  2. Web: cd web && php artisan key:generate && php artisan migrate && php artisan db:seed"
echo "  3. Web: php artisan serve, then open http://127.0.0.1:8000"
echo "  4. Mobile: cd mobile && npm start (see mobile/README.md for Android and iOS)"
echo "  5. Mobile placeholders: BOOTSTRAP_URL (mobile/src/api/api.js),"
echo "     YOUR_FASTBOTS_BOT_ID (mobile/src/components/modal/ChatBotModal.tsx),"
echo "     YOUR_TEAM_ID (iOS project)"
echo "  6. Using Claude Code? CLAUDE.md has all the context."
