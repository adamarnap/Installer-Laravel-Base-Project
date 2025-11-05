#!/bin/bash

# ============ 🚀 START : Laravel Starter Kit Installer Guide
echo "============================================================"
echo "🎉 Welcome to the Laravel Starter Kit Installer 🎉"
echo "============================================================"
echo "This script will guide you through setting up a fresh Laravel project"
echo "with a clean and powerful base structure — ready for development!"
echo ""
echo "🔧 What you'll get:"
echo "- Laravel base project with pre-configured structure"
echo "- Tailwind CSS, Vite, and other essentials (optional)"
echo "- Environment setup and optimization"
echo ""
echo "📋 Requirements:"
echo "- Composer ✅"
echo "- Node.js & NPM ✅"
echo "- Internet connection 🌐"
echo ""
echo "⚠️ Please make sure you're connected to the internet before proceeding."
echo "💡 Tip: Run this script in a clean directory to avoid conflicts."
echo ""
echo "📦 Let's get started and build something awesome!"
echo "============================================================"
# ============ 🏁 END : Laravel Starter Kit Installer Guide

# ============ 👤 ABOUT THE DEVELOPER (colored)
DEV_NAME="ADAM ARNAP"
DEV_LINKEDIN="https://www.linkedin.com/in/adam-arnap-bb6987237"
DEV_GITHUB="https://github.com/adamarnap"

BOLD="\033[1m"; RESET="\033[0m"
CYAN="\033[38;5;44m"; MAGENTA="\033[38;5;207m"; DIM="\033[2m"

echo ""
printf "${DIM}%s${RESET}\n" "============================================================"
printf "${BOLD}${MAGENTA}👤 About the Developer${RESET}\n"
printf "${DIM}%s${RESET}\n" "------------------------------------------------------------"
printf "${CYAN}Developer  :${RESET} %s\n"  "$DEV_NAME"
printf "${CYAN}LinkedIn   :${RESET} %s\n"  "$DEV_LINKEDIN"
printf "${CYAN}GitHub     :${RESET} %s\n"  "$DEV_GITHUB"
printf "${DIM}%s${RESET}\n\n" "============================================================"
# ============ 👤 END : ABOUT THE DEVELOPER

# ============ 🌐 START : Operating System Selection
echo "🌐 Select your operating system:"
echo "1) Linux"
echo "2) macOS"
echo "3) Exit"
read -p "Enter your choice [1-3]: " choice

case "$choice" in
    1)
    echo "✅ Linux selected. Running Linux installer..."
    bash installer/linux-laravel-installer.sh
    ;;
    2)
    echo "✅ macOS selected. Running macOS installer..."
    bash installer/macos-laravel-installer.sh
    ;;
    3)
    echo "👋 Exiting installer. Goodbye!"
    exit 0
    ;;
    *)
    echo "❌ Invalid choice. Please run the script again."
    exit 1
    ;;
esac
# ============ 🌐 END : Operating System Selection
