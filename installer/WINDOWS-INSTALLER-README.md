# Windows Laravel Installer

## 📋 Prerequisites

Before running the installer, make sure you have:

1. **Composer** - [Download from getcomposer.org](https://getcomposer.org/download/)
2. **Node.js & NPM** - [Download from nodejs.org](https://nodejs.org/)
3. **PHP** (usually comes with Composer, or install via [XAMPP](https://www.apachefriends.org/))
4. **MySQL/MariaDB** or another database system
5. **Git** (optional but recommended) - [Download from git-scm.com](https://git-scm.com/)

## 🚀 Installation Methods

### Method 1: Using Batch File (Recommended for Beginners)

1. Open File Explorer and navigate to the `installer` folder
2. **Right-click** on `windows-laravel-installer.bat`
3. Select **"Run as administrator"**
4. Follow the on-screen instructions

### Method 2: Using PowerShell Directly

1. Open **PowerShell as Administrator**:
   - Press `Win + X`
   - Select "Windows PowerShell (Admin)" or "Terminal (Admin)"

2. Navigate to the installer directory:
   ```powershell
   cd path\to\kominfo-base-laravel-installer\installer
   ```

3. If this is your first time running PowerShell scripts, enable script execution:
   ```powershell
   Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
   ```

4. Run the installer:
   ```powershell
   .\windows-laravel-installer.ps1
   ```

### Method 3: Using Command Prompt

1. Open **Command Prompt as Administrator**
2. Navigate to the installer directory:
   ```cmd
   cd path\to\kominfo-base-laravel-installer\installer
   ```

3. Run:
   ```cmd
   powershell -ExecutionPolicy Bypass -File windows-laravel-installer.ps1
   ```

## 📝 Installation Steps

The installer will guide you through:

1. **Application Name** - Enter your desired project name
2. **Laravel Version** - Specify the Laravel version (e.g., 10.*, 11.*)
3. **Database Configuration** - Enter your database credentials:
   - DB Host (usually `127.0.0.1` or `localhost`)
   - DB Port (usually `3306`)
   - DB Database name
   - DB Username (usually `root`)
   - DB Password

## ⚙️ What Gets Installed

The installer will automatically set up:

- ✅ Fresh Laravel project
- ✅ Laravel Breeze (Authentication)
- ✅ Spatie Laravel Permission (Role & Permission management)
- ✅ Diglactic Laravel Breadcrumbs
- ✅ Laravel PWA Support
- ✅ Laravel IDE Helper
- ✅ Yajra DataTables
- ✅ TailwindCSS v4
- ✅ Axios
- ✅ Pre-configured base structure

## 🔧 After Installation

Once installation is complete:

1. Navigate to your project folder:
   ```cmd
   cd your-project-name
   ```

2. Start the development server:
   ```cmd
   php artisan serve
   ```

3. Open your browser and visit: `http://localhost:8000`

4. (Optional) In a new terminal, start Vite for hot-reloading:
   ```cmd
   npm run dev
   ```

## 🐛 Troubleshooting

### Script Execution Error

If you get an error about script execution:
```powershell
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Composer Not Found

- Make sure Composer is installed and added to PATH
- Restart your terminal after installing Composer
- Verify: `composer --version`

### NPM Not Found

- Install Node.js from [nodejs.org](https://nodejs.org/)
- Restart your terminal
- Verify: `npm --version`

### Permission Denied

- Make sure to run PowerShell or Command Prompt as Administrator
- Right-click on the terminal and select "Run as administrator"

### Database Connection Error

- Make sure your database server is running (MySQL/MariaDB)
- Verify your database credentials
- Check if the database exists before running migrations

## 📞 Support

If you encounter any issues:

- Check the error messages carefully
- Make sure all prerequisites are installed
- Try running the installer again
- Check the [GitHub repository](https://github.com/adamarnap/Installer-Laravel-Base-Project) for updates

## 👤 Developer

- **Name**: ADAM ARNAP
- **LinkedIn**: [adam-arnap-bb6987237](https://www.linkedin.com/in/adam-arnap-bb6987237)
- **GitHub**: [adamarnap](https://github.com/adamarnap)

---

**Happy Coding! 🎉**
