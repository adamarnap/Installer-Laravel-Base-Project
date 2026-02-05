# Laravel Installer Script | FOR MAC OS
#!/bin/bash

# ============= START : Welcome Message
echo "============================================================"
echo "🎉 Welcome to the Laravel Starter Kit Installer for macOS 🎉"
echo "============================================================"
# ============= END : Welcome Message
# ============= END : Welcome Message

# ============== START : Function to check if a directory is not empty
check_directory_not_empty() {
    if [ "$(ls -A "$1")" ]; then
        echo "1"
    else
        echo "0"
    fi
}
# ============== END : Function to check if a directory is not empty

# ============== START : Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "[ERROR] Composer not found. Please install Composer first."
    exit 1
fi
# ============== END : Check if Composer is installed

# ============= START : Check if NPM is installed
if ! command -v npm &> /dev/null; then
    echo "[ERROR] NPM not found. Please install NPM first."
    exit 1
fi
# ============= END : Check if NPM is installed

# ============== START : Input application name from user
echo ""
echo ""
echo "============= [STEP] 1 : Input application name & Laravel version from user ============="
echo ""
# Meminta pengguna memasukkan nama aplikasi
read -p "Please enter the application name: " nama_aplikasi

# Meminta pengguna memasukkan versi Laravel
read -p "Please enter the Laravel version (Example: 9|10.*): " laravel_version
# ============== END : Input application name from user

# ============== START : Create Laravel Project
echo ""
echo ""
echo "============= [STEP] 2 : Creating Laravel Project ============="
echo ""
if [ $(check_directory_not_empty "$nama_aplikasi") -eq 0 ]; then
# Melakukan instalasi paket Laravel Installer secara global
composer create-project laravel/laravel "$nama_aplikasi" "$laravel_version"
fi
# ============== END : Create Laravel Project

# ============== START : Pindah ke dalam folder
cd $nama_aplikasi
echo ""
echo ""
echo "============= [STEP] 3 : Moved to project folder: $nama_aplikasi ============="
echo ""
# ============== END : Pindah ke dalam folder

# membuat link storage
php artisan storage:link

# ============== START : Setup .env file
echo ""
echo ""
echo "============= [STEP] 5 : Setting up .env file ============="
echo ""

php artisan key:generate

read -p "DB HOST: " db_host
read -p "DB PORT: " db_port
read -p "DB DATABASE: " db_database
read -p "DB USERNAME: " db_user
read -p "DB PASSWORD: " db_pass

sed -i "s/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/g" .env
sed -i "s/# DB_HOST=127.0.0.1/DB_HOST=$db_host/g" .env
sed -i "s/# DB_PORT=3306/DB_PORT=$db_port/g" .env
sed -i "s/# DB_DATABASE=laravel/DB_DATABASE=$db_database/g" .env
sed -i "s/# DB_USERNAME=root/DB_USERNAME=$db_user/g" .env
sed -i "s/# DB_PASSWORD=/DB_PASSWORD=$db_pass/g" .env

# Add Google reCAPTCHA configuration to .env
echo "" >> .env
echo "# GOOGLE RECAPTCHA" >> .env
echo "RECAPTCHA_SITE_KEY=6LdxE2EsAAAAAA9IYBunJoj1Klqdqgsx1kqXpzj1" >> .env
echo "RECAPTCHA_SECRET_KEY=6LdxE2EsAAAAAI_DhxKvivWqNwr3Cj1z7DeU-W2J" >> .env
echo "RECAPTCHA_ENABLED=true" >> .env
echo "RECAPTCHA_MIN_SCORE=0.5" >> .env

# Add Google reCAPTCHA configuration to .env.example
echo "" >> .env.example
echo "# GOOGLE RECAPTCHA" >> .env.example
echo "RECAPTCHA_SITE_KEY=6LdxE2EsAAAAAA9IYBunJoj1Klqdqgsx1kqXpzj1" >> .env.example
echo "RECAPTCHA_SECRET_KEY=6LdxE2EsAAAAAI_DhxKvivWqNwr3Cj1z7DeU-W2J" >> .env.example
echo "RECAPTCHA_ENABLED=true" >> .env.example
echo "RECAPTCHA_MIN_SCORE=0.5" >> .env.example
# ============== END : Setup .env file

# ============== START : Install Composer Packages
echo ""
echo ""
echo "============= [STEP] 6 : Installing Composer Package :  ============="
echo ""
# Laravel Breeze
echo ""
echo "------------------------- [STEP] 6.1 Installing Laravel Breeze -------------------------"
echo ""
# Melakukan instalasi paket Laravel Breeze
composer require laravel/breeze --dev
php artisan breeze:install

# Laravel Spatie Permission
echo ""
echo "------------------------- [STEP] 6.2 Installing Spatie Laravel Permission -------------------------"
echo ""
# Melakukan instalasi paket Spatie Laravel Permission
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Laravel Diglatic Breadcrumbs
# Melakukan instalasi paket Diglatic Laravel Breadcrumbs
echo ""
echo "------------------------- [STEP] 6.3 Installing Diglatic Laravel Breadcrumbs -------------------------"
echo ""
composer require diglactic/laravel-breadcrumbs
# php artisan vendor:publish --provider="Diglactic\Breadcrumbs\BreadcrumbsServiceProvider"
php artisan vendor:publish --tag=breadcrumbs-config
# replace conde in file config/breadcrumbs.php, change 'view' => 'breadcrumbs::bootstrap5' to 'view' => 'breadcrumbs::tailwind'
sed -i "s/'view' => 'breadcrumbs::bootstrap5'/'view' => 'breadcrumbs::tailwind'/g" config/breadcrumbs.php
php artisan optimize:clear

# Laravel PWA Support
echo ""
echo "------------------------- [STEP] 6.4 Installing Laravel PWA Support -------------------------"
echo ""
composer require silviolleite/laravelpwa
php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"

# Laravel IDE Helper
echo ""
echo "------------------------- [STEP] 6.5 Installing Laravel IDE Helper -------------------------"
echo ""
composer require --dev barryvdh/laravel-ide-helper
php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag="config"
php artisan ide-helper:generate
php artisan ide-helper:meta

# Laravel Yajra DataTables
echo ""
echo "------------------------- [STEP] 6.6 Installing Laravel Yajra DataTables -------------------------"
echo ""
composer require yajra/laravel-datatables:"^12.0"
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"
php artisan vendor:publish --tag=datatables

# Laravolt Indonesia Address
echo ""
echo "------------------------- [STEP] 6.7 Installing Laravolt Indonesia Address -------------------------"
echo ""
composer require laravolt/indonesia
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider" --tag=config
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider" --tag=migrations

# ============== END : Install Composer Packages

# ============== START : Install NPM Packages
# Clean existing node modules and lock file
rm -rf node_modules package-lock.json

# Remove existing Tailwind and PostCSS config files if they exist
rm -f postcss.config.js tailwind.config.js

# Melakukan instalasi paket npm
echo ""
echo "============= [STEP] 7 : Installing NPM Packages ============="
echo ""

# Install tailwindcss
echo ""
echo "------------------------- [STEP] 7.1 Installing TailwindCSS -------------------------"
echo ""
npm install -D tailwindcss@4.0.0
npm install -D @tailwindcss/vite@^4.0.0
npm install -D @tailwindcss/cli@^4.0.6,

# Init tailwindcss
# npx tailwindcss init -p # Not use in tailwindcss v4

# Install axios
echo ""
echo "------------------------- [STEP] 7.2 Installing Axios -------------------------"
echo ""
npm install axios --save-dev

# Install concurrently
echo ""
echo "------------------------- [STEP] 7.3 Installing Concurrently -------------------------"
echo ""
npm install concurrently --save-dev
# Install other packages
echo ""
echo "------------------------- [STEP] 7.4 Installing Other NPM Packages -------------------------"
echo ""
npm install
# ============== END : Install NPM Packages

# ============== START : Modify Files using sed
echo ""
echo ""
echo "============= [STEP] 8 : Modifying Files Using Sed ============="
echo ""

# Add additional providers to bootstrap/providers.php
echo ""
echo "----------------- [STEP] 8.1 Add additional providers to bootstrap/providers.php -----------------"
echo ""
# Use Python for reliable provider addition
python3 << 'ENDPYTHON'
import re

with open('bootstrap/providers.php', 'r') as f:
    content = f.read()

# Find AppServiceProvider line and add after it
pattern = r"(App\\Providers\\AppServiceProvider::class,)"
replacement = r"\1\n    App\\Providers\\HelperServiceProvider::class,\n    App\\Providers\\ViewComposerServiceProvider::class,\n    Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider::class,"
content = re.sub(pattern, replacement, content)

with open('bootstrap/providers.php', 'w') as f:
    f.write(content)
ENDPYTHON

# Add necessary imports to bootstrap/app.php
echo ""
echo "----------------- [STEP] 8.2.1 Add necessary imports to bootstrap/app.php -----------------"
echo ""
# Use Python for more reliable import insertion
python3 << 'ENDPYTHON'
import re

with open('bootstrap/app.php', 'r') as f:
    content = f.read()

# New imports to add
new_imports = [
    "use Illuminate\\Http\\Request;",
    "use Illuminate\\Auth\\AuthenticationException;",
    "use Illuminate\\Validation\\ValidationException;",
    "use Illuminate\\Database\\QueryException;",
    "use Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException;",
    "use App\\Exceptions\\ServiceException;",
    "use App\\Exceptions\\ResourceNotFound;",
    "use App\\Helpers\\ApiResponse;",
]

# Find the last use statement and add after it
lines = content.split('\n')
result = []
last_use_index = -1

for i, line in enumerate(lines):
    result.append(line)
    if line.strip().startswith('use ') and ';' in line:
        last_use_index = len(result) - 1

if last_use_index >= 0:
    # Insert new imports after last use statement
    for import_stmt in new_imports:
        if import_stmt not in content:
            result.insert(last_use_index + 1, import_stmt)
            last_use_index += 1

with open('bootstrap/app.php', 'w') as f:
    f.write('\n'.join(result))
ENDPYTHON

# Add API route to withRouting
echo ""
echo "----------------- [STEP] 8.2.2 Add API route to withRouting -----------------"
echo ""
# Use Python for reliable API route addition
python3 << 'ENDPYTHON'
import re

with open('bootstrap/app.php', 'r') as f:
    content = f.read()

# Add API route after web route - using more flexible pattern
if "api: __DIR__" not in content:
    pattern = r"(web:\s*__DIR__\s*\.\s*'[^']+',)"
    replacement = r"\1\n        api: __DIR__.'/../routes/api.php',"
    content = re.sub(pattern, replacement, content)

with open('bootstrap/app.php', 'w') as f:
    f.write(content)
ENDPYTHON

# Replace withExceptions with custom exception handling
echo ""
echo "----------------- [STEP] 8.2.3 Replace withExceptions with custom exception handling -----------------"
echo ""
# Create a temporary file with the new exception handling code
cat > /tmp/exceptions_handler.txt << 'EOFEXC'
    ->withExceptions(function (Exceptions $exceptions): void {
        // ServiceException - specific custom exception (should be first)
        $exceptions->render(function (ServiceException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error($e->getMessage(), $e->getCode(), [
                    'file' => "{$e->getFile()}:{$e->getLine()}",
                    'context' => $e->getContext()
                ]);
            }
        });

        // AuthenticationException - unauthenticated user
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::unauthorized('Unauthorized', [
                    'type' => 'authentication_failed',
                    'message' => 'You must be authenticated to access this resource.',
                ]);
            }
        });

        // ResourceNotFound exception
        $exceptions->render(function (ResourceNotFound $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::notFound('Resource Not Found', [
                    'type' => 'resource_not_found',
                    'message' => $e->getMessage() ?? 'The requested resource could not be found.',
                ]);
            }
        });

        // NotFoundHttpException - 404 errors
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::notFound('Not Found', [
                    'type' => 'route_not_found',
                    'message' => 'The requested API endpoint does not exist.',
                ]);
            }
        });

        // ValidationException - validation errors
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::validation([
                    'type' => 'request_validation_fail',
                    'message' => $e->errors(),
                ]);
            }
        });

        // QueryException - database errors
        $exceptions->render(function (QueryException $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error('Server Error', 500, [
                    'type' => 'server_error',
                    'message' => 'A database error occurred.',
                ]);
            }
        });

        // Generic Exception - catch all (should be last)
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error('Server Error', 500, [
                    'type' => 'server_error',
                    'message' => $e->getMessage(),
                ]);
            }
        });
    })
EOFEXC

# Replace the withExceptions section using Python for reliable multi-line replacement
python3 << 'ENDPYTHON'
import re

with open('bootstrap/app.php', 'r') as f:
    content = f.read()

# Read the new exception handler
with open('/tmp/exceptions_handler.txt', 'r') as f:
    new_handler = f.read().strip()

# Find and replace the withExceptions section - split and rebuild to avoid escape issues
start_pattern = r'->withExceptions\s*\(\s*function\s*\(\s*Exceptions\s+\$exceptions\s*\)\s*(?::\s*void\s*)?\{'
end_pattern = r'\}\s*\)'

# Find the start of withExceptions
start_match = re.search(start_pattern, content)
if start_match:
    before_exceptions = content[:start_match.start()]
    
    # Find the end (matching closing brace and paren) after start
    temp_content = content[start_match.start():]
    brace_count = 0
    found_opening = False
    end_pos = -1
    
    for i, char in enumerate(temp_content):
        if char == '{':
            brace_count += 1
            found_opening = True
        elif char == '}' and found_opening:
            brace_count -= 1
            if brace_count == 0:
                # Found matching brace, now look for closing paren
                for j in range(i+1, min(i+10, len(temp_content))):
                    if temp_content[j] == ')':
                        end_pos = start_match.start() + j + 1
                        break
                break
    
    if end_pos > 0:
        after_exceptions = content[end_pos:]
        content = before_exceptions + new_handler + after_exceptions

with open('bootstrap/app.php', 'w') as f:
    f.write(content)
ENDPYTHON

rm -f /tmp/exceptions_handler.txt

# Locale support
echo ""
echo "----------------- [STEP] 8.2.4 Change locale support | For Language and Localization -----------------"
echo ""
# Use Python for more reliable multi-line insertion
python3 << 'ENDPYTHON'
import re

with open('bootstrap/app.php', 'r') as f:
    content = f.read()

# Create the new middleware code
new_middleware = '''->withMiddleware(function (Middleware $middleware) {
        // Web middleware
        $middleware->web(append:[
            \\App\\Http\\Middleware\\LocaleManager::class
        ]);
        // Alias middleware | can use for route or group
        $middleware->alias([
        ]);
    })'''

# Find and replace the withMiddleware section
start_pattern = r'->withMiddleware\s*\(\s*function\s*\(\s*Middleware\s+\$middleware\s*\)\s*\{'

start_match = re.search(start_pattern, content)
if start_match:
    before_middleware = content[:start_match.start()]
    
    # Find the end (matching closing brace and paren) after start
    temp_content = content[start_match.start():]
    brace_count = 0
    found_opening = False
    end_pos = -1
    
    for i, char in enumerate(temp_content):
        if char == '{':
            brace_count += 1
            found_opening = True
        elif char == '}' and found_opening:
            brace_count -= 1
            if brace_count == 0:
                # Found matching brace, now look for closing paren
                for j in range(i+1, min(i+10, len(temp_content))):
                    if temp_content[j] == ')':
                        end_pos = start_match.start() + j + 1
                        break
                break
    
    if end_pos > 0:
        after_middleware = content[end_pos:]
        content = before_middleware + new_middleware + after_middleware

with open('bootstrap/app.php', 'w') as f:
    f.write(content)
ENDPYTHON

cp -r ../src/lang .

# Install laravel sanctum
echo ""
echo "----------------- [STEP] 8.2.5 Installing Laravel Sanctum Package -----------------"
echo ""
echo "----------------- [STEP] 8.2.5.1 Copying Base Routes"
cp -r ../src/routes .
echo "----------------- [STEP] 8.2.5.2 Installing Laravel Sanctum Process"
php artisan install:api


# Pagination tailwind support   
echo ""
echo "----------------- [STEP] 8.3 Change pagination to tailwind support -----------------"
echo ""
# Use Python for reliable file modification
python3 << 'ENDPYTHON'
import re

with open('app/Providers/AppServiceProvider.php', 'r') as f:
    content = f.read()

# Add use statement if not exists
if 'use Illuminate\\Pagination\\Paginator;' not in content:
    content = re.sub(
        r'(namespace App\\Providers;)',
        r'\1\n\nuse Illuminate\\Pagination\\Paginator;',
        content
    )

# Add Paginator::useTailwind(); in boot method
if 'Paginator::useTailwind()' not in content:
    content = re.sub(
        r'(public function boot\(\):\s*void\s*\{)',
        r'\1\n        Paginator::useTailwind();',
        content
    )

with open('app/Providers/AppServiceProvider.php', 'w') as f:
    f.write(content)
ENDPYTHON

# Add NPM scripts to package.json
echo ""
echo "----------------- [STEP] 8.4 Add NPM scripts for Build style.css Landing Template HTML to package.json -----------------"
echo ""
sed -i '/"scripts": {/a\    "build-styling-landing": "npx @tailwindcss/cli -i ./resources/css/landing/input.css -o ./dist/landing/style.css --watch",' package.json

# ============== END : Modify Files using sed

# ============== START : Copy Base Project Files
echo ""
echo ""
echo "============= [STEP] 4 : Copying Base Project Files ============="
echo ""
# Copy additional files
cp -r ../src/app .
cp -r ../src/resources .
cp -r ../src/config .
# cp -r ../src/storage .
cp -r ../src/public/assets public/assets
cp -r ../src/vite.config.js .
cp -r ../src/README.md .
# ============== END : Copy Base Project Files

# =========== START : Migrations and Seeders
echo ""
echo ""
echo "============= [STEP] 9 : Running Migrations and Seeders ============="
echo ""
echo "Copy migrations and seeders"
# Copy database
cp -r ../src/database .
# Migrate & Seeding
echo "Migrate & Seeding DB"
php artisan migrate:fresh --seed
# =========== END : Migrations and Seeders

# Finalize
echo ""
echo ""
echo "============= [FINALIZE] Building NPM Assets & Clear Cache ============="
echo ""
npm run build
php artisan optimize:clear
echo "Installation completed"
