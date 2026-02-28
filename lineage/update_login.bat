@echo off
echo =========================
echo   開始覆蓋 2025 / 2026
echo   排除 202509
echo =========================

for /d %%i in (2025* 2026*) do (
    if /I not "%%i"=="202509" if /I not "%%i"=="20260222" (
        echo 覆蓋 %%i
        copy /y "Login.ini" "%%i\Login.ini" >nul
    )
)

echo =========================
echo        完成！
echo =========================
pause