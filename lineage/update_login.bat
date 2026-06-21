@echo off
setlocal enabledelayedexpansion

echo =========================
echo    開始覆蓋作業
echo =========================

:: 設定要處理的月份範圍 (2025年11-12月, 2026年01-02月 2026年01-03月)
for /d %%i in (202604* 202505* 202605*) do (
    
    set "skip=0"
    
    :: 這裡列出要排除的特定名稱
    if /I "%%i"=="2025" set "skip=1"
    if /I "%%i"=="2024" set "skip=1"

    if !skip!==0 (
        echo 正在覆蓋: %%i
        copy /y "Login.ini" "%%i\Login.ini" >nul
    )
)

echo =========================
echo        完成！
echo =========================
pause