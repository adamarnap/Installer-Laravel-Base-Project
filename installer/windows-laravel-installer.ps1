# Laravel Installer Script | FOR WINDOWS
# PowerShell Script

# ============= START : Welcome Message
Write-Host "============================================================" -ForegroundColor Cyan
Write-Host "🎉 Welcome to the Laravel Starter Kit Installer for Windows 🎉" -ForegroundColor Green
Write-Host "============================================================" -ForegroundColor Cyan
# ============= END : Welcome Message

# ============== START : Function to check if a directory is not empty
function Test-DirectoryEmpty {
    param([string]$Path)
    if (Test-Path $Path) {
        $items = Get-ChildItem -Path $Path -Force
        return ($items.Count -eq 0)
    }
    return $true
}
# ============== END : Function to check if a directory is not empty

# ============== START : Check if Composer is installed
Write-Host ""
Write-Host "Checking Composer installation..." -ForegroundColor Yellow
if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
    Write-Host "[ERROR] Composer not found. Please install Composer first." -ForegroundColor Red
    Write-Host "Download from: https://getcomposer.org/download/" -ForegroundColor Yellow
    exit 1
}
Write-Host "✅ Composer found!" -ForegroundColor Green
# ============== END : Check if Composer is installed

# ============= START : Check if NPM is installed
Write-Host "Checking NPM installation..." -ForegroundColor Yellow
if (-not (Get-Command npm -ErrorAction SilentlyContinue)) {
    Write-Host "[ERROR] NPM not found. Please install Node.js and NPM first." -ForegroundColor Red
    Write-Host "Download from: https://nodejs.org/" -ForegroundColor Yellow
    exit 1
}
Write-Host "✅ NPM found!" -ForegroundColor Green
# ============= END : Check if NPM is installed

# ============== START : Input application name from user
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 1 : Input application name & Laravel version from user =============" -ForegroundColor Cyan
Write-Host ""

$nama_aplikasi = Read-Host "Please enter the application name"
$laravel_version = Read-Host "Please enter the Laravel version (Example: 9|10.*)"
# ============== END : Input application name from user

# ============== START : Create Laravel Project
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 2 : Creating Laravel Project =============" -ForegroundColor Cyan
Write-Host ""

if (-not (Test-Path $nama_aplikasi) -or (Test-DirectoryEmpty $nama_aplikasi)) {
    composer create-project laravel/laravel "$nama_aplikasi" "$laravel_version"
    if ($LASTEXITCODE -ne 0) {
        Write-Host "[ERROR] Failed to create Laravel project." -ForegroundColor Red
        exit 1
    }
}
else {
    Write-Host "Directory $nama_aplikasi already exists and is not empty. Using existing directory..." -ForegroundColor Yellow
}
# ============== END : Create Laravel Project

# ============== START : Move to project folder
Set-Location $nama_aplikasi
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 3 : Moved to project folder: $nama_aplikasi =============" -ForegroundColor Cyan
Write-Host ""
# ============== END : Move to project folder

# ============== START : Copy Base Project Files
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 4 : Copying Base Project Files =============" -ForegroundColor Cyan
Write-Host ""
Write-Host "Copying base project files from src..." -ForegroundColor Yellow

# Copy additional files from src to new Laravel project
Copy-Item -Path "..\src\app\*" -Destination "app" -Recurse -Force
Copy-Item -Path "..\src\config\*" -Destination "config" -Recurse -Force
Copy-Item -Path "..\src\resources\*" -Destination "resources" -Recurse -Force
Copy-Item -Path "..\src\routes\*" -Destination "routes" -Recurse -Force
Copy-Item -Path "..\src\public\assets" -Destination "public\assets" -Recurse -Force
Copy-Item -Path "..\src\vite.config.js" -Destination "." -Force
Copy-Item -Path "..\src\README.md" -Destination "." -Force

Write-Host "✅ Base project files copied successfully" -ForegroundColor Green
# ============== END : Copy Base Project Files

# Create storage link
Write-Host ""
Write-Host "============= [STEP] 4 : Creating storage link =============" -ForegroundColor Cyan
Write-Host ""
php artisan storage:link

# ============== START : Setup .env file
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 5 : Setting up .env file =============" -ForegroundColor Cyan
Write-Host ""

php artisan key:generate

$db_host = Read-Host "DB HOST"
$db_port = Read-Host "DB PORT"
$db_database = Read-Host "DB DATABASE"
$db_user = Read-Host "DB USERNAME"
$db_pass = Read-Host "DB PASSWORD"

# Read .env file and replace values
$envContent = Get-Content .env -Raw
$envContent = $envContent -replace "DB_CONNECTION=sqlite", "DB_CONNECTION=mysql"
$envContent = $envContent -replace "# DB_HOST=127.0.0.1", "DB_HOST=$db_host"
$envContent = $envContent -replace "# DB_PORT=3306", "DB_PORT=$db_port"
$envContent = $envContent -replace "# DB_DATABASE=laravel", "DB_DATABASE=$db_database"
$envContent = $envContent -replace "# DB_USERNAME=root", "DB_USERNAME=$db_user"
$envContent = $envContent -replace "# DB_PASSWORD=", "DB_PASSWORD=$db_pass"
Set-Content .env -Value $envContent

# Add Google reCAPTCHA configuration to .env
Add-Content .env ""
Add-Content .env "# GOOGLE RECAPTCHA"
Add-Content .env "RECAPTCHA_SITE_KEY=6LdxE2EsAAAAAA9IYBunJoj1Klqdqgsx1kqXpzj1"
Add-Content .env "RECAPTCHA_SECRET_KEY=6LdxE2EsAAAAAI_DhxKvivWqNwr3Cj1z7DeU-W2J"
Add-Content .env "RECAPTCHA_ENABLED=true"
Add-Content .env "RECAPTCHA_MIN_SCORE=0.5"

# Add Google reCAPTCHA configuration to .env.example
Add-Content .env.example ""
Add-Content .env.example "# GOOGLE RECAPTCHA"
Add-Content .env.example "RECAPTCHA_SITE_KEY=6LdxE2EsAAAAAA9IYBunJoj1Klqdqgsx1kqXpzj1"
Add-Content .env.example "RECAPTCHA_SECRET_KEY=6LdxE2EsAAAAAI_DhxKvivWqNwr3Cj1z7DeU-W2J"
Add-Content .env.example "RECAPTCHA_ENABLED=true"
Add-Content .env.example "RECAPTCHA_MIN_SCORE=0.5"

# Add Rate Limiting configuration to .env
Add-Content .env ""
Add-Content .env "# RATE LIMITING"
Add-Content .env "LOGIN_RATE_LIMIT_MAX_ATTEMPTS=60"
Add-Content .env "LOGIN_RATE_LIMIT_DECAY_MINUTES=5"

# Add Rate Limiting configuration to .env.example
Add-Content .env.example ""
Add-Content .env.example "# RATE LIMITING"
Add-Content .env.example "LOGIN_RATE_LIMIT_MAX_ATTEMPTS=60"
Add-Content .env.example "LOGIN_RATE_LIMIT_DECAY_MINUTES=5"
# ============== END : Setup .env file

# ============== START : Install Composer Packages
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 6 : Installing Composer Packages =============" -ForegroundColor Cyan
Write-Host ""

# Laravel Breeze
Write-Host ""
Write-Host "------------------------- [STEP] 6.1 Installing Laravel Breeze -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require laravel/breeze --dev
php artisan breeze:install

# Laravel Spatie Permission
Write-Host ""
Write-Host "------------------------- [STEP] 6.2 Installing Spatie Laravel Permission -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Laravel Diglatic Breadcrumbs
Write-Host ""
Write-Host "------------------------- [STEP] 6.3 Installing Diglatic Laravel Breadcrumbs -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require diglactic/laravel-breadcrumbs
php artisan vendor:publish --tag=breadcrumbs-config

# Update breadcrumbs config
$breadcrumbsConfig = Get-Content config/breadcrumbs.php -Raw
$breadcrumbsConfig = $breadcrumbsConfig -replace "'view' => 'breadcrumbs::bootstrap5'", "'view' => 'breadcrumbs::tailwind'"
Set-Content config/breadcrumbs.php -Value $breadcrumbsConfig
php artisan optimize:clear

# Laravel PWA Support
Write-Host ""
Write-Host "------------------------- [STEP] 6.4 Installing Laravel PWA Support -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require silviolleite/laravelpwa
php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"

# Laravel IDE Helper
Write-Host ""
Write-Host "------------------------- [STEP] 6.5 Installing Laravel IDE Helper -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require --dev barryvdh/laravel-ide-helper
php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag="config"
php artisan ide-helper:generate
php artisan ide-helper:meta

# Laravel Yajra DataTables
Write-Host ""
Write-Host "------------------------- [STEP] 6.6 Installing Laravel Yajra DataTables -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require yajra/laravel-datatables:"^12.0"
php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"
php artisan vendor:publish --tag=datatables

# Laravolt Indonesia Address
Write-Host ""
Write-Host "------------------------- [STEP] 6.7 Installing Laravolt Indonesia Address -------------------------" -ForegroundColor Yellow
Write-Host ""
composer require laravolt/indonesia
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider" --tag=config
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider" --tag=migrations
# ============== END : Install Composer Packages

# ============== START : Install NPM Packages
# Clean existing node modules and lock file
if (Test-Path "node_modules") {
    Remove-Item -Recurse -Force node_modules
}
if (Test-Path "package-lock.json") {
    Remove-Item -Force package-lock.json
}

# Remove existing Tailwind and PostCSS config files if they exist
if (Test-Path "postcss.config.js") {
    Remove-Item -Force postcss.config.js
}
if (Test-Path "tailwind.config.js") {
    Remove-Item -Force tailwind.config.js
}

Write-Host ""
Write-Host "============= [STEP] 7 : Installing NPM Packages =============" -ForegroundColor Cyan
Write-Host ""

# Install tailwindcss
Write-Host ""
Write-Host "------------------------- [STEP] 7.1 Installing TailwindCSS -------------------------" -ForegroundColor Yellow
Write-Host ""
npm install -D tailwindcss@4.0.0
npm install -D @tailwindcss/vite@^4.0.0
npm install -D @tailwindcss/cli@^4.0.6

# Install axios
Write-Host ""
Write-Host "------------------------- [STEP] 7.2 Installing Axios -------------------------" -ForegroundColor Yellow
Write-Host ""
npm install axios --save-dev

# Install concurrently
Write-Host ""
Write-Host "------------------------- [STEP] 7.3 Installing Concurrently -------------------------" -ForegroundColor Yellow
Write-Host ""
npm install concurrently --save-dev

# Install other packages
Write-Host ""
Write-Host "------------------------- [STEP] 7.4 Installing Other NPM Packages -------------------------" -ForegroundColor Yellow
Write-Host ""
npm install
# ============== END : Install NPM Packages

# ============== START : Modify Files
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 8 : Modifying Files =============" -ForegroundColor Cyan
Write-Host ""

# Add additional providers to bootstrap/providers.php
Write-Host ""
Write-Host "----------------- [STEP] 8.1 Add additional providers to bootstrap/providers.php -----------------" -ForegroundColor Yellow
Write-Host ""
$providersContent = Get-Content "bootstrap\providers.php" -Raw
$providerToAdd = @"
    App\Providers\HelperServiceProvider::class,
    App\Providers\ViewComposerServiceProvider::class,
    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
"@
$providersContent = $providersContent -replace "(App\\Providers\\AppServiceProvider::class,)", "`$1`n    App\Providers\HelperServiceProvider::class,`n    App\Providers\ViewComposerServiceProvider::class,`n    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,"
Set-Content "bootstrap\providers.php" -Value $providersContent

# Add necessary imports to bootstrap/app.php
Write-Host ""
Write-Host "----------------- [STEP] 8.2.1 Add necessary imports to bootstrap/app.php -----------------" -ForegroundColor Yellow
Write-Host ""
$appContent = Get-Content "bootstrap\app.php" -Raw
$importsToAdd = @"
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Exceptions\ServiceException;
use App\Exceptions\ResourceNotFound;
use App\Helpers\ApiResponse;
"@
# Add imports after existing use statements
$appContent = $appContent -replace "(use Illuminate\\Foundation\\Configuration\\Middleware;)", "`$1`n`n$importsToAdd"
Set-Content "bootstrap\app.php" -Value $appContent

# Add API route to withRouting
Write-Host ""
Write-Host "----------------- [STEP] 8.2.2 Add API route to withRouting -----------------" -ForegroundColor Yellow
Write-Host ""
$appContent = Get-Content "bootstrap\app.php" -Raw
$appContent = $appContent -replace "(web: __DIR__\.'/../routes/web\.php',)", "`$1`n        api: __DIR__.'/../routes/api.php',"
Set-Content "bootstrap\app.php" -Value $appContent

# Replace withExceptions with custom exception handling
Write-Host ""
Write-Host "----------------- [STEP] 8.2.3 Replace withExceptions with custom exception handling -----------------" -ForegroundColor Yellow
Write-Host ""
$appContent = Get-Content "bootstrap\app.php" -Raw
$newExceptions = @'
    ->withExceptions(function (Exceptions `$exceptions): void {
        // ServiceException - specific custom exception (should be first)
        `$exceptions->render(function (ServiceException `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::error(`$e->getMessage(), `$e->getCode(), [
                    'file' => "{`$e->getFile()}:{`$e->getLine()}",
                    'context' => `$e->getContext()
                ]);
            }
        });

        // AuthenticationException - unauthenticated user
        `$exceptions->render(function (AuthenticationException `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::unauthorized('Unauthorized', [
                    'type' => 'authentication_failed',
                    'message' => 'You must be authenticated to access this resource.',
                ]);
            }
        });

        // ResourceNotFound exception
        `$exceptions->render(function (ResourceNotFound `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::notFound('Resource Not Found', [
                    'type' => 'resource_not_found',
                    'message' => `$e->getMessage() ?? 'The requested resource could not be found.',
                ]);
            }
        });

        // NotFoundHttpException - 404 errors
        `$exceptions->render(function (NotFoundHttpException `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::notFound('Not Found', [
                    'type' => 'route_not_found',
                    'message' => 'The requested API endpoint does not exist.',
                ]);
            }
        });

        // ValidationException - validation errors
        `$exceptions->render(function (ValidationException `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::validation([
                    'type' => 'request_validation_fail',
                    'message' => `$e->errors(),
                ]);
            }
        });

        // QueryException - database errors
        `$exceptions->render(function (QueryException `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::error('Server Error', 500, [
                    'type' => 'server_error',
                    'message' => 'A database error occurred.',
                ]);
            }
        });

        // Generic Exception - catch all (should be last)
        `$exceptions->render(function (\Throwable `$e, Request `$request) {
            if (`$request->is('api/*')) {
                return ApiResponse::error('Server Error', 500, [
                    'type' => 'server_error',
                    'message' => `$e->getMessage(),
                ]);
            }
        });
    })
'@
$appContent = $appContent -replace "->withExceptions\(function \(Exceptions \`\$exceptions\)\s*\{[^}]*\}\s*\)", $newExceptions
Set-Content "bootstrap\app.php" -Value $appContent

# Locale support
Write-Host ""
Write-Host "----------------- [STEP] 8.2.4 Change locale support | For Language and Localization -----------------" -ForegroundColor Yellow
Write-Host ""
$appContent = Get-Content "bootstrap\app.php" -Raw
$middlewareToAdd = @"
        // Web middleware
        `$middleware->web(append:[
            \App\Http\Middleware\LocaleManager::class
        ]);
        // Alias middleware | can use for route or group
        `$middleware->alias([
        ]);
"@
$appContent = $appContent -replace "(withMiddleware\(function \(Middleware \`$middleware\) \{)", "`$1`n$middlewareToAdd"
Set-Content "bootstrap\app.php" -Value $appContent

# Copy lang folder
Copy-Item -Path "..\src\lang" -Destination "." -Recurse -Force

# Install laravel sanctum
Write-Host ""
Write-Host "----------------- [STEP] 8.2.5 Installing Laravel Sanctum Package -----------------" -ForegroundColor Yellow
Write-Host ""
Write-Host "Installing Laravel Sanctum and API support..." -ForegroundColor Yellow
php artisan install:api
Write-Host "✅ Laravel Sanctum installed successfully" -ForegroundColor Green

# Pagination tailwind support
Write-Host ""
Write-Host "----------------- [STEP] 8.3 Change pagination to tailwind support -----------------" -ForegroundColor Yellow
Write-Host ""
$appServiceProviderContent = Get-Content "app\Providers\AppServiceProvider.php" -Raw
# Add use statement after namespace
$appServiceProviderContent = $appServiceProviderContent -replace "(namespace App\\Providers;)", "`$1`nuse Illuminate\Pagination\Paginator;"
# Add Paginator::useTailwind(); in boot method
$appServiceProviderContent = $appServiceProviderContent -replace "(public function boot\(\): void\s*\{)", "`$1`n        Paginator::useTailwind();"
Set-Content "app\Providers\AppServiceProvider.php" -Value $appServiceProviderContent

# Add NPM scripts to package.json
Write-Host ""
Write-Host "----------------- [STEP] 8.4 Add NPM scripts for Build style.css Landing Template HTML to package.json -----------------" -ForegroundColor Yellow
Write-Host ""
$packageJsonContent = Get-Content "package.json" -Raw
$packageJsonContent = $packageJsonContent -replace '("scripts": \{)', "`$1`n        `"build-styling-landing`": `"npx @tailwindcss/cli -i ./resources/css/landing/input.css -o ./dist/landing/style.css --watch`","
Set-Content "package.json" -Value $packageJsonContent
# ============== END : Modify Files

# =========== START : Migrations and Seeders
Write-Host ""
Write-Host ""
Write-Host "============= [STEP] 10 : Running Migrations and Seeders =============" -ForegroundColor Cyan
Write-Host ""

Write-Host "Copying migrations and seeders..." -ForegroundColor Yellow
# Copy database
Copy-Item -Path "..\src\database\*" -Destination "database" -Recurse -Force

Write-Host "Running migrations and seeders..." -ForegroundColor Yellow
php artisan migrate:fresh --seed
# =========== END : Migrations and Seeders

# Finalize
Write-Host ""
Write-Host ""
Write-Host "============= [FINALIZE] Building NPM Assets & Clear Cache =============" -ForegroundColor Cyan
Write-Host ""
npm run build
php artisan optimize:clear

Write-Host ""
Write-Host "============================================================" -ForegroundColor Green
Write-Host "✅ Installation completed successfully!" -ForegroundColor Green
Write-Host "============================================================" -ForegroundColor Green
Write-Host ""
Write-Host "📝 Next steps:" -ForegroundColor Yellow
Write-Host "   1. Navigate to your project: cd $nama_aplikasi" -ForegroundColor White
Write-Host "   2. Start development server: php artisan serve" -ForegroundColor White
Write-Host "   3. Access your app at: http://localhost:8000" -ForegroundColor White
Write-Host ""
Write-Host "🎉 Happy coding!" -ForegroundColor Cyan
