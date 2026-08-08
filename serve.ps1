Write-Host ""
Write-Host "  ☕  Valena Dev Server + Public Tunnel" -ForegroundColor Yellow
Write-Host "  ─────────────────────────────────────" -ForegroundColor DarkGray
Write-Host ""

Set-Location $PSScriptRoot

# Refresh PATH so ngrok is resolvable
$env:PATH = [System.Environment]::GetEnvironmentVariable('PATH','Machine') + ';' + [System.Environment]::GetEnvironmentVariable('PATH','User')
$ngrok = (Get-Command ngrok -ErrorAction Stop).Source

# Start Laravel in the background
$laravel = Start-Process php -ArgumentList "artisan","serve","--port=8000" -PassThru -WindowStyle Hidden

Write-Host "  ✔  Laravel started on http://localhost:8000" -ForegroundColor Green

# Give Laravel a moment to boot
Start-Sleep -Seconds 2

# Start ngrok tunnel and capture the assigned URL
Write-Host "  ⏳ Opening public tunnel via ngrok ..." -ForegroundColor Cyan

$tunnelJob = Start-Job -ScriptBlock { param($exe); & $exe http 8000 2>&1 } -ArgumentList $ngrok

# Wait for the public URL to appear via ngrok local API
$publicUrl = $null
$attempts  = 0
while (-not $publicUrl -and $attempts -lt 30) {
    Start-Sleep -Seconds 1
    try {
        $api = Invoke-RestMethod -Uri 'http://localhost:4040/api/tunnels' -ErrorAction Stop
        $https = $api.tunnels | Where-Object { $_.proto -eq 'https' } | Select-Object -First 1
        if ($https) { $publicUrl = $https.public_url }
    } catch { }
    $attempts++
}

if ($publicUrl) {
    Write-Host ""
    Write-Host "  ╔══════════════════════════════════════════════╗" -ForegroundColor Green
    Write-Host "  ║  🌐  PUBLIC URL:" -ForegroundColor Green -NoNewline
    Write-Host "  $publicUrl" -ForegroundColor White -NoNewline
    Write-Host "  ║" -ForegroundColor Green
    Write-Host "  ╚══════════════════════════════════════════════╝" -ForegroundColor Green
    Write-Host ""
    Write-Host "  Share that URL with anyone. It's live now." -ForegroundColor Yellow
    Write-Host "  Admin login: admin@valena.com / password" -ForegroundColor DarkGray
    Write-Host ""
    Write-Host "  Press CTRL+C or close this window to stop everything." -ForegroundColor DarkGray
    Write-Host ""

    # Copy URL to clipboard
    $publicUrl | Set-Clipboard
    Write-Host "  ✔  URL copied to clipboard." -ForegroundColor Green
} else {
    Write-Host "  ⚠  Could not detect public URL. Check tunnel output below:" -ForegroundColor Red
    Receive-Job $tunnelJob -Keep | Write-Host
}

# Keep running — wait for CTRL+C
try {
    while ($true) {
        Start-Sleep -Seconds 5
        # Restart tunnel job if it died
        if ($tunnelJob.State -eq 'Completed' -or $tunnelJob.State -eq 'Failed') {
            Write-Host "  ⚠  Tunnel dropped. Reconnecting..." -ForegroundColor Yellow
            Remove-Job $tunnelJob -Force
            $tunnelJob = Start-Job -ScriptBlock { param($exe); & $exe http 8000 2>&1 } -ArgumentList $ngrok
        }
    }
} finally {
    # Cleanup on exit
    Write-Host ""
    Write-Host "  Stopping servers..." -ForegroundColor DarkGray
    Stop-Process -Id $laravel.Id -Force -ErrorAction SilentlyContinue
    Stop-Job $tunnelJob -ErrorAction SilentlyContinue
    Remove-Job $tunnelJob -Force -ErrorAction SilentlyContinue
    Write-Host "  ✔  All stopped. Goodbye." -ForegroundColor Green
}
