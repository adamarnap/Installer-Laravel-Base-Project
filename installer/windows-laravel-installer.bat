@echo off
REM Laravel Installer Batch Script for Windows
REM This script will run the PowerShell installer

echo ============================================================
echo        Laravel Starter Kit Installer for Windows
echo ============================================================
echo.
echo This batch file will execute the PowerShell installer script.
echo.
echo Please make sure you have:
echo   - Composer installed
echo   - Node.js and NPM installed
echo   - Internet connection
echo.
echo ============================================================
echo.

REM Check if running as Administrator
net session >nul 2>&1
if %errorLevel% == 0 (
    echo Running as Administrator...
    echo.
) else (
    echo WARNING: Not running as Administrator!
    echo Some operations may require administrator privileges.
    echo.
    pause
)

REM Run the PowerShell script
powershell -ExecutionPolicy Bypass -File "%~dp0windows-laravel-installer.ps1"

REM Check if the script executed successfully
if %errorLevel% == 0 (
    echo.
    echo ============================================================
    echo Installation completed successfully!
    echo ============================================================
) else (
    echo.
    echo ============================================================
    echo Installation failed with error code: %errorLevel%
    echo ============================================================
)

echo.
pause
