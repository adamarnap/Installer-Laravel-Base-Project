# Quick Start Guide - Windows Installer

## 🎯 Quick Installation (3 Easy Steps)

### Step 1: Download or Clone Repository
```bash
git clone https://github.com/adamarnap/Installer-Laravel-Base-Project.git
cd Installer-Laravel-Base-Project
```

### Step 2: Run the Installer

**Easiest Method:**
1. Go to the `installer` folder
2. Double-click `windows-laravel-installer.bat`
3. If prompted, click "Run as administrator"

**Alternative Method (PowerShell):**
```powershell
cd installer
.\windows-laravel-installer.ps1
```

### Step 3: Follow the Prompts

You'll be asked for:
- **Project Name**: e.g., `my-awesome-app`
- **Laravel Version**: e.g., `11.*` or `10.*`
- **Database Details**:
  - Host: `127.0.0.1` (or `localhost`)
  - Port: `3306`
  - Database: Your database name
  - Username: Usually `root`
  - Password: Your database password

## ⏱️ Installation Time

Typical installation takes **5-10 minutes** depending on your internet speed.

## ✅ What You Get

After installation, your project includes:

- 🔐 **Authentication** (Laravel Breeze)
- 👥 **User Management** with Roles & Permissions
- 🎨 **TailwindCSS v4** (Modern styling)
- 📊 **DataTables** (Yajra)
- 🍞 **Breadcrumbs** (Pre-configured)
- 📱 **PWA Support**
- 🚀 **And much more...**

## 🎉 After Installation

```powershell
# Navigate to your project
cd your-project-name

# Start the server
php artisan serve
```

Visit: `http://localhost:8000`

## 🆘 Need Help?

- Check [WINDOWS-INSTALLER-README.md](WINDOWS-INSTALLER-README.md) for detailed instructions
- See [Troubleshooting Section](WINDOWS-INSTALLER-README.md#-troubleshooting)
- Contact: [GitHub Issues](https://github.com/adamarnap/Installer-Laravel-Base-Project/issues)

---

**Made with ❤️ by Adam Arnap**
