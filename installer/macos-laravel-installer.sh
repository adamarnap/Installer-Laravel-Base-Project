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

# ============== START : Copy Base Project Files
echo ""
echo ""
echo "============= [STEP] 4 : Copying Base Project Files ============="
echo ""
# Copy additional files from src to new Laravel project
cp -r ../src/app .
cp -r ../src/resources .
cp -r ../src/routes .
# cp -r ../src/storage .
cp -r ../src/public/assets public/assets
cp -r ../src/vite.config.js .
cp -r ../src/README.md .
echo "Base project files copied successfully"
# ============== END : Copy Base Project Files

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

sed -i '' "s/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/g" .env
sed -i '' "s/# DB_HOST=127.0.0.1/DB_HOST=$db_host/g" .env
sed -i '' "s/# DB_PORT=3306/DB_PORT=$db_port/g" .env
sed -i '' "s/# DB_DATABASE=laravel/DB_DATABASE=$db_database/g" .env
sed -i '' "s/# DB_USERNAME=root/DB_USERNAME=$db_user/g" .env
sed -i '' "s/# DB_PASSWORD=/DB_PASSWORD=$db_pass/g" .env
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
printf "%s\n" \
"    App\\Providers\\HelperServiceProvider::class," \
"    App\\Providers\\ViewComposerServiceProvider::class," \
"    Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider::class," \
| sed -i '' '/App\\Providers\\AppServiceProvider::class,/r /dev/stdin' bootstrap/providers.php

# Add necessary imports to bootstrap/app.php
echo ""
echo "----------------- [STEP] 8.2.1 Add necessary imports to bootstrap/app.php -----------------"
echo ""
sed -i '' '3i\
use Illuminate\\Http\\Request;\
use Illuminate\\Auth\\AuthenticationException;\
use Illuminate\\Validation\\ValidationException;\
use Illuminate\\Database\\QueryException;\
use Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException;\
use App\\Exceptions\\ServiceException;\
use App\\Exceptions\\ResourceNotFound;\
use App\\Helpers\\ApiResponse;
' bootstrap/app.php

# Add API route to withRouting
echo ""
echo "----------------- [STEP] 8.2.2 Add API route to withRouting -----------------"
echo ""
sed -i '' "/web: __DIR__/a\\
        api: __DIR__.'/../routes/api.php'," bootstrap/app.php

# Replace withExceptions with custom exception handling
echo ""
echo "----------------- [STEP] 8.2.3 Replace withExceptions with custom exception handling -----------------"
echo ""
# Create backup and use temporary file approach
cp bootstrap/app.php bootstrap/app.php.bak
awk '
/->withExceptions\(function \(Exceptions \$exceptions\) \{/ {
    print "    ->withExceptions(function (Exceptions $exceptions): void {"
    print "        // ServiceException - specific custom exception (should be first)"
    print "        $exceptions->render(function (ServiceException $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::error($e->getMessage(), $e->getCode(), ["
    print "                    '\''file'\'' => \"{$e->getFile()}:{$e->getLine()}\","
    print "                    '\''context'\'' => $e->getContext()"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // AuthenticationException - unauthenticated user"
    print "        $exceptions->render(function (AuthenticationException $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::unauthorized('\''Unauthorized'\'', ["
    print "                    '\''type'\'' => '\''authentication_failed'\'',"
    print "                    '\''message'\'' => '\''You must be authenticated to access this resource.'\'',"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // ResourceNotFound exception"
    print "        $exceptions->render(function (ResourceNotFound $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::notFound('\''Resource Not Found'\'', ["
    print "                    '\''type'\'' => '\''resource_not_found'\'',"
    print "                    '\''message'\'' => $e->getMessage() ?? '\''The requested resource could not be found.'\'',"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // NotFoundHttpException - 404 errors"
    print "        $exceptions->render(function (NotFoundHttpException $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::notFound('\''Not Found'\'', ["
    print "                    '\''type'\'' => '\''route_not_found'\'',"
    print "                    '\''message'\'' => '\''The requested API endpoint does not exist.'\'',"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // ValidationException - validation errors"
    print "        $exceptions->render(function (ValidationException $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::validation(["
    print "                    '\''type'\'' => '\''request_validation_fail'\'',"
    print "                    '\''message'\'' => $e->errors(),"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // QueryException - database errors"
    print "        $exceptions->render(function (QueryException $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::error('\''Server Error'\'', 500, ["
    print "                    '\''type'\'' => '\''server_error'\'',"
    print "                    '\''message'\'' => '\''A database error occurred.'\'',"
    print "                ]);"
    print "            }"
    print "        });"
    print ""
    print "        // Generic Exception - catch all (should be last)"
    print "        $exceptions->render(function (\\\\Throwable $e, Request $request) {"
    print "            if ($request->is('\''api/*'\'')) {"
    print "                return ApiResponse::error('\''Server Error'\'', 500, ["
    print "                    '\''type'\'' => '\''server_error'\'',"
    print "                    '\''message'\'' => $e->getMessage(),"
    print "                ]);"
    print "            }"
    print "        });"
    print "    })"
    # Skip until we find the closing
    while (getline > 0) {
        if (/^[[:space:]]*\}[[:space:]]*\)[[:space:]]*$/) {
            break
        }
    }
    next
}
{ print }
' bootstrap/app.php.bak > bootstrap/app.php
rm bootstrap/app.php.bak

# Locale support
echo ""
echo "----------------- [STEP] 8.2.4 Change locale support | For Language and Localization -----------------"
echo ""
echo "----------------- [STEP] 8.2 Change locale support | For Language and Localization -----------------"
echo ""
sed -i '' '/withMiddleware(function (Middleware \$middleware)/a\
        // Web middleware\
        $middleware->web(append:[\
            \\App\\Http\\Middleware\\LocaleManager::class\
        ]);\
        // Alias middleware | can use for route or group\
        $middleware->alias([\
        ]);' bootstrap/app.php
cp -r ../src/lang .

# Install laravel sanctum
echo ""
echo "----------------- [STEP] 8.2.5 Installing Laravel Sanctum Package -----------------"
echo ""
echo "Installing Laravel Sanctum and API support..."
php artisan install:api

# Pagination tailwind support
echo ""
echo "----------------- [STEP] 8.3 Change pagination to tailwind support -----------------"
echo ""
sed -i '' '5i\use Illuminate\Pagination\Paginator;' app/Providers/AppServiceProvider.php
sed -i '' '24i\Paginator::useTailwind();' app/Providers/AppServiceProvider.php

# Add NPM scripts to package.json
echo ""
echo "----------------- [STEP] 8.4 Add NPM scripts for Build style.css Landing Template HTML to package.json -----------------"
echo ""
sed -i '' '/"scripts": {/a\
\    "build-styling-landing": "npx @tailwindcss/cli -i ./resources/css/landing/input.css -o ./dist/landing/style.css --watch",
' package.json

# ============== END : Modify Files using sed

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
